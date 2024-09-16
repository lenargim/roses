$(document).ready(function () {
  $('.registration__reset').on('click', function () {
    $(this).parents('form')[0].reset();
    $('#billing_country').val('').trigger('change')
  })

  $('.registration__form').on('submit', function (event) {
    $('.error').removeClass('error');
    if (event.preventDefault) {
      event.preventDefault();
    } else {
      event.returnValue = false;
    }

    const errorList = [];
    const accept = $('#accept');
    $(this).find('.required').each(function () {
      const input = $(this).find('input');
      const val = input.val();
      if (!val) {
        $(this).addClass('error');
        errorList.push(input.attr('name'));
      } else {
        $(this).removeClass('error');
      }
    })

    if (accept.length && !accept.is(':checked')) {
      errorList.push(accept.attr('name'));
      accept.parent().addClass('error');
    }
    console.log(errorList)


    if (errorList.length) return;

    const reg_nonce = $('#vb_new_user_nonce').val();
    const reg_user = $('#reg_username').val();
    const billing_last_name = $('#billing_last_name').val();
    const billing_first_name = $('#billing_first_name').val();
    const billing_patronymic_name = $('#billing_patronymic_name').val();
    const email = $('#email').val();
    const billing_phone = $('#billing_phone').val();
    const billing_country = $('#billing_country').val();
    const billing_postcode = $('#billing_postcode').val();
    const billing_state = $('#billing_state').val();
    const billing_city = $('#billing_city').val();
    const billing_address_1 = $('#billing_address_1').val();
    const billing_home = $('#billing_home').val();
    const billing_body = $('#billing_body').val();
    const billing_apartment = $('#billing_apartment').val();

    const data = {
      action: 'register_user',
      nonce: reg_nonce,
      user: reg_user,
      billing_last_name,
      billing_first_name,
      billing_patronymic_name,
      email,
      billing_phone,
      billing_country,
      billing_postcode,
      billing_state,
      billing_city,
      billing_address_1,
      billing_home,
      billing_body,
      billing_apartment
    };

    // Do AJAX request
    $.ajax({
      type: 'POST',
      url: myajax.url,
      data,
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active')
      },
      success: function (response) {
        if (response === '1') {
          const partialEmail = email.replace(/(\w{2})[\w.-]+@([\w.]+\w)/, "$1***@$2");
          $('.user-email').text(partialEmail);
          $('.overlay-user-thx').addClass('active');
          $('.registration__form')[0].reset();
          $('#billing_country').val('').trigger('change')
        } else {
          alert(response)
        }
      },
    })

  });
})