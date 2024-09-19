const $ = jQuery

$(document).ready(function () {
  $('.phone').mask('+7(Z00) 000-00-00', {translation: {'Z': {pattern: /[0-79]/}}});

  $('.sidebar__button').on('click', function () {
    $(this).parent('.sidebar__toggle').toggleClass('open')
  })


  function serializeForm(form, submitter) {
    var formData = new FormData(form, submitter);
    var serializedObject = {};

    formData.forEach(function (value, key) {
      if (key.includes('[')) {
        var keys = key.split(/\[|\]/).filter(function (k) {
          return k;
        });
        var current = serializedObject;

        keys.forEach(function (subKey, index) {
          if (index === keys.length - 1) {
            if (Array.isArray(current[subKey])) {
              current[subKey].push(value);
            } else if (current[subKey]) {
              current[subKey] = [current[subKey], value];
            } else {
              current[subKey] = key.includes('[]') ? [value] : value; // Key includes [] without a subkey, ie: field[].
            }
          } else {
            if (!current[subKey]) {
              current[subKey] = {};
            }
            current = current[subKey];
          }
        });
      } else {
        if (serializedObject[key]) {
          if (Array.isArray(serializedObject[key])) {
            serializedObject[key].push(value);
          } else {
            serializedObject[key] = [serializedObject[key], value];
          }
        } else {
          serializedObject[key] = value;
        }
      }
    });

    // Check if product_id exists, if not add it with the value of add-to-cart. Use variation_id for variable products.
    if (serializedObject['variation_id']) {
      serializedObject['product_id'] = serializedObject['variation_id'];
    } else if (!serializedObject['product_id'] && serializedObject['add-to-cart']) {
      serializedObject['product_id'] = serializedObject['add-to-cart'];
    }

    delete serializedObject['add-to-cart']; // Need to remove this so that the form handler doesn't try to add the product to the cart again.

    return serializedObject;
  }

  $('.change-product-qty').on('click', function () {
    const bType = $(this).data('type');
    const input = $(this).siblings('.quantity').find('input');
    const val = +input.val();
    let newVal;
    if (bType === 'plus') {
      const maxVal = input.attr('max');
      if (!maxVal) {
        newVal = val + 1;
      } else {
        newVal = val + 1 <= maxVal ? val + 1 : maxVal;
      }
    } else {
      const minVal = input.attr('min') || 1;
      newVal = val - 1 >= minVal ? val - 1 : minVal;
    }
    input.val(newVal)
  })

  $(document).on('click', '.single_add_to_cart_button:not(.disabled)', function (e) {
    const $thisbutton = $(this),
      $form = $thisbutton.closest('form.cart'),
      data = serializeForm($form[0], this);
    e.preventDefault();
    $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
    $.ajax({
      type: 'POST',
      url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
      data: data,
      beforeSend: function () {
        $thisbutton.prop('disabled', true);
        $thisbutton.removeClass('added').addClass('loading');
      },
      complete: function () {
        $thisbutton.prop('disabled', false);
        $thisbutton.addClass('added').removeClass('loading');
      },
      success: function (response) {
        const qty = $form.find('input[name="quantity"]')[0];
        qty.value = 1;
        if (response.error && response.product_url) {
          window.location = response.product_url;
          return;
        }
        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
      },
    });
    return false;
  });


  $('body').on('click', '.modal__close', function () {
    $('.dark').removeClass('active');
  })


  $('.file-wrap').on('change', 'input[type=file]', function () {
    let file = this.files[0];
    if (file.size > 10 * 1024 * 1024) {
      alert('Превышен допустимый размер. 10MB Максимум.');
      this.value = '';
    } else {
      $(this).siblings('.file-text').html(file.name)
    }
  })

  $('.send-cv').on('submit', async function (event) {
    event.preventDefault();
    const errorList = []
    $(this).find('.required').each(function () {
      const val = $(this).find('input').val();
      if (!val) {
        $(this).addClass('error');
        errorList.push($(this).attr('name'));
      }
    })

    if (errorList.length) return;


    const form_data = new FormData();
    form_data.append('action', 'send_cv');
    form_data.append('full_name', $(this).find('#full-name').val());
    form_data.append('phone', $(this).find('#phone').val());
    form_data.append('vacancy', $(this).find('#vacancy').val());
    form_data.append('file_cv', $('#file-cv').prop('files')[0]);
    $.ajax({
      type: 'POST',
      url: myajax.url,
      data: form_data,
      processData: false,
      contentType: false,
      cache: false,
      success: function (res) {
        const parsed = JSON.parse(res)
        if (parsed.status === 200) {
          $('.send-cv')[0].reset();
        } else {
          alert(parsed.info)
          console.log(parsed.desc)
        }
      },
      complete: function (res) {

      },
    })
  })


  $('#vacancy').select2({
    width: '100%',
  })

  $('#billing_country').select2({
    width: '100%',
  })

  $('.go-home').on('click', function () {
    document.location.href = "/";
  })

  $("#detach").detach().addClass('active').prependTo("#menu-main");

  $('.open-login').on('click', function () {
    const block = $('body').find('.form-login');
    if (block.length) {
      block.addClass('active')
    } else {
      $.ajax({
        type: 'GET',
        url: myajax.url,
        data: {action: 'get_login_modal'},
        beforeSend: function () {
          $('.loader-box').addClass('active')
        },
        complete: function () {
          $('.loader-box').removeClass('active');
        },
        success: function (res) {
          if (res) {
            $('header').append(res);
          }
        }
      })
    }
  })

  $('body').on('click', '.modal-login__forgot', function () {
    $('.dark').removeClass('active');
    $('.form-reset').addClass('active');
  });


  $('.modal-advise__form').on('input change', function () {
    const submit = $(this).find('[type=submit]');
    submit.prop('disabled', is_form_disabled($(this)));
  })

  $('body').on('input change', '#lost-password', function () {
    const submit = $(this).find('[type=submit]');
    submit.prop('disabled', is_form_disabled($(this)));
  })


  $('body').on('submit', '#lost-password', function (e) {
    e.preventDefault();

    const email = $(this).find('#user_login').val();
    const data = {
      'action': 'lost_password',
      'user_login': email,
      'nonce': $(this).find('#_wpnonce').val(),
    };

    $.ajax({
      type: 'POST',
      url: myajax.url,
      data,
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active');
      },
      success: function (res) {
        if (res) {
          if (res.sent) {
            $(this).trigger("reset");
            const partialEmail = email.replace(/(\w{2})[\w.-]+@([\w.]+\w)/, "$1***@$2");
            $('.user-new-email').text(partialEmail);
            $('.form-reset').removeClass('active')
            $('.overlay-reset-sent').addClass('active')
          }else {
            alert(res.msg)
          }
        }
      }
    })
  })

  $('body').on('submit', '#new_password', function (e) {
    e.preventDefault();

    const data = {
      'action': 'new_password',
      'user_name': $(this).find('#user_name').val(),
      'key': $(this).find('#key').val(),
      'password': $(this).find('#password').val(),
    };

    $.ajax({
      type: 'POST',
      url: myajax.url,
      data,
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active');
      },
      success: function (res) {
        if (res) {
          $(this).trigger("reset");
          $('.form-new-password-thx').addClass('active')
        } else {
          alert('Ошибка. Пароль не задан');
        }
      }
    })
  })

  $('body').on('input change', '#new_password', function () {
    const submit = $(this).find('[type=submit]');
    submit.prop('disabled', is_form_disabled($(this)));
  })

  $('body').on('input change', '#questions-form', function () {
    const submit = $(this).find('[type=submit]');
    submit.prop('disabled', is_form_disabled($(this)));
  })

  $('body').on('submit', '#questions-form', function (e) {
    e.preventDefault();
    const data = {
      action: 'send_question',
      name: $(this).find('input[name=name]').val(),
      phone: $(this).find('input[name=phone]').val(),
      email: $(this).find('input[name=email]').val(),
    }
    $.ajax({
      type: 'POST',
      url: myajax.url,
      data,
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active');
      },
      success: function (res) {
        if (res) {
          console.log(res)
          $(this).trigger("reset");
          $('.form-questions').removeClass('active');
          $('.overlay-questions-thx').addClass('active');
        } else {
          alert('Ошибка отправки')
        }
      }
    })
  })


  $('body').on('click', '.modal__close-login', function () {
    $('.dark').removeClass('active');
    $.ajax({
      type: 'GET',
      url: myajax.url,
      data: {action: 'get_login_modal'},
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active');
      },
      success: function (res) {
        if (res) {
          $('header').append(res);
        }
      }
    })
  })


  $('body').on('click', '.open-questions', function () {
    $.ajax({
      type: 'GET',
      url: myajax.url,
      data: {action: 'get_questions_modal'},
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active');
      },
      success: function (res) {
        if (res) {
          $('header').append(res);
          $('.phone').mask('+7(Z00) 000-00-00', {translation: {'Z': {pattern: /[0-79]/}}});
        }
      }
    })
  })
})

function is_form_disabled(form) {
  const errorList = [];
  form.find('.required').each(function () {
    const input = $(this).find('input, textarea');
    const val = input.val();
    if (!val) {
      $(this).addClass('error');
      errorList.push(input.attr('name'));
    } else {
      $(this).removeClass('error');
    }
  })
  return !!errorList.length
}