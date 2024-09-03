jQuery(document).ready(function () {
  new Swiper('.new__slider', {
    slidesPerView: 5,
    speed: 400,
    loop: true,
    spaceBetween: 16,
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
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



  function getIcon(id) {
    if (!id) return '';
    switch (id) {
      case 'price':
        return "<svg width='18' height='18' viewBox='0 0 18 18' fill='none' xmlns='http://www.w3.org/2000/svg'>\n" +
          "          <path d='M13.5527 7.1775L9.00023 2.625L4.44773 7.1775' stroke='#440E62' stroke-width='1.5' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round' />\n" +
          "          <path d='M9 15.3754L9 2.75293' stroke='#440E62' stroke-width='1.5' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round' />\n" +
          "        </svg>"
        break;
      case 'price-desc':
        return "<svg width='18' height='18' viewBox='0 0 18 18' fill='none' xmlns='http://www.w3.org/2000/svg'>\n" +
          "          <path d='M4.44727 10.8225L8.99977 15.375L13.5523 10.8225' stroke='#440E62' stroke-width='1.5' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round' />\n" +
          "          <path d='M9 2.62457L9 15.2471' stroke='#440E62' stroke-width='1.5' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round' />\n" +
          "        </svg>"
        break;
      default:
        return ''
    }
  }

  function formatState(state) {
    if (!state.id) {
      return state.text;
    }
    const icon = getIcon(state.id);
    if (icon) {
      return $(`<span class="flex"><span>${state.text}</span> ${icon}</span>`);
    }
    return $(`<span>${state.text}</span>`);
  };


  function formatTemplate(state) {
    if (!state.id) {
      return state.text;
    }
    const icon = getIcon(state.id);
    if (icon) {
      return $(`<span class="flex"><span>${state.text}</span> ${icon}</span>`);
    }
    return $(`<span>${state.text}</span>`);
  };

  $.fn.selectWoo.amd.define('customSingleSelectionAdapter', [
    'select2/utils',
    'select2/selection/single',
  ], function (Utils, SingleSelection) {
    const adapter = SingleSelection;
    adapter.prototype.update = function (data) {
      if (data.length === 0) {
        this.clear();
        return;
      }
      var selection = data[0];
      var $rendered = this.$selection.find('.select2-selection__rendered');
      var formatted = this.display(selection, $rendered);
      $rendered.empty().append(formatted);
      $rendered.prop('title', selection.title || selection.text);
    };
    return adapter;
  });


  $('.orderby').select2({
    width: '100%',
    placeholder: "Сортировать",
    templateResult: formatTemplate,
    templateSelection: formatState,
    selectionAdapter: $.fn.selectWoo.amd.require('customSingleSelectionAdapter'),
  });
});
