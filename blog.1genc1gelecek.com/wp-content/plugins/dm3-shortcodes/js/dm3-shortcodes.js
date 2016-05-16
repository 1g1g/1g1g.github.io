/**
 * dm3Shortcodes TinyMCE plugin
 * Adds shortcodes list menu button
 */
(function() {
  var form_options = {
    rowClass: 'dm3sc-form-element',
    rowActionClass: 'dm3sc-form-action',
    rowBoxesClass: 'dm3sc-form-boxes',
    fieldClass: 'dm3sc-form-field',
    boxClass: 'dm3sc-settings-box',
    boxActiveClass: 'dm3sc-settings-box-active',
    boxesContainerClass: 'dm3sc-settings-boxes dm3sc-form-field'
  };

  /**
   * Generate shortcode tag from the form
   * 
   * @param name String
   * 
   * @return String
   */
  var get_shortcode_tag = function(shortcode, form) {
    var prop;
    
    for (prop in form.fields) {
      if (form.fields.hasOwnProperty(prop)) {
        shortcode = shortcode.replace(new RegExp('@' + prop, 'g'), form.fields[prop].field.val());
      }
    }
    
    return shortcode;
  };

  /**
   * Add option to form
   *
   * @param name String
   * @param option String
   * @param form Dm3JsForm
   */
  function add_option_to_form(name, option, form) {
    switch(option.type) {
      case 'text':
        form.addTextInput({
          name: name,
          label: option.label
        });
        break;

      case 'textarea':
        form.addTextArea({
          name: name,
          label: option.label,
          rows: 3
        });
        break;

      case 'select':
        form.addSelect({
          name: name,
          label: option.label,
          multiple: false,
          options: option.options
        });
        break;

      case 'boxes':
        form.addBoxes({
          name: name,
          label: option.label,
          options: option.options,
          defaultCss: option.defaultCss,
          activeCss: option.activeCss
        });
        break;
    }
  }

  /**
   * Display simple shortcode options in a content box
   *
   * @param name String
   * @param options Object
   */
  function display_shortcode_options(shortcode) {
    var options = shortcode.options,
        option = null;

    var form = getDm3JsForm(form_options);

    // Generate options for the shortcode
    for (option in options) {
      if (options.hasOwnProperty(option)) {
        add_option_to_form(option, options[option], form);
      }
    }

    // Add shortcode to TinyMCE button
    form.addButton({
      label: dm3scTr.labelInsertButton,
      class: 'button button-primary',
      callback: function() {
        var tag = get_shortcode_tag(shortcode.shortcode, form);
        box.find('.dm3-content-box-close:first').trigger('click');
        tinymce.activeEditor.execCommand('mceInsertContent', false, tag);
      }
    });

    var form_el = form.getForm();

    // Open content box popup to display the options
    var box = dm3ContentBox({
      width: 505,
      height: 600,
      title: shortcode.label,
      content: form_el
    });

    // Shortcode callback
    if (shortcode.callback) {
      new Function('form_el', shortcode.callback)(form_el);
    }
  }

  /**
   * Display options for shortcode with child shortcodes
   *
   * @param shortcode Object
   */
  function display_shortcode_options_with_children(shortcode) {
    var child_shortcode = shortcode.child_shortcode,
        options = child_shortcode.options,
        option;

    // Parent shortcode options
    var parent_form = getDm3JsForm(form_options);
    var parent_options = shortcode.options;

    for (option in parent_options) {
      if (parent_options.hasOwnProperty(option)) {
        add_option_to_form(option, parent_options[option], parent_form);
      }
    }

    // Generate options for the first child shortcode
    var form = getDm3JsForm(form_options);

    for (option in options) {
      if (options.hasOwnProperty(option)) {
        add_option_to_form(option, options[option], form);
      }
    }

    // Create html for child shortcodes
    var shortcodes_html = $('<div></div>');
    var child_shortcodes = $('<div class="dm3sc-child-shortcodes"></div>');
    var first_shortcode = form.getForm();

    child_shortcodes.append(first_shortcode);
    shortcodes_html.append(parent_form.getForm());
    shortcodes_html.append(child_shortcodes);

    // Open content box
    var box = dm3ContentBox({
      width: 505,
      height: 600,
      title: shortcode.label,
      content: shortcodes_html
    });

    // Add "add/remove" functionality to child shortcodes
    child_shortcodes.dm3Appendo({
      btnAdd: '<a class="button" href="#">' + child_shortcode.addButtonLabel + '</a>',
      btnRemove: '<a class="dm3sc-appendo-remove" href="#">&times;</a>',
      max: shortcode.max,
      disabledClass: 'dm3sc-appendo-disabled'
    });

    // Make child shortcodes sortable
    child_shortcodes.sortable({
      placeholder: 'dm3sc-placeholder',
      start: function(e, ui) {
        ui.placeholder.height(ui.helper.height());
      }
    });

    // Process insert button action
    var insert_button = $('<a class="button button-primary" href="#">' + dm3scTr.labelInsertButton + '</a>');

    insert_button.on('click', function(e) {
      e.preventDefault();
      var child_tag = '';
      var child_tags = child_shortcodes.children('div');

      child_tags.each(function() {
        var $this = $(this), value, field_selector, tag = child_shortcode.shortcode;

        // Replace placeholders with values
        for (option in options) {
          if (options.hasOwnProperty(option)) {
            // Clear form elements
            switch(options[option].type) {
              case 'text':
                field_selector = 'input';
                break;

              case 'textarea':
                field_selector = 'textarea';
                break;

              case 'select':
                field_selector = 'select';
                break;
            }

            value = $this.find(field_selector + '[name="' + option + '"]').val();

            // Replace placeholder
            tag = tag.replace(new RegExp('@' + option, 'g'), value);
          }
        }

        // Add processed tag to the list
        tag = '<p>' + tag + '</p>';
        child_tag += tag;
      });

      // Copy generated child shortcodes to the main shortcode tag
      var tag = get_shortcode_tag(shortcode.shortcode, parent_form);
      tag = tag.replace('@child_shortcode', child_tag);

      // Close the content box popup
      box.find('.dm3-content-box-close:first').trigger('click');

      // Insert tag into TinyMCE
      tinymce.activeEditor.execCommand('mceInsertContent', false, tag);
    });

    // Generate shortcode options button
    var add_button = child_shortcodes.next('.button');

    $('<div class="dm3sc-form-action"></div>').append(add_button).append(insert_button).appendTo(box.find('.dm3-content-box-inner:first'));
  }

  // Create TinyMCE plugin
  tinymce.create('tinymce.plugins.dm3Shortcodes', {
    createControl: function(n, cm) {
      // Add this plugin to dm3Shortcodes button that was added using Wordpress's mce_buttons filter
      if (n === 'dm3Shortcodes') {
        var mb = cm.createMenuButton('dm3Shortcodes', {
          title: 'Shortcodes',
          image: dm3scTr.pluginUrl + 'images/button-icon.png',
          icons: false
        });

        // Generate the menu
        mb.onRenderMenu.add(function(c, m) {
          var sub;
          var i;

          // Iterate through each shortcode or shortcodes category
          for (i in dm3sc) {
            if (dm3sc.hasOwnProperty(i)) {
              if (!dm3sc[i].shortcodes) {
                // Single shorcode, not a category
                m.add({
                  title: dm3sc[i].label,
                  onclick: (function(shortcode) {
                    return function() {
                      // Display shortcode options
                      if (shortcode.child_shortcode) {
                        display_shortcode_options_with_children(shortcode);
                      } else {
                        display_shortcode_options(shortcode);
                      }
                    };
                  })(dm3sc[i])
                });
              } else {
                // Category of shortcodes
                sub = m.addMenu({title: dm3sc[i].label});
                var subscname, subsc;
                for (subscname in dm3sc[i].shortcodes) {
                  if (dm3sc[i].shortcodes.hasOwnProperty(subscname)) {
                    subsc = dm3sc[i].shortcodes[subscname];
                    sub.add({
                      title: subsc.label,
                      onclick: (function(shortcode) {
                        return function() {
                          // Display shortcode options
                          if (shortcode.child_shortcode) {
                            display_shortcode_options_with_children(shortcode);
                          } else {
                            display_shortcode_options(shortcode);
                          }
                        };
                      })(subsc)
                    });
                  }
                }
              }
            }
          }
        });

        return mb;
      }

      return null;
    }
  });

  tinymce.PluginManager.add('dm3Shortcodes', tinymce.plugins.dm3Shortcodes);
})();