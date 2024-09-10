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

});
