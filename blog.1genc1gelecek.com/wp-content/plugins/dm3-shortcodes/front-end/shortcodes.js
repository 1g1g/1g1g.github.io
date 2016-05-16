/**
 * dm3Tabs jQuery Plugin
 * version 1.0.5
 */
(function($) {

  "use strict";

  $.fn.dm3Tabs = function(options) {
    options = $.extend({
      speed: 600,
      afterTabChange: null,
      autoscroll: 0 // in seconds
    }, options);

    return this.each(function() {
      var animating = false,
        container = $(this).css({position: 'relative'}),
        wrapper = container.parent(),
        tabsContainers = container.children('.dm3-tab'),
        currentTab,
        curHeight,
        containerWidth,
        current,
        prev,
        prevTemp,
        tabsNav,
        type = 'horizontal',
        win = $(window);

      if (wrapper.hasClass('dm3-tabs-vertical')) {
        type = 'vertical';
      }

      // Get navigation
      if (container.data('navid')) {
        tabsNav = $('#' + container.data('navid')).children('li');
      } else {
        tabsNav = container.prev('ul').children('li');
        if (!tabsNav.length) {
          tabsNav = container.next('ul').children('li');
        }
      }

      if (tabsNav.length <= 1) {
        tabsNav.parent().css('display', 'none');
        return;
      }

      // Find current tab
      current = tabsNav.filter('.active').index();
      if (!current || current < 0) {
        current = 0;
      }
      currentTab = tabsContainers.eq(current);

      // Autoscroll
      var autoscroll = parseInt(wrapper.data('autoscroll'), 10);
      var autoscrollTimeout = null;
      var start_autoscroll = null;
      var pause = false;

      if (isNaN(autoscroll)) {
        autoscroll = options.autoscroll;
      }

      if (autoscroll) {
        autoscroll *= 1000;
        start_autoscroll = function() {
          autoscrollTimeout = null;
          if (animating || pause) {return;}
          var next = current + 1;
          if (next >= tabsContainers.length) {
            next = 0;
          }
          tabsNav.eq(prev).removeClass('active');
          tabsNav.eq(next).addClass('active');
          changeTab(next);
        };

        wrapper.hover(function() {
          if (!pause) {
            pause = true;
          }
        }, function() {
          pause = false;
          if (autoscroll && autoscrollTimeout === null) {
            autoscrollTimeout = setTimeout(start_autoscroll, autoscroll);
          }
        });
      }

      setTimeout(function() {
        var i = 0;

        if (type === 'vertical') {
          container.css('min-height', (tabsNav.eq(0).parent().height() - (parseInt(container.css('borderWidth'), 10) * 2)) + 'px');
        }

        containerWidth = tabsContainers.eq(0).css('width');

        tabsContainers.each(function() {
          var tab = $(this);

          tab.css({
            'opacity': 0,
            'position': 'absolute',
            'left': 0,
            'width': '100%'
          });

          if (i !== current) {
            tab.css('display', 'none');
          } else {
            tab.css('display', 'block');
          }

          ++i;
        });

        curHeight = tabsContainers.eq(current).outerHeight(true);
        container.css({height: curHeight + 'px'});

        // Activate current tab
        prev = current; // Previously selected tab index
        tabsNav.eq(current).addClass('active');
        currentTab.css({
          display: 'block',
          opacity: 1
        });

        function onResize() {
          if (animating) {return;}
          container.css({
            height: currentTab.outerHeight(true) + 'px'
          });
        }

        win.resize(onResize);

        // Start tabs
        i = 0;
        tabsNav.find('a').each(function() {
          this.idx = i;
          var link = $(this);
          link.on('click', function(e) {
            e.preventDefault();
            if (prev === this.idx) {return false;}
            tabsNav.eq(prev).removeClass('active');
            $(this).parent().addClass('active');
            changeTab(this.idx);
          });
          i += 1;
        });

        // Start autoscroll
        if (autoscroll) {
          autoscrollTimeout = setTimeout(start_autoscroll, autoscroll);
        }
      }, 400);

      // Function to switch tabs
      function changeTab(idx) {
        var container_height;
        animating = true;
        currentTab = tabsContainers.eq(idx);
        current = idx;

        if (autoscrollTimeout) {
          clearTimeout(autoscrollTimeout);
          autoscrollTimeout = null;
        }

        tabsContainers.eq(prev).animate({opacity: 0}, {duration: 300, queue: false, complete: function() {
          $(this).css({display: 'none'});
        }});

        prevTemp = prev;
        prev = idx;

        currentTab.stop().css('display', 'block').animate({opacity: 1}, {duration: 300, queue: false, complete: function() {
          if (typeof options.afterTabChange === 'function') {
            options.afterTabChange(currentTab);
          }
        }});

        container_height = currentTab.outerHeight(true);
        container.animate({height: container_height + 'px'}, {duration: 300, queue: false, complete: function() {
          animating = false;

          // Start autoscroll
          if (autoscroll) {
            if (autoscrollTimeout) {
              clearTimeout(autoscrollTimeout);
            }
            autoscrollTimeout = setTimeout(start_autoscroll, autoscroll);
          }
        }});
      }
    });
  };

}(jQuery));

/**
 * dm3Collapse
 * version 1.0
 */
(function($) {

  "use strict";

  /**
   * Constructor
   */
  function Dm3Collapse(el, options) {
    var that = this;
    this.el = $(el);
    this.options = options;
    this.container = this.el.parent();
    this.transitioning = false;

    this.el.parent().find('.dm3-collapse-trigger > a').on('click', function(e) {
      e.preventDefault();
      if (that.el.hasClass('dm3-in')) {
        that.hide();
      } else {
        that.show();
      }
    });

    if (this.el.hasClass('dm3-in')) {
      this.el.parent().addClass('dm3-collapse-open');
      this.el.removeClass('dm3-collapse');
      this.el.height(this.el.find('> .dm3-collapse-inner').outerHeight());
      setTimeout(function() {
        that.el.addClass('dm3-collapse');
      }, 0);
    }
  }

  /**
   * Check if browser supports transition end event
   *
   * @return Object
   */
  Dm3Collapse.prototype.transitionEnd = (function() {
    var el = document.createElement('dm3collapse');
    var transition_end = null;
    var trans_event_names = {
      'WebkitTransition': 'webkitTransitionEnd',
      'MozTransition': 'transitionend',
      'OTransition': 'oTransitionEnd otransitionend',
      'transition': 'transitionend'
    };
    var name;

    for (name in trans_event_names) {
      if (el.style[name] !== undefined) {
        transition_end = trans_event_names[name];
        break;
      }
    }

    return transition_end;
  }());

  /**
   * Get collapse siblings (for accordion feature)
   */
  Dm3Collapse.prototype.getActives = function() {
    var actives = null;
    var parent = this.container.parent();

    if (parent.length && parent.hasClass('dm3-accordion')) {
      actives = parent.find('> .dm3-collapse-item > .dm3-in');
    }

    return actives;
  };

  /**
   * Reset the height of the collapse element
   */
  Dm3Collapse.prototype.reset = function(height) {
    height = (height === null) ? 'auto' : height;
    this.el.removeClass('dm3-collapse');
    this.el.height(height)[0].innerWidth;
    this.el.addClass('dm3-collapse');
  };

  /**
   * Expand collapsed element
   */
  Dm3Collapse.prototype.show = function() {
    if (this.transitioning) { return; }
    this.transitioning = true;
    this.el.parent().addClass('dm3-collapse-open');
    var that = this;
    var actives = this.getActives();
    var actives_data;
    if (actives) {
      actives_data = actives.data('dm3Collapse');
      if (actives_data && actives_data.transitioning) { return; }
      actives.dm3Collapse('hide');
    }
    var height = this.el.find('> .dm3-collapse-inner').outerHeight();
    var complete = function() {
      that.reset();
      that.transitioning = false;
    };
    this.el.addClass('dm3-in');
    this.el.height(0);
    if (this.transitionEnd) {
      this.el.one(this.transitionEnd, complete);
    } else {
      complete();
    }
    this.el.height(height);
  };

  /**
   * Collapse the visible element
   */
  Dm3Collapse.prototype.hide = function() {
    if (this.transitioning) { return; }
    this.transitioning = true;
    this.el.parent().removeClass('dm3-collapse-open');
    var that = this;
    var height = this.el.find('> .dm3-collapse-inner').outerHeight();
    var complete = function() {
      that.transitioning = false;
    };
    this.reset(height);
    this.el.removeClass('dm3-in');
    if (this.transitionEnd) {
      this.el.one(this.transitionEnd, complete);
    } else {
      complete();
    }
    this.el.height(0);
  };

  /**
   * jQuery plugin
   */
  $.fn.dm3Collapse = function(input) {
    var options = $.extend({
    }, typeof input === 'object' && input);

    return this.each(function() {
      var $this = $(this);
      var dm3_collapse = $this.data('dm3Collapse');

      if (!dm3_collapse) {
        $this.data('dm3Collapse', (dm3_collapse = new Dm3Collapse(this, options)));
      }

      if (typeof input === 'string' && typeof dm3_collapse[input] === 'function') {
        dm3_collapse[input]();
      }
    });
  };

}(jQuery));

/**
 * Initialize shortcodes
 */
var dm3_shortcodes_init = (function($) {
  "use strict";

  return function(context) {
    if (typeof context === undefined) {
      context = null;
    }

    // Tabs
    $('.dm3-tabs', context).dm3Tabs();

    // Collapse / Accordion
    $('.dm3-collapse', context).dm3Collapse();

    // Alert boxes
    $('.dm3-alert', context).each(function() {
      var div_alert = $(this);
      var btn_close = $('<a class="dm3-alert-close" href="#">&times;</a>');
      btn_close.on('click', function(e) {
        e.preventDefault();
        $(this).parent().hide();
      });
      div_alert.append(btn_close);
    });
  };
}(jQuery));

/**
 * Run plugins
 */
(function($) {
  "use strict";

  $(document).ready(function() {
    dm3_shortcodes_init();
  });
}(jQuery));