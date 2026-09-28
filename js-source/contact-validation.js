/* jQuery Validation enhances the same native WordPress POST form. */
jQuery(function ($) {
  const $form = $('#briefForm');
  if (!$form.length || !$.fn.validate) return;

  const $services = $form.find('input[name="service[]"]');
  const syncServicePill = function (input) {
    $(input).closest('.check-pill').toggleClass('active', input.checked);
  };

  $services.each(function () { syncServicePill(this); });
  $form.on('change', 'input[name="service[]"]', function () {
    syncServicePill(this);
    if ($form.data('validator')) $form.validate().element(this);
  });

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
    highlight: function (element) {
      $(element).attr('aria-invalid', 'true');
      if ($(element).attr('name') === 'service[]') $services.closest('.check-pill').addClass('has-error');
    },
    unhighlight: function (element) {
      $(element).attr('aria-invalid', 'false');
      if ($(element).attr('name') === 'service[]' && $services.filter(':checked').length) {
        $services.attr('aria-invalid', 'false').closest('.check-pill').removeClass('has-error');
      }
    }
  });
});
