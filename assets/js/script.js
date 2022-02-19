$(document).on('click', '.upload-field', function () {
  var file = $(this).parent().parent().parent().find('.input-file');
  file.trigger('click');
});
$(document).on('change', '.input-file', function () {
  $(this)
    .parent()
    .find('.form-control')
    .val(
      $(this)
        .val()
        .replace(/C:\\fakepath\\/i, '')
    );
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
