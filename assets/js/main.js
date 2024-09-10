const $ = jQuery

$(document).ready(function () {
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
        newVal = val+1;
      } else {
        newVal = val+1 <= maxVal ? val+1 : maxVal;
      }
    } else {
      const minVal = input.attr('min') || 1;
      newVal = val-1 >= minVal ? val-1 : minVal;
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


  $('.modal__close').on('click', function () {
    $('.dark').removeClass('active');
  })


  const deliveryData = [
    {
      id: 1,
      text: 'Водитель-экспедитор до адреса по г. Москве и МО',
      shortText: 'Водитель-экспедитор'
    },
    {
      id: 2,
      text: 'До места стоянки машины в городах:\n' +
        '                  СПБ, Воронеж, Нижний Новгород,\n' +
        '                  Тула, Рязань',
      shortText: 'До места стоянки машины'
    },
    {
      id: 3,
      text: 'До офиса транспортной компании',

    }
  ]

  const pickupData = [
    {
      id: 0,
      text: 'М. Пятницкое шоссе (по расписанию)',
      shortText: 'М. Пятницкое шоссе'
    },
    {
      id: 1,
      text: 'Питомник по адресу Солнечногорский р-н, д. Якиманское',
      shortText: 'Питомник в д. Якиманское'
    }
  ]

  function formatState(state) {
    if (!state.id) {
      return state.text;
    }
    return state.shortText || state.text;
  };


  $('#delivery-type').select2({
    placeholder: "Выберите способ доставки",
    data: deliveryData,
    templateSelection: formatState,
  })

  $('#pickup-address').select2({
    placeholder: "Выберите адрес самовывоза",
    data: pickupData,
    templateSelection: formatState,
  })

  $('#payment-type').select2({
    placeholder: "Выберите способ оплаты",
    templateSelection: formatState,
    ajax: {
      url: myajax.url,
      dataType: 'json',
      type: "GET",
      data: {action: 'get_payment_methods'},
      processResults: function (data) {
        return {
          results: data
        };
      },
      cache: true,
    }
  })

  if ($('.woocommerce-checkout').find('input[name=payment_method]:checked').size() === 0) {
    $('.woocommerce-checkout').find('input[name=payment_method]:eq(0)').attr('checked', 'checked');
  }

  $('#payment-type').on('select2:selecting', function(e) {
    console.log('Selecting: ' , e.params.args.data);
    $(`input[name="payment_method"][value=${e.params.args.data.id}]`).prop('checked', true);
  });

  $('#billing_address_1').suggestions({
    token: '34515bf2c57c50d4559330829a3a311f047c944a',
    type: 'ADDRESS',
    count: 3,
    constraints: {
      locations: {country: 'Россия'},
    },
    /* Вызывается, когда пользователь выбирает одну из подсказок */
    onSelect: function (suggestion) {
      // $('body').trigger('update_checkout');
    },
  });
})