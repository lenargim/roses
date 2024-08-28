jQuery(document).ready(function () {
  const banner = new Swiper('.banner__wrap', {
    slidesPerView: 1,
    speed: 400,
    loop: true,
    spaceBetween: 50,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
      disabledClass: 'disabled',
    },
    pagination: {
      el: '.slider__pagination'
    }
  });
  const slider = new Swiper('.slider', {
    slidesPerView: 1,
    speed: 400,
    loop: true,
    spaceBetween: 0,
    pagination: {
      el: '.slider__pagination'
    }
  });
});

