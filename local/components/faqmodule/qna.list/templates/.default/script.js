$(function() {

  var $section = $('.faqmodule-faq');

  $section.on('click', '.faqmodule-faq__q', function() {
    var $btn = $(this);
    var expanded = $btn.attr('aria-expanded') === 'true';

    $section.find('.faqmodule-faq__q[aria-expanded="true"]').each(function() {
      if (this !== $btn[0]) {
        $(this)
          .attr('aria-expanded', 'false')
          .closest('.faqmodule-faq__item')
          .find('.faqmodule-faq__a')
          .hide();
      }
    });

    $btn
      .attr('aria-expanded', expanded ? 'false' : 'true')
      .closest('.faqmodule-faq__item')
      .find('.faqmodule-faq__a')
      .toggle(!expanded);
  });
});
