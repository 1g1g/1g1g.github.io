(function($) {

  /**
   * Dm3Appendo
   */
  function Dm3Appendo(el, options) {
    var that = this;
    this.el = $(el);
    this.options = options;
    this.btnAdd = $(options.btnAdd);
    this.btnAdd.insertAfter(this.el);
    this.btnAdd.on('click', function(e) {
      e.preventDefault();
      that.add();
    });
  }

  /**
   * Get child elements
   */
  Dm3Appendo.prototype.getElements = function() {
    return this.el.children(this.options.childSelector);
  };

  /**
   * Add element
   */
  Dm3Appendo.prototype.add = function() {
    var elements = this.getElements();
    var that = this;

    if (elements.length < this.options.max) {
      var clone = elements.eq(0).clone(false);
      clone.find('input[type="text"], textarea').val('');
      var remove = $(this.options.btnRemove);
      remove.on('click', function(e) {
        e.preventDefault();
        $(this).parent().detach().remove();
        if (that.getElements().length < that.options.max) {
          that.btnAdd.removeClass(that.options.disabledClass); 
        }
      });
      clone.append(remove);
      this.el.append(clone);

      if (elements.length + 1 === this.options.max) {
        this.btnAdd.addClass(this.options.disabledClass);
      }
    }
  };

  /**
   * jQuery plugin
   */
  $.fn.dm3Appendo = function(options) {
    options = $.extend({
      btnAdd: '<a href="#">Add</a>',
      btnRemove: '<a href="#">Remove</a>',
      disabledClass: 'disabled',
      childSelector: 'div',
      max: 15
    }, options);

    return this.each(function() {
      new Dm3Appendo(this, options);
    });
  }

}(jQuery));