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
});
