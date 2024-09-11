jQuery(document).ready(function () {
  new Swiper('.banner__wrap', {
    slidesPerView: 1,
    speed: 700,
    loop: true,
    spaceBetween: 200,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
    },
    pagination: {
      el: '.slider__pagination'
    }
  });
  new Swiper('.club-slider', {
    slidesPerView: 1,
    speed: 400,
    loop: true,
    spaceBetween: 0,
    pagination: {
      el: '.slider__pagination'
    }
  });
});

