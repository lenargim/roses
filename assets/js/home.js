jQuery(document).ready(function () {
  new Swiper('.banner__wrap', {
    slidesPerView: 1,
    speed: 400,
    loop: true,
    spaceBetween: 100,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
    },
    pagination: {
      el: '.slider__pagination'
    }
  });
  new Swiper('.slider', {
    slidesPerView: 1,
    speed: 400,
    loop: true,
    spaceBetween: 0,
    pagination: {
      el: '.slider__pagination'
    }
  });
});

