jQuery(document).ready(function () {
  new Swiper('.new__slider', {
    slidesPerView: 5,
    speed: 400,
    loop: true,
    spaceBetween: 16,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
      disabledClass: 'disabled',
    },
    watchSlidesProgress: true,
    allowTouchMove: false
  });


  const swiper_thumbnail = new Swiper('.swiper-thumbs', {
    slidesPerView: 5,
    spaceBetween: 20,
    direction: 'vertical'
  });

  new Swiper('.swiper-product', {
    slidesPerView: 1,
    speed: 400,
    loop: true,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
    },
    thumbs: {
      swiper: swiper_thumbnail,
    }
  });

  new Swiper('.product-single__related', {
    slidesPerView: 4,
    speed: 400,
    loop: true,
    spaceBetween: 31,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
    },
    watchSlidesProgress: true,
    allowTouchMove: false
  });

});
