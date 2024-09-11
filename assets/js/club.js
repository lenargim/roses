$(document).ready(function () {
  new Swiper('.club-slider', {
    slidesPerView: 1,
    speed: 400,
    loop: true,
    spaceBetween: 0,
    pagination: {
      el: '.slider__pagination'
    }
  });

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
    slidesPerView: 1,
    spaceBetween: 50,
    speed: 400,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
    },
    thumbs: {
      swiper: gallery_thumbnail,
    }
  });
})