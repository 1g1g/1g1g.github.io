(function($) {

  "use strict";

  /**
   * Is link internal
   */
  function is_internal_link(href) {
    if (href.indexOf('http') !== 0 || href.indexOf('http://' + location.host) === 0 || href.indexOf('https://' + location.host) === 0) {
      return true;
    }

    return false;
  }

  /**
   * Dm3Scroller
   */
  function Dm3Scroller(el) {
    var that = this;
    this.el = el;
    this.inner = this.el.find('> .dm3-scroller-inner');
    this.resize();
    this.preloader = $('#ajax-preloader');
    this.xhr = null;

    $(window).on('resize', function() {
      that.resize();
    });
  }

  /**
   * Resize
   */
  Dm3Scroller.prototype.resize = function() {
    var content_width = this.el.width();
    this.inner.width(content_width * 2);
    this.inner.find('> .content').width(content_width);
  };

  /**
   * Load page from url
   */
  Dm3Scroller.prototype.load = function(args) {
    var that = this;

    args = $.extend({
      direction: 'next',
      url: '',
      contentSelector: '',
      speed: 1000,
      easing: 'swing',
      beforeAnimationCallback: null,
      afterNewContentCallback: null,
      completeCallback: null,
      errorCallback: null
    }, args);

    $('html, body').stop().animate({scrollTop: 0}, {duration: args.speed / 2});
    this.inner.find('> .content').stop().animate({opacity: 0.7}, {duration: args.speed / 2});
    this.preloader.fadeIn(300);

    $.ajax({
      type: 'get',
      cache: false,
      url: args.url,
      success: function(response) {
        var response_html = $(response);
        var new_content = response_html.find(args.contentSelector).detach();
        var content_width = that.el.width();
        new_content.width(content_width);

        that.preloader.fadeOut(300);
        that.inner.find('> .content').stop().animate({opacity: 0}, {duration: parseInt(args.speed / 2, 10)});

        // Pass these arguments to the completeCallback
        var completeArgs = {
          url: args.url,
          title: response_html.filter('title').text()
        };

        // Before animation callback
        if (typeof args.beforeAnimationCallback === 'function') {
          args.beforeAnimationCallback.apply(completeArgs);
        }

        if (args.direction === 'next') {
          that.inner.append(new_content);
          if (args.afterNewContentCallback) {
            args.afterNewContentCallback.apply(null, [new_content]);
          }
          that.inner.animate({marginLeft: '-' + content_width + 'px'}, {duration: args.speed, easing: args.easing, complete: function() {
            $(this).css('marginLeft', 0).find('> .content:first').remove();
            if (typeof args.completeCallback === 'function') {
              args.completeCallback.apply(completeArgs, [new_content]);
            }
          }});
        } else {
          that.inner.css('marginLeft', '-' + content_width + 'px').prepend(new_content);
          if (args.afterNewContentCallback) {
            args.afterNewContentCallback.apply(null, [new_content]);
          }
          that.inner.animate({marginLeft: 0}, {duration: args.speed, easing: args.easing, complete: function() {
            $(this).find('> .content:last').remove();
            if (typeof args.completeCallback === 'function') {
              args.completeCallback.apply(completeArgs, [new_content]);
            }
          }});
        }
      },
      error: function() {
        if (typeof args.errorCallback === 'function') {
          args.errorCallback.apply();
        }
      }
    });
  };

  /**
   * Get the index number of the parent menu item of a given url, if exists
   */
  function get_ajax_link_parent_index(url) {
    var index = -1;

    nav_links.each(function() {
      var link = $(this);
      var link_url = link.attr('href');
      var parent = null;

      if (get_full_url(link_url) === get_full_url(url)) {
        parent = link.parent();

        if (parent.parent().attr('id') === 'nav') {
          index = parent.index();
        } else if (parent.parent().parent().parent().attr('id') === 'nav') {
          index = parent.parent().parent().index();
        } else {
          index = parent.parent().parent().parent().parent().index();
        }

        return false;
      }
    });

    return index;
  }

  /**
   * Move to a given page
   */
  function move(url, next_index) {
    loadPageArgs.url = url;

    if (next_index > -1) {
      if (next_index >= cur_index) {
        loadPageArgs.direction = 'next';
        animate_background(next_index, parseInt(loadPageArgs.speed / 1.5, 10));
      } else {
        loadPageArgs.direction = 'prev';
        animate_background(next_index, parseInt(loadPageArgs.speed / 1.5, 10));
      }
    } else {
      loadPageArgs.direction = 'next';
    }

    scroller.load(loadPageArgs);
    menu_items.eq(cur_index).removeClass('current-menu-item');
    cur_index = next_index;

    if (next_index > -1) {
      menu_items.eq(next_index).addClass('current-menu-item');
      update_pointer(menu_items.eq(cur_index));
    } else {
      pointer.css('display', 'none');
    }
  }

  /**
   * Check if the link is external
   */
  function is_url_external(url) {
    var domain = function(url) {
      return url.replace('http://', '').replace('https://', '').split('/')[0];
    };

    return domain(location.href) !== domain(url);
  }

  /**
   * Process ajax links
   */
  function ajax_links(context) {
    context = context || null;

    // Process ajax links click event
    var selector = 'a.ajax-link,' +
      '.portfolio-item > .description > a,' +
      '.posts-navigation > a,' +
      '.page-links > a,' +
      '.post-meta-value:not(.post-reply-link) > a,' +
      '.dm3-widgets-post-description > a,' +
      '.cat-item > a,' +
      'a.more-link,' +
      '.dm3-widgets-post-image > a,' +
      'a.dm3-gallery-popover-link,' +
      'a.page-numbers,' +
      '.menu-item-object-page > a,' +
      '#nav-mobile a,' +
      '.flexslider-posts li a';

    $(selector, context).on('click', function(e) {
      // AJAX, only for browsers that support HTML5 history
      if (!history.pushState) {
        return;
      }

      var link = $(this);
      var href = link.attr('href');

      if (href === '#' || href === '' || is_url_external(href) || link.attr('target') === '_blank' || link.attr('target') === '_new') {
        return;
      }

      if (wait === true) {
        return;
      }

      wait = true;

      e.preventDefault();
      move(href, get_ajax_link_parent_index(href));
    });
  }

  /**
   * Get full url
   */
  function get_full_url(url) {
    var regex = new RegExp('^(http|https)+://', 'i');

    if (!regex.test(url)) {
      if (url === './') {
        url = '';
      }

      return base_url + '/' + url;
    }

    return url;
  }

  /**
   * Animate background
   */
  function animate_background(index, speed) {
    var interval = 100 / (menu_items.length - 1);
    var background_position = interval * index;
    var site_bg = $('#site-bg').get(0);

    $('#site-bg').animate({'border-x': background_position}, {duration: speed, step: function(now) {
      site_bg.style.backgroundPosition = now + '% center';
    }});
  }

  /**
   * Make main nav mobile friendly
   */
  function mobile_menu() {
    var menu_mobile = $('#nav').clone().attr('id', 'nav-mobile').removeClass('nav-desktop').appendTo('body');
    var menu_links = menu_mobile.find('li');
    var trigger = $('#mobile-nav-trigger');

    menu_links.find('a').on('click', function(e) {
      if (is_ajax_enabled) {
        e.preventDefault();
        var link = $(this);
        menu_links.filter('.current-menu-item').removeClass('current-menu-item');
        link.parent().addClass('current-menu-item');
        trigger.removeClass('active');
        menu_mobile.removeClass('active');
      }
    });

    trigger.on('click', function(e) {
      e.preventDefault();
      trigger.toggleClass('active');
      if (trigger.hasClass('active')) {
        menu_mobile.css({
          top: (trigger.offset().top + trigger.height()) + 'px'
        });
        menu_mobile.addClass('active');
      } else {
        menu_mobile.removeClass('active');
      }
    });
  }

  /**
   * Update nav pointer position
   */
  function update_pointer(menu_item, animation) {
    var left = menu_item.offset().left + (menu_item.width() / 2) - (pointer.outerWidth() / 2);
    animation = (typeof animation !== 'undefined') ? animation : true;

    if (animation && pointer.is(':visible')) {
      pointer.stop().animate({left: left + 'px'});
    } else {
      pointer.css({display: 'block', left: left + 'px'}, {duration: 200});
    }
  }

  // Mobile menu (call before ajax_links() function)
  mobile_menu();

  var base_url = dm3Theme.baseUrl;
  var is_ajax_enabled = $('body').hasClass('ajax-enabled');
  var menu_items = $('#nav > li');
  var cur_index = menu_items.filter('.current-menu-item, .current-menu-ancestor').index();
  var pointer = $('#nav-pointer');

  if (is_ajax_enabled && history.pushState) {
    ajax_links();

    var ajax_movements = 0;
    var nav_links = $('#nav a');
    var scroller = new Dm3Scroller($('.dm3-scroller'));
    var current_url = window.location.href;
    var wentfromhistory = false;
    var wait = false;
    var wpcf7_get = null;
    var loadPageArgs = {
      url: '',
      direction: '',
      contentSelector: '.content:first',
      speed: 900,
      easing: 'easeInOutExpo',
      beforeAnimationCallback: function() {
        // Update page title and history
        document.title = this.title;

        if (!wentfromhistory) {
          history.pushState(this, this.title, this.url);
        } else {
          wentfromhistory = false;
        }

        current_url = window.location.href;
        ajax_movements++;
      },
      afterNewContentCallback: function(new_content) {
        if (typeof dm3_page_initialize === 'function') {
          dm3_page_initialize($, new_content);
        }
      },
      completeCallback: function(context) {
        wait = false;
        ajax_links(context);
        header_search();

        // Trigger contact form 7
        var wpcf7_url = get_full_url('wp-content/plugins/contact-form-7/includes/js/scripts.js');

        if (!wpcf7_get) {
          wpcf7_get = $.get(wpcf7_url, function(response) {
            wpcf7_get = null;
            response = response.substring(0, response.indexOf('$.fn.wpcf7InitForm'));
            response = response.replace(/div\.wpcf7 > form/g, '.dm3-scroller-inner > .content div.wpcf7 > form');
            response += '});';
            $.globalEval(response);
          });
        }
      },
      errorCallback: function() {
        wait = false;
      }
    };

    // Process browser default history movement
    if (history.pushState) {
      $(window).on('popstate', function(e) {
        var state = e.originalEvent.state;

        if (state) {
          // This history entry was created manually
          if (ajax_movements > 0) {
            if (wait) {return;}
            wait = true;
            wentfromhistory = true;
            move(state.url, get_ajax_link_parent_index(state.url));
          } else if (ajax_movements === 0) {
            ajax_movements++;
          }
        }
      });

      // make initial history record
      var url = window.location.href;
      history.replaceState({url: url, title: document.title}, document.title, url);
    }
  } else {
    menu_items.hover(function() {
      update_pointer($(this));
    }, function(e) {
      if (cur_index >= 0) {
        update_pointer(menu_items.eq(cur_index));
      } else if (e.toElement.nodeName !== 'A') {
        pointer.css('display', 'none');
      }
    });
  }

  // Set pointer to current menu item
  if (cur_index >= 0) {
    animate_background(cur_index, 0);
  }

  // Update top nav links pointer position
  $(window).load(function() {
    if (cur_index >= 0) {
      update_pointer(menu_items.eq(cur_index), false);
    }
  });

  // Move pointer when window resizes
  $(window).resize(function() {
    if (cur_index >= 0) {
      update_pointer(menu_items.eq(cur_index), false);
    }
  });

  // Search
  var search_trigger = $('#search-trigger');

  function header_search() {
    var header_search_div = $('#header-search');

    if (header_search_div.is(':visible')) {
      search_trigger.addClass('active');
      header_search_div.find('input[type="text"]:first').focus();
    } else {
      search_trigger.removeClass('active');
    }
  }

  if (search_trigger.length) {
    header_search();

    search_trigger.on('click', function(e) {
      var header_search_div = $('#header-search');
      e.preventDefault();

      if (header_search_div.is(':visible')) {
        header_search_div.hide();
        search_trigger.removeClass('active');
      } else {
        header_search_div.show();
        search_trigger.addClass('active');
        header_search_div.find('input[type="text"]:first').focus();
        $('html, body').stop().animate({scrollTop: 0}, {duration: 300});
      }
    });
  }

  // Scrolling header
  var wnd = $(window);
  var body = $('body');

  wnd.scroll(function() {
    if (wnd.width() < 768) {return;}

    if (wnd.scrollTop() > 60) {
      if (!body.hasClass('on-scroll')) {
        body.addClass('on-scroll');
      }
    } else {
      if (body.hasClass('on-scroll')) {
        body.removeClass('on-scroll');
      }
    }
  });

  wnd.resize(function() {
    if (wnd.width() < 768) {
      if (body.hasClass('on-scroll')) {
        body.removeClass('on-scroll');
      }
    } else {
      if (wnd.scrollTop() > 60) {
        if (!body.hasClass('on-scroll')) {
          body.addClass('on-scroll');
        }
      }
    }
  });

  // Add shadow in ie8
  var is_ie8 = false;

  if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
    var ieversion = parseInt(RegExp.$1, 10);
    if (ieversion === 8) {
      is_ie8 = true;
    }
  }

  if (is_ie8) {
    $('<div class="ie8-shadow"></div>').insertAfter('#site-nav');
  }

})(jQuery);