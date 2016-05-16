<div class="wrap">
  <div id="icon-themes" class="icon32"><br></div>
  <h2 id="dm3sb-options-title"><?php _e( 'Custom sidebars', 'dm3-sidebars' ); ?></h2>

  <p>
    <?php
    _e( 'This plugin allows you to create custom sidebars for the following post types: ', 'dm3-sidebars' );

    $i = 0;
    $num_post_types = count( $post_types );

    foreach ( $post_types as $post_type ) {
      if ( $i > 0 && $i < $num_post_types ) {
        echo ', ';
      }

      echo '<strong>' . htmlspecialchars( $post_type ) . '</strong>';

      $i++;
    }
    ?>.
  </p>

  <h3 class="title"><?php _e( 'Add sidebar', 'dm3-sidebars' ); ?></h3>

  <form id="form-add-sidebar">
    <table class="form-table">
      <tbody>
        <tr>
          <th><label for="input-sidebar-name"><?php _e( 'Sidebar name', 'dm3-sidebars' ); ?></label></th>
          <td><input name="sidebar_name" id="input-sidebar-name" type="text" class="regular-text code"></td>
        </tr>
      </tbody>
    </table>

    <p class="submit">
      <input type="submit" name="submit" id="input-add-sidebar" class="button button-primary" value="<?php _e( 'Add sidebar', 'dm3-sidebars' ); ?>">
    </p>
  </form>

  <table id="dm3sb-sidebars" class="wp-list-table widefat fixed">
    <thead>
      <tr>
        <th scope="col" class="manage-column"><?php _e( 'Sidebar name', 'dm3-sidebars' ); ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ( $sidebars as $sidebar ) { ?>
      <tr class="alternate">
        <td scope="row">
          <strong><?php echo htmlspecialchars( $sidebar ); ?></strong>

          <div class="row-actions">
            <span class="trash">
              <a class="submitdelete" title="Delete" href="#"><?php _e( 'Delete', 'dm3-sidebars' ); ?></a>
            </span>
          </div>
        </td>
      </tr>
      <?php } ?>
    </tbody>

    <tfoot>
      <tr>
        <th scope="col" class="manage-column"><?php _e( 'Sidebar name', 'dm3-sidebars' ); ?></th>
      </tr>
    </tfoot>
  </table>
</div>

<script type="text/javascript">
(function($) {
  /**
   * Show message
   */
  function show_message(message_text) {
    var message = $('#dm3sb-message');

    if (!message.length) {
      message = $('<div id="dm3sb-message" class="updated settings-error"></div>');
      message.insertAfter('#dm3sb-options-title');
    }

    message.html('<p><strong>' + message_text + '</strong></p>');
    message.show();
  }

  /**
   * Hide message
   */
  function hide_message() {
    $('#dm3sb-message').hide();
  }

  /**
   * Sidebar row template
   */
  function sidebar_row_template(name) {
    return '<tr><td scope="row"><strong>' + name + '</strong><div class="row-actions"><span class="trash"><a class="submitdelete" title="Delete" href="#"><?php _e( 'Delete', 'dm3-sidebars' ); ?></a></span></div></td></tr>';
  }

  /**
   * Delete sidebar
   */
  function delete_sidebar(args) {
    hide_message();

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: ajaxurl,
      data: {
        action: 'dm3sb_delete_sidebar',
        name: args.name
      },
      success: function(response) {
        if (response.status === 'success') {
          if (args.cb) {
            args.cb.apply();
          }
        }

        if (response.message) {
          show_message(response.message);
        }
      }
    });
  }

  /**
   * Add sidebar
   */
  function add_sidebar(args) {
    input_add_sidebar.attr('disabled', 'disabled');
    hide_message();

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: ajaxurl,
      data: {
        action: 'dm3sb_add_sidebar',
        name: args.name
      },
      success: function(response) {
        if (response.status === 'success') {
          var sidebar_row = $(sidebar_row_template(args.name));

          sidebar_row.find('.submitdelete').on('click', function(e) {
            e.preventDefault();

            delete_sidebar({
              name: args.name,
              cb: function() {
                sidebar_row.remove();
              }
            });
          });

          $('#dm3sb-sidebars > tbody').append(sidebar_row);

          if (!sidebar_row.prev('tr').hasClass('alternate')) {
            sidebar_row.addClass('alternate');
          }

          input_sidebar_name.val('');
        }

        if (response.message) {
          show_message(response.message);
        }

        input_add_sidebar.removeAttr('disabled');
      }
    });
  }

  var message = $('#dm3sb-message');
  var input_sidebar_name = $('#input-sidebar-name');
  var form_add_sidebar = $('#form-add-sidebar');
  var input_add_sidebar = $('#input-add-sidebar');

  form_add_sidebar.on('submit', function(e) {
    e.preventDefault();

    add_sidebar({
      name: input_sidebar_name.val()
    });
  });

  $('#dm3sb-sidebars > tbody > tr').each(function() {
    var tr = $(this);
    var name = tr.find('> td > strong:first').text();

    tr.find('.submitdelete').on('click', function(e) {
      e.preventDefault();

      delete_sidebar({
        name: name,
        cb: function() {
          tr.remove();
        }
      });
    });
  });
})(jQuery);
</script>