if (typeof $ === 'undefined') {
  $ = jQuery;
}

/**
 * Content box
 *
 * @param options Object
 *
 * @return Object
 */
function dm3ContentBox(options) {
  // Options
  options = $.extend({
    title: null,
    content: null,
    width: null,
    height: null
  }, options);

  // Create box html
  var box = $('<div class="dm3-content-box"><div class="dm3-content-box-inner"></div></div>');
  var box_inner = box.find('.dm3-content-box-inner:first');

  if (options.title) {
    var title = $('<div class="dm3-content-box-title">' + options.title + '</div>');
    box.prepend(title);
  }

  // Add close button
  var close = $('<a class="dm3-content-box-close" href="#">&times;</a>').appendTo(box);
  close.on('click', function() {
    box.detach().remove();
    $('#dm3-content-box-overlay').detach().remove();
  });

  // Add content and append the box to the document body
  box.find('.dm3-content-box-inner:first').append(options.content);
  box.appendTo('body');
  
  // Box dimensions
  if (options.width && options.height) {
    box.css({
      width: options.width + 'px',
      height: options.height + 'px'
    });
  }

  var width = box.width();
  var height = box.height();

  // Show the box
  $('body').append('<div id="dm3-content-box-overlay"></div>');
  
  box_inner.css({
    width: width + 'px',
    height: (height - title.outerHeight(true)) + 'px'
  });

  box.css({
    marginLeft: '-' + (width / 2) + 'px',
    marginTop: '-' + (height / 2) + 'px',
    visibility: 'visible'
  });

  // Return box jQuery element
  return box;
}