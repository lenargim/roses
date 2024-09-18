$(document).ready(function () {
  $('#account-img').on('change', function () {
    const file = this.files[0];
    if (file.size > 2 * 1024 * 1024) {
      alert(`Размер фото ${(file.size / 1024 / 1024).toFixed(2)}MB. Максимальный размер 2 MB.`);
      $(this).val('');
    }

    const form_data = new FormData();
    form_data.append('action', 'update_account_img');
    form_data.append('image', file);

    $.ajax({
      url: myajax.url,
      type: 'POST',
      data: form_data,
      processData: false,
      contentType: false,
      cache: false,
      enctype: 'multipart/form-data',
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active');
      },
      success: function (res) {
        if (res) {
          $('.account__top-img img').replaceWith(`<img src="${res}" alt=""/>`)
        }
      }
    })
  })

  $('.account__nav-link').each(function () {
    const link = window.location.href.replace(window.location.protocol, '');
    if ($(this).attr('href') === link) {
      $(this).addClass('active')
    }
  })

  new Swiper('.account__slider-actions', {
    slidesPerView: 1,
    speed: 400,
    loop: true,
    spaceBetween: 50,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
    },
    height: 350,
    watchSlidesProgress: true,
    allowTouchMove: false
  });


  $('#order-years').selectWoo();

  $('.woocommerce-account').on('select2:select', function (e) {
    const year = e.params.data.id;
    $.ajax({
      type: 'POST',
      url: myajax.url,
      data: {
        action: 'update_orders_year',
        year
      },
      beforeSend: function () {
        $('.loader-box').addClass('active')
      },
      complete: function () {
        $('.loader-box').removeClass('active');
      },
      success: function (res) {
        if (res) {
          $('.account__table-wrap').replaceWith(res)
          $('#order-years').selectWoo();
          console.log(res)
        }
      }
    });
  });


  $('.page-template-wishlist').on('click', '.change-cart-product-qty', function () {
    const bType = $(this).data('type');
    const input = $(this).siblings('input');
    const val = +input.val();
    let newVal;
    if (bType === 'plus') {
      const maxVal = input.attr('max');
      if (!maxVal || maxVal < 1) {
        newVal = val + 1;
      } else {
        newVal = val + 1 <= maxVal ? val + 1 : maxVal;
      }
    } else {
      const minVal = input.attr('min') || 1;
      newVal = val - 1 >= minVal ? val - 1 : minVal;
    }
    input.val(newVal);
    const link = $(this).parents('.wishlist__item').find('.wishsuite-addtocart');
    link.attr('data-quantity', newVal)
  });


  $('.page-template-wishlist').on('click', '.wishlist__reset', function () {
    const userId = $(this).data('user-id');
    if (userId) {
      $.ajax({
        type: 'POST',
        url: myajax.url,
        data: {action: 'remove_wishlist_items', user_id: userId},
        beforeSend: function () {
          $('.loader-box').addClass('active')
        },
        complete: function () {
          $('.loader-box').removeClass('active');
        },
        success: function (response) {
          if (response) {
            const {item_count} = response.data;
            if (response?.data?.html) {
              const {html, total_pages, current_page} = response.data;
              $('.wishsuite-table-content').closest('.entry-content').html(html);
            }
            $('body').find('.wishsuite-counter').html(item_count);
          }
        }
      })
    }
  })
})