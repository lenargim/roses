const $ = jQuery

$(document).ready(function () {
  $('.sidebar__button').on('click', function () {
    $(this).parent('.sidebar__toggle').toggleClass('open')
  })
})