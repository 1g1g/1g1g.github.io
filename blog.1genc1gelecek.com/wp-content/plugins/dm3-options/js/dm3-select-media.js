/**
 * Dm3MediaFrame
 * @version 1.0
 */
if (typeof dm3SelectMedia === 'undefined') {
  (function($) {
    if (typeof wp.media === 'undefined') { return; }

    var l10n = wp.media.view.l10n;
    
    dm3SelectMedia = wp.media.view.MediaFrame.Select.extend({
      initialize: function() {
        _.defaults(this.options, {
          multiple: true,
          editing: false,
          state: 'insert'
        });
        
        wp.media.view.MediaFrame.Select.prototype.initialize.apply(this, arguments);
        this.createIframeStates();
      },
    
    
      /**
       * Create states
       */
      createStates: function() {
        var options = this.options;
    
        // Add the default states.
        this.states.add([
          // Main states.
          new wp.media.controller.Library({
            id:         'insert',
            title:      l10n.insertMediaTitle,
            priority:   20,
            toolbar:    'main-insert',
            filterable: 'all',
            library:    wp.media.query( options.library ),
            multiple:   options.multiple ? 'reset' : false,
            editable:   true,
            // If the user isn't allowed to edit fields,
            // can they still edit it locally?
            allowLocalEdits: true,
            // Show the attachment display settings.
            displaySettings: true,
            // Update user settings when users adjust the
            // attachment display settings.
            displayUserSettings: true
          }),
    
          // Embed states.
          new wp.media.controller.Embed()
        ]);
      },
      
      
      /**
       * Bind event handlers
       */
      bindHandlers: function() {
        wp.media.view.MediaFrame.Select.prototype.bindHandlers.apply(this, arguments);
        this.on('toolbar:create:main-insert', this.createToolbar, this);
        this.on('toolbar:create:main-embed', this.mainEmbedToolbar, this);
    
        var handlers = {
          menu: {
            'default': 'mainMenu'
          },
    
          content: {
            'embed': 'embedContent',
            'edit-selection': 'editSelectionContent'
          },
    
          toolbar: {
            'main-insert': 'mainInsertToolbar'
          }
        };
    
        _.each( handlers, function( regionHandlers, region ) {
          _.each( regionHandlers, function( callback, handler ) {
            this.on( region + ':render:' + handler, this[ callback ], this );
          }, this );
        }, this );
      },
    
    
      /**
       * Menues
       */
      mainMenu: function(view) {
        view.set({
          'library-separator': new wp.media.View({
            className: 'separator',
            priority: 100
          })
        });
      },
    
      
      /**
       * Content
       */
      embedContent: function() {
        var view = new wp.media.view.Embed({
          controller: this,
          model: this.state()
        }).render();
    
        this.content.set(view);
        view.url.focus();
      },
      
      
      /**
       * Edit selection content
       */
      editSelectionContent: function() {
        var state = this.state(),
          selection = state.get('selection'),
          view;
    
        view = new wp.media.view.AttachmentsBrowser({
          controller: this,
          collection: selection,
          selection:  selection,
          model:      state,
          sortable:   true,
          search:     false,
          dragInfo:   true,
          AttachmentView: wp.media.view.Attachment.EditSelection
        }).render();
    
        view.toolbar.set( 'backToLibrary', {
          text: l10n.returnToLibrary,
          priority: -100,
          click: function() {
            this.controller.content.mode('browse');
          }
        });
    
        // Browse our library of attachments.
        this.content.set(view);
      },
    
      
      /**
       * Selection status toolbar
       */
      selectionStatusToolbar: function(view) {
        var editable = this.state().get('editable');
    
        view.set('selection', new wp.media.view.Selection({
          controller: this,
          collection: this.state().get('selection'),
          priority:   -40,
          // If the selection is editable, pass the callback to
          // switch the content mode.
          editable: editable && function() {
            this.controller.content.mode('edit-selection');
          }
        }).render() );
      },
    
    
      /**
       * Main insert toolbar
       */
      mainInsertToolbar: function(view) {
        var controller = this;
    
        this.selectionStatusToolbar(view);
    
        view.set('insert', {
          style: 'primary',
          priority: 80,
          text: this.options.button.text,
          requires: { selection: true },
          click: function() {
            var state = controller.state(),
                selection = state.get('selection');
            controller.close();
            state.trigger('insert', selection).reset();
          }
        });
      },
    
      
      /**
       * Main embed toolbar
       */
      mainEmbedToolbar: function(toolbar) {
        toolbar.view = new wp.media.view.Toolbar.Embed({
          controller: this
        });
      }
    });
    
    
    /**
     * Add media frame
     */
    dm3_media_frame = function(params) {
      var frame = new dm3SelectMedia({
        multiple: params.multiple,
        library: { type: 'image' },
        button: { text: params.insertLabel }
      });
      
      frame.on('close', function() {
        if (typeof params.callback !== 'undefined') {
          params.callback.call(null, frame.state());
        }
      });
      
      frame.open();
    };

    dm3_media_upload_button_click = function() {
      var button = $(this);
      var multiple = button.data('multiple');
      var size = button.data('size');
      
      if (typeof multiple === 'undefined') {
        multiple = false;
      }
      
      dm3_media_frame({
        multiple: multiple,
        insertLabel: button.data('insertlabel'),
        callback: function(state) {
          var item, url;
          var size = $('.attachment-display-settings select.size').val();
          
          if (state.id == 'embed') {
            item = state.props.toJSON();
            url = item.url;
          } else {
            item = state.get('selection').first();
            
            if (size && item.attributes.sizes && typeof item.attributes.sizes[size] !== 'undefined') {
              url = item.attributes.sizes[size].url;
            } else {
              url = item.attributes.url;
            }
          }
          
          button.prev('input').val(url);
        }
      });
    };

    $(document).ready(function() {
      /**
       * Media Uploader
       */
      $('body').on('click', '.upload-image-button', dm3_media_upload_button_click);
    });

  }(jQuery));
}