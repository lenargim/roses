$(document).ready(function () {
  $('.registration__form').on('submit', function (event) {
    event.preventDefault();
    const errorList = []
    $(this).find('.required').each(function () {
      const val = $(this).find('input').val();
      if (!val) {
        $(this).addClass('error');
        errorList.push($(this).attr('name'));
      } else {
        $(this).removeClass('error');
      }
    })

    const acceptWrap = $(this).find('.accept-wrap');
    const isAccepted = acceptWrap.find('#accept').is(':checked');
    isAccepted ? acceptWrap.removeClass('error') : acceptWrap.addClass('error');
    if (!errorList.length && isAccepted) {
      $(this)[0].submit();
    }
  })
})