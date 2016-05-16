/**
 * Dm3JsForm
 * Dynamically generates HTML forms
 */

var getDm3JsForm = null; // Function to instantiate Dm3JsForm and return it

(function($) {
  
  "use strict";
  
  /**
   * Construct
   *
   * @param options Object
   */
  function Dm3JsForm(options) {
    this.el = $('<div></div>');
    this.fields = {};
    this.options = $.extend({
      rowClass: 'js-settings-field',
      rowActionClass: 'js-settings-action',
      rowBoxesClass: 'js-settings-boxes',
      fieldClass: 'js-settings-control',
      boxClass: 'js-settings-box',
      boxActiveClass: 'js-settings-box-active',
      boxesContainerClass: 'js-settings-boxes'
    }, options);
  }
  
  /**
   * Add text input
   * 
   * @param opt Object
   */
  Dm3JsForm.prototype.addTextInput = function(opt) {
    opt = $.extend({
      name: '',
      label: '',
      value: ''
    }, opt);
    
    var field = $('<div class="' + this.options.rowClass + '"></div>');
    var input = $('<input type="text" name="' + opt.name + '">');

    if (opt.label) {
      field.append('<label>' + opt.label + '</label>');
    }
    
    if (opt.value) {
      input.val(opt.value);
    }
    
    field.append($('<div class="' + this.options.fieldClass + '"></div>').append(input));
    this.el.append(field);
    
    this.fields[opt.name] = {
      type: 'text',
      options: opt,
      field: input
    };
  };
  
  /**
   * Add textarea
   * 
   * @param opt Object
   */
  Dm3JsForm.prototype.addTextArea = function(opt) {
    opt = $.extend({
      name: '',
      label: '',
      value: '',
      rows: null,
      cols: null
    }, opt);
    
    var field = $('<div class="' + this.options.rowClass + '"></div>');
    var textarea = $('<textarea name="' + opt.name + '" />');

    if (opt.rows) {
      textarea.attr('rows', opt.rows);
    }

    if (opt.cols) {
      textarea.attr('cols', opt.cols);
    }
    
    if (opt.label) {
      field.append('<label>' + opt.label + '</label>');
    }
    
    if (opt.value) {
      textarea.val(opt.value);
    }
    
    field.append($('<div class="' + this.options.fieldClass + '"></div>').append(textarea));
    this.el.append(field);
    
    this.fields[opt.name] = {
      type: 'textarea',
      options: opt,
      field: textarea
    };
  };
  
  /**
   * Add select field
   * 
   * @param opt Object
   */
  Dm3JsForm.prototype.addSelect = function(opt) {
    opt = $.extend({
      name: '',
      label: '',
      multiple: false,
      options: []
    }, opt);
    
    var field = $('<div class="' + this.options.rowClass + '"></div>');
    var select = $('<select name="' + opt.name + '"></select>');
    var option;
    var i;
    
    for (i = 0; i < opt.options.length; i++) {
      option = $('<option value="' + opt.options[i].value + '">' + opt.options[i].label + '</option>');
      
      if (opt.options[i].selected) {
        option.attr('selected', 'selected');
      }
      
      select.append(option);
    }
    
    if (opt.label) {
      field.append('<label>' + opt.label + '</label>');
    }
    
    if (opt.multiple) {
      select.attr('multiple', 'multiple');
    }
    
    field.append($('<div class="' + this.options.fieldClass + '"></div>').append(select));
    this.el.append(field);
    
    this.fields[opt.name] = {
      type: 'select',
      options: opt,
      field: select
    };
  };
  
  /**
   * Add boxes
   * 
   * @param opt Object
   */
  Dm3JsForm.prototype.addBoxes = function(opt) {
    opt = $.extend({
      name: '',
      label: '',
      defaultCss: {},
      activeCss: {},
      options: []
    }, opt);
    
    var field = $('<div class="' + this.options.rowClass + ' ' + this.options.rowBoxesClass + '"></div>');
    var hidden = $('<input type="hidden" name="' + opt.name + '" />');
    var option;
    var boxesContainer, box, active_box_index;
    var i;
    var that = this;
    var box_on_click = function(e) {
      var _this = $(this);
      _this.siblings('.' + that.options.boxActiveClass + ':first').css(opt.defaultCss).removeClass(that.options.boxActiveClass);
      _this.css(opt.activeCss).addClass(that.options.boxActiveClass);
      _this.parent().parent().find('input[name="' + opt.name + '"]:first').val(_this.data('value'));
      e.preventDefault();
    };
    
    boxesContainer = $('<div></div>').addClass(this.options.boxesContainerClass);
    for (i = 0; i < opt.options.length; i++) {
      option = opt.options[i];
      box = $('<a href="#"></a>').addClass(this.options.boxClass);
      box.css(opt.defaultCss);
      box.data('value', option.value);
      if (option.label) {
        box.attr('title', option.label);
      }
      box.html(option.content);
      box.on('click', box_on_click);
      boxesContainer.append(box);
      if (option.selected) {
        box.trigger('click');
      }
    }
    
    if (opt.label) {
      field.append('<label>' + opt.label + '</label>');
    }
    
    field.append(boxesContainer);
    field.append(hidden);
    this.el.append(field);
    
    this.fields[opt.name] = {
      type: 'boxes',
      name: opt.name,
      options: opt,
      field: hidden
    };
  };
  
  /**
   * Add button
   * 
   * @param opt Object
   */
  Dm3JsForm.prototype.addButton = function(opt) {
    opt = $.extend({
      label: '',
      class: '',
      callback: null
    }, opt);
    
    var field = $('<div class="' + this.options.rowActionClass + '"></div>');
    var button = $('<button>' + opt.label + '</button>');
    
    if (opt.class) {
      button.addClass(opt.class);
    }

    button.on('click', function(e) {
      if (typeof opt.callback === 'function') {
        opt.callback.call(button, e);
      }
    });
    
    field.append(button);
    this.el.append(field);
  };
  
  /**
   * Serialize
   * 
   * @return Object
   */
  Dm3JsForm.prototype.serialize = function() {
    var data = {};
    var prop;
    
    for (prop in this.fields) {
      if (this.fields.hasOwnProperty(prop)) {
        data[prop] = this.fields[prop].field.val();
      }
    }
    
    return data;
  };
  
  /**
   * Get form html element
   * 
   * @return Object
   */
  Dm3JsForm.prototype.getForm = function() {
    return this.el;
  };

  /**
   * Instantiate the Dm3JsForm object and return it
   *
   * @param options String
   *
   * @return Object
   */
  getDm3JsForm = function(options) {
    return new Dm3JsForm(options);
  }
  
})(jQuery);