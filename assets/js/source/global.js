(function($) {

  $(document).ready(function() {
    var height = $(document).height();
    var width = $(document).width();

    if (width >= 768) {
      $('.header--document').height(height);
    }
  });

})(jQuery);