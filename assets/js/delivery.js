$(document).ready(function () {
  calcInit()
})

function calcInit () {
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
}