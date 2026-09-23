/* jQuery Validation enhances the same native WordPress POST form. */
jQuery(function ($) {
  const $form = $('#briefForm');
  if (!$form.length || !$.fn.validate) return;
  $form.validate({
    ignore: ':hidden:not([name="service[]"])',
    rules: {
      name: { required: true, maxlength: 10000 },
      email: { required: true, email: true, maxlength: 10000 },
      'service[]': { required: true },
      message: { required: true, maxlength: 10000 }
    },
    errorElement: 'span',
    errorClass: 'bl-field-error',
    errorPlacement: function (error, element) {
      if (element.attr('name') === 'service[]') error.insertAfter(element.closest('.service-checks'));
      else error.insertAfter(element);
    },
    highlight: function (element) { $(element).attr('aria-invalid', 'true'); },
    unhighlight: function (element) { $(element).attr('aria-invalid', 'false'); }
  });
});
