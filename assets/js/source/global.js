(function($) {

  $(document).ready(function() {
    var height = $(document).height();
    var width = $(document).width();

    resizeSite(width, height);

    $(window).on('debouncedresize', function(e) {
      var height = $(document).height();
      var width = $(document).width();

      resizeSite(width, height);
    });

  });

  function resizeSite(width, height) {
    if (width >= 768) {
      $('.header--document').height(height);
      $('body').removeClass('mobile');
    } else {
      $('body').addClass('mobile');
    }
  }

})(jQuery);