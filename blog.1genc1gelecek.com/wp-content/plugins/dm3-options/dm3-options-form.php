<?php
/**
 * Dm3OptionsForm
 *
 * @package Dm3Options
 * @since Dm3Options 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {exit();}

require_once 'dm3-admin-form.php';

/**
 * Theme Options
 */
class Dm3OptionsForm {
  private $fields = array();
  private $options = array();
  private $categories = array();
  private $saved = null;
  
  /**
   * Constructor
   */
  public function __construct($fields, $option) {
    if (is_array($fields)) {
      $this->fields = $fields;
    }
    
    if (is_string($option) && !empty($option)) {
      $this->options = get_option($option, array());
    }
  }
  
  /**
   * Get options
   * 
   * @return array
   */
  public function getOptions() {
    return $this->options;
  }
  
  /**
   * Get fields
   * 
   * @return array
   */
  public function getFields() {
    return $this->fields;
  }
  
  /**
   * Get categories
   * 
   * @return array
   */
  public function getCategories() {
    return $this->categories;
  }
  
  /**
   * Check if options were saved
   * 
   * @return boolean
   */
  public function isSaved() {
    return $this->saved;
  }

  /**
   * Set option
   */
  public function setOption( $key, $value ) {
    $this->options[$key] = $value;
  }

  /**
   * Save theme options
   * 
   * @param string $options_name
   */
  public function save($options_name) {
    if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'dm3_options')) {
      foreach ($this->fields as $key => $f) {
        if (!isset($_POST[$key])) {
          if ($f['type'] == 'checkbox') {
            $this->options[$key] = '';
          }
          
          continue;
        }
        
        $value = $_POST[$key];

        // Filter the input
        if (!isset($f['filter'])) {
          $f['filter'] = '';
        }
        
        switch ($f['filter']) {
          case 'int':
            $value = intval($value);
            break;
            
          case 'none':
            if (current_user_can('unfiltered_html')) {
              break;
            }
            
          default:
            if ($f['type'] == 'select') {
              $valid = false;
              foreach ($f['options'] as $k => $val) {
                if (is_array($val)) {
                  foreach ($val['options'] as $k => $val) {
                    if ($k == $value) {
                      $valid = true;
                      break;
                    }
                  }
                } else if ($k == $value) {
                  $valid = true;
                  break;
                }
              }
              
              if (!$valid) {
                $value = '';
              }
            } else if (($f['type'] == 'radios' || $f['type'] == 'pages')
              && is_array($f['options']) && !array_key_exists($value, $f['options'])) {
              $value = '';
            } else if ($f['type'] == 'coloroptions') {
              if (!in_array($value, $f['options']))
                $value = '';
            } else {
              $value = htmlspecialchars($value);
            }
        }
        
        $this->options[$key] = $value;
      }
      
      $this->options = stripslashes_deep($this->options);
      update_option($options_name, $this->options);
      $this->saved = true;
    }
  }

  /**
   * Output a single field
   * 
   * @param string $name
   * @param array $field
   */
  public function showField($name, $field) {
    $func = 'field' . ucfirst($field['type']);
    $value = isset($this->options[$name]) ? htmlspecialchars($this->options[$name]) : (isset($field['value']) ? htmlspecialchars($field['value']) : '');

    if (method_exists('Dm3AdminForm', $func)) {
      echo call_user_func(array('Dm3AdminForm', $func), $name, $value, $field);
    }
  }
  
  /**
   * Output the form from options array
   */
  public function showForm() {
    ?>
    <form id="dm3_form" class="dm3_form" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('dm3_options'); ?>" />

      <ul class="tabs-nav">
      <?php
      $i = 1;
      foreach ($this->categories as $c) {
        ?>
        <li><a href="#<?php echo $i++; ?>"><?php echo $c['label']; ?></a></li>
        <?php
      }
      ?>
      </ul>

      <div class="tabs">
        <?php
        $i = 1;
        foreach ($this->categories as $c) {
          ?>
          <div id="<?php echo $i++; ?>" class="tab">
            <div class="dm3-form-elements">
            <?php
            foreach ($c['fields'] as $field) {
              $this->showField($field, $this->fields[$field]);
            }
            ?>
            </div>
            <?php
            if ( $c['footer'] ) {
              echo $c['footer'];
            }
            ?>
          </div>
          <?php
        }
        ?>

        <input type="hidden" name="cur_tab_idx" value="<?php if (isset($_POST['cur_tab_idx'])) echo intval($_POST['cur_tab_idx']); ?>">
      </div>
    </form>
    <?php
  }

  /**
   * Group options in categories
   * 
   * @param string $label
   * @param array $fields
   * @param string $footer
   */
  public function addCategory($label, $fields, $footer = null) {
    $this->categories[] = array(
      'label' => $label,
      'fields' => $fields,
      'footer' => $footer
    );
  }
}