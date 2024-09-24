$(document).ready(function () {
  const gallery_thumbnail = new Swiper('.gallery-thumbs', {
    slidesPerView: 5,
    spaceBetween: 8,
    navigation: {
      enabled: true,
      nextEl: '.next',
      prevEl: '.prev',
    },
  });

  new Swiper('.gallery-slider', {
    watchSlidesProgress: true,
    grid: {
      rows: 3
    },
    slidesPerView: 1,
    speed: 400,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
    },
    thumbs: $('.gallery-thumbs').length ? {
      swiper: gallery_thumbnail,
    } : null,
    breakpoints: {
      767: {
        spaceBetween: 50,
        grid: false,
        slidesPerView: 1,
      }
    }
  });
})