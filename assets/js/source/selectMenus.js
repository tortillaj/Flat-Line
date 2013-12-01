(function($) {

  $(document).ready(function() {

    // make pretty select drop downs
    $('select').each(function(i) {

      var _val, _this;

      _this = $(this);

      _this.wrap('<div class="select-box"/>');
      _this.after('<span class="select-text"></span><span class="select-arrow"><i class="icon-caret-down"></i></span>');

      _val = $(this).children("option:selected").text();
      _this.next(".select-text").text(_val);
      _this.change(function(){
        _val = $(this).children("option:selected").text();
        $(this).next(".select-text").text(_val);
      });
    });

  });

})(jQuery);