/**
 * Initialize page js before it gets visible
 *
 * Called on page load and everytime we load a page through AJAX (before we show the loaded content)
 * IMPORTANT: use "context" variable in the calls to jQuery inside this function,
 * such that it's new call doesn't conflict with the old one (e.g. when we first load the page) + performance optimization
 */
function dm3_page_initialize($, context) {

  "use strict";

  /**
   * Dm3Rs Slider
   */
  $('#dm3-rs', context).dm3Rs();

  /**
   * Flexslider
   */
  $('.flexslider', context).each(function() {
    var slider = $(this);
    var args = null;

    /*var w = slider.data('width');
    var h = slider.data('height');

    if (w && h) {
      var ratio = h / w;
      slider.find('> .slides').css('height', (slider.width() * ratio) + 'px');
    }*/

    if (slider.hasClass('flexslider-posts')) {
      args = {
        animation: 'slide',
        animationLoop: false,
        slideshow: false,
        itemWidth: 220,
        itemMargin: 20,
        prevText: '<span></span>',
        nextText: '<span></span>'
      };
    } else if (slider.hasClass('flexslider-logos')) {
      args = {
        animation: 'slide',
        animationLoop: false,
        slideshow: false,
        itemWidth: 220,
        itemMargin: 20,
        prevText: '<span></span>',
        nextText: '<span></span>'
      };
    } else {
      args = {
        animation: 'slide',
        easing: 'easeInOutExpo',
        slideshow: false,
        prevText: '<span></span>',
        nextText: '<span></span>',
        smoothHeight: true,
        video: true
      };

      var autoscroll = parseInt(slider.data('autoscroll'), 10);

      if (!isNaN(autoscroll) && autoscroll > 0) {
        args.slideshow = true;
        args.slideshowSpeed = autoscroll * 1000;
      }

      var animation = slider.data('animation');

      if (animation) {
        args.animation = animation;
        args.easing = 'swing';
      }
    }

    if (slider.hasClass('direction-nav-hidden')) {
      args.directionNav = false;
    }

    /*args.start = function(slider) {
      slider.find('> .flex-viewport > .slides').css('height', 'auto');
    };*/

    slider.flexslider(args);
  });

  /**
   * Portfolio (Gallery)
   */
  $('.dm3-gallery', context).each(function() {
    var gallery = $(this);

    // Isotope
    setTimeout(function() {
      gallery.isotope({
        itemSelector: 'li',
        layoutMode: 'fitRows'
      });
    }, 200);

    // Magnific Popup
    gallery.magnificPopup({
      delegate: '.mfp-image, .mfp-iframe',
      type: 'image',
      titleSrc: 'title',
      gallery: {
        enabled: false
      }
    });

    gallery.find('> li').hover(function() {
      var li = $(this);
      var desc = li.find('.dm3-gallery-popover:first');
      desc.stop().css({opacity: 0, display: 'block'}).animate({opacity: 1}, {duration: 200});
    }, function() {
      var li = $(this);
      var desc = li.find('.dm3-gallery-popover:first');
      desc.stop().animate({opacity: 0}, {duration: 200, complete: function() {
        $(this).css('display', 'none');
      }});
    });

    // Terms filter
    var terms = gallery.prev('.dm3-gallery-terms');
    terms.find('a').on('click', function(e) {
      var a = $(this);
      var filter = a.data('filter');
      e.preventDefault();
      gallery.isotope({
        filter: filter
      });
      a.parent().siblings().removeClass('active');
      a.parent().addClass('active');
    });
  });

  /**
   * Flexslider posts
   */
  $('.flexslider-posts .slides > li, .dm3-member-block').hover(function() {
    $(this).find('> .image, > .dm3-member-image').stop().animate({opacity: 0.6}, {duration: 300});
  }, function() {
    $(this).find('> .image, > .dm3-member-image').stop().animate({opacity: 1}, {duration: 300});
  });

  /**
   * Shortcodes
   */
  if (typeof dm3_shortcodes_init === 'function') {
    dm3_shortcodes_init(context);
  }

  /**
   * Footer
   */
  $('#footer-back-to-top', context).on('click', function(e) {
    e.preventDefault();
    $('body, html').animate({scrollTop: 0}, {duration: 500, easing: 'easeOutExpo'});
  });

  /**
   * Magnific popup
   */
  $('a.dm3-lightbox, .gallery-icon > a', context).magnificPopup({
    type: 'image',
    titleSrc: 'title',
    gallery: {
      enabled: false
    }
  });

  /**
   * Placeholders in ie
   */
  if (!('placeholder' in document.createElement('input'))) {
    $('input, textarea', context).each(function() {
      var _this = $(this);
      var placeholder_val = _this.attr('placeholder');

      if (placeholder_val && !_this.val()) {
        _this.addClass('input-placeholder');
        _this.val(placeholder_val);
      }

      _this.on('focus', function() {
        if (_this.val() === placeholder_val) {
          _this.val('');
          _this.removeClass('input-placeholder');
        }
      });

      _this.on('blur', function() {
        if (!_this.val()) {
          _this.val(placeholder_val);
          _this.addClass('input-placeholder');
        }
      });
    });
  }

  /**
   * Magnific popup
   */
  $('a.popup-video').magnificPopup({
    type: 'iframe',
    titleSrc: 'title'
  });

  /**
   * Media type popover
   */
  $('.media-popover').hover(function() {
    $(this).find('.dm3-gallery-popover:first').stop().css({opacity: 0, display: 'block'}).animate({opacity: 1}, {duration: 200});
  }, function() {
    $(this).find('.dm3-gallery-popover:first').stop().animate({opacity: 0}, {duration: 200, complete: function() {
      $(this).css('display', 'none');
    }});
  });
}

jQuery(window).load(function() {
  dm3_page_initialize(jQuery, null);
});