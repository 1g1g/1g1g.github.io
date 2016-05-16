(function($) {
  
  $(document).ready(function() {
    /**
     * Tabs
     */
    $('.tabs').dm3Tabs();

    /**
     * Feedback message
     */
    var dm3_message = $('#dm3-message');
    if (dm3_message.length) {
      setTimeout(function() {
        dm3_message.slideUp();
      }, 5000);
    }
    
    
    /**
     * Color picker
     */
    $('.pickcolor').each(function() {
      var cpicker = $(this);
      
      cpicker.ColorPicker({
        color: '#0000ff',
        
        onShow: function (colpkr) {
          $(colpkr).fadeIn(500);
          return false;
        },
        
        onHide: function (colpkr) {
          $(colpkr).fadeOut(500);
          return false;
        },
        
        onChange: function (hsb, hex, rgb) {
          $('div', cpicker).css('background-color', '#' + hex);
          cpicker.prev().val('#' + hex);
        }
      });
    });
  });
  
  /**
   * Tabs plugin
   */
  $.fn.dm3Tabs = function() {
    return this.each(function() {
      var el = $(this);
      var nav = el.prev('.tabs-nav').children('li');
      var tabs = el.children('.tab');

      el.css({
        minHeight: el.prev('.tabs-nav').height() + 'px'
      });
      
      tabs.not(':nth-child(1)').css('display', 'none');
      
      nav.find('a').click(function(e) {
        e.preventDefault();
        var li = $(this).parent();
        var index = li.index() + 1;
        tabs.filter(':visible').css('display', 'none');
        tabs.filter(':nth-child(' + index + ')').css('display', 'block');
        nav.filter('.active').removeClass('active');
        li.addClass('active');
        el.find('input[name="cur_tab_idx"]').val(index - 1)
      });

      var index_active = parseInt(el.find('input[name="cur_tab_idx"]').val());
      if (isNaN(index_active)) {
        index_active = 0;
      }
      nav.eq(index_active).find('> a').trigger('click');
    });
  };
  
}(jQuery));