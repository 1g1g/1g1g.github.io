(function($) {
  function Dm3Media() {
    var that = this;
    
    // Add media item
    $('div.dm3m_menu a.dm3m-add').live('click', function(e) {
      e.preventDefault();
      that.addSlide(this);
    });
    
    // Delete media item
    $('div.dm3m_menu a.dm3m-delete').live('click', function(e) {
      e.preventDefault();
      
      if (confirm('Are you sure?')) {
        that.deleteSlide(this);
      }
    });
    
    // Upload feature
    $('#dm3m_slides').on('click', '.dm3m_upload', function() {
      var $this = $(this),
          label = $this.attr('title');
      
      dm3_media_frame({
        multiple: false,
        insertLabel: $this.data('insertlabel'),
        callback: function(state) {
          var url,
              title,
              item,
              size = $('.attachment-display-settings select.size').val(),
              slide = $this.parent().parent();
          
          if (state.id == 'embed') {
            item = state.props.toJSON();
            url = item.url;
            if (typeof item.caption !== 'undefined') {
              title = item.caption;
            } else {
              title = item.title;
            }
          } else {
            item = state.get('selection').first();

            if (size && item.attributes.sizes && typeof item.attributes.sizes[size] !== 'undefined') {
              url = item.attributes.sizes[size].url;
            } else {
              url = item.attributes.url;
            }

            title = item.attributes.caption;
          }
          
          var media_type = that.getMediaType(url);
          var img = $this.parent().find('img:first');
          
          $this.prev().val(url);
          
          if (title) {
            slide.find('input[name="dm3m_title[]"]').val(title);
          }
          
          if (media_type !== 'video') {
            $this.closest('.slide').removeClass('slide-video');
          }
          
          if (media_type == 'audio') {
            img.attr('src', dm3MediaVars.pluginUrl + '/images/audio.jpg');
          } else if (media_type == 'video') {
            $this.closest('.slide').addClass('slide-video');
            img.attr('src', dm3MediaVars.pluginUrl + '/images/video.jpg');
          } else if (media_type == 'image') {
            img.attr('src', url);
            slide.find('input[name="dm3m_attachment_id[]"]:first').val(item.id);
          }
        }
      });
      
      return false;
    });
  }
  
  
  /**
   * Add slide
   */
  Dm3Media.prototype.addSlide = function(raw_btn) {
    var btn = $(raw_btn),
        slide = btn.parent().parent(),
        clone = slide.clone();
    
    clone.attr('class', 'slide');
    
    clone.find('input, select, textarea').each(function(i) {
      this.value = '';
    });
    
    clone.find('img:first').attr('src', dm3MediaVars.pluginUrl + '/images/image.jpg');
    
    clone.css({
      display: 'none'
    });
    
    slide.after(clone);
    clone.slideDown();
  };
  
  
  /**
   * Delete slide
   */
  Dm3Media.prototype.deleteSlide = function(raw_btn) {
    var btn = $(raw_btn),
        slide = btn.parent().parent();
    
    if ($('#dm3m_slides li.slide').size() == 1) {
      slide.find('input, select, textarea').each(function(i) {
        this.value = '';
      });
      
      slide.find('img:first').attr('src', dm3MediaVars.pluginUrl + '/images/image.jpg');
      slide.find('input[name="dm3m_src[]"]:first').val('');
      slide.find('a.dm3m_delete_src:first').detach();
      slide.find('img:first').attr('src', dm3MediaVars.pluginUrl + '/images/image.jpg');
    } else {
      slide.slideUp(300, function() {
        $(this).remove();
      });
    }
  };
  
  
  /**
   * Get media type
   */
  Dm3Media.prototype.getMediaType = function(url) {
    if (url.indexOf('youtube.com') > 0 || url.indexOf('vimeo.com') > 0 || url.indexOf('youtu.be') > 0) {
      return 'video';
    }
    
    var parts = url.split('.'),
        ext = parts[parts.length - 1];
    
    switch (ext) {
      case 'jpg':
      case 'jpeg':
      case 'png':
      case 'gif':
      case 'tiff':
        return 'image';
        break;
        
      case 'mp4':
        return 'video';
        break;
      
      case 'mp3': 
      case 'ogg':
      case 'm4a':
        return 'audio';
        break;
      
      default:
        return null;
    }
  };
  
  
  $(document).ready(function() {
    /**
     * Dm3Media initialization
     */
    new Dm3Media();
    
    /**
     * UI sortable
     */
    $("#dm3m_slides").sortable({
      placeholder: 'slide_highlight'
    });
  });
}(jQuery));