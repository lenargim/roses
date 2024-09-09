$(document).ready(function () {
  $('.cart-block').on('click', '.empty-cart', function (e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: myajax.url,
      data: {
        action: 'empty_cart',
      },
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active')
      },
      success: function (html) {
        location.reload();
      },
    });
  });


  $('.cart-block').on('click', '.change-cart-product-qty', function () {
    const bType = $(this).data('type');
    const key = $(this).data('key');
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
    input.val(newVal);
    $.ajax({
      type: "POST",
      url: myajax.url,
      data: {
        action: 'update_item_amount_in_cart',
        key: key,
        number: newVal,
      },
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active')
      },
      success: function (form) {
        if (form) {
          $('.cart-block').find('.refresh-cart').html(form)
        }
      }
    })
  });


  $('.cart-block').on('click', '.cart-remove-product', function () {
    const prodId = $(this).data('id');
    $.ajax({
      type: "POST",
      url: myajax.url,
      data: {action: 'remove_item_from_cart', 'product_id': prodId},
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active')
      },
      success: function (form) {
        console.log(form)
        if (form) {
          $('.cart-block').find('.refresh-cart').html(form)
        }
      }
    });
  })

  $('.cart-block').on('click', '.open-order',function () {
    $('.modal-order-overlay').addClass('active')
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
});
