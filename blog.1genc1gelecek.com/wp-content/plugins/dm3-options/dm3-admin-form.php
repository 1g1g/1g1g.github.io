<?php
/**
 * Dm3AdminForm
 *
 * @package Dm3Options
 * @since Dm3Options 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {exit();}

if ( ! class_exists( 'Dm3AdminForm' ) ) {
  class Dm3AdminForm {
    /**
     * Text field
     *
     * @param string $name
     * @param string $value
     * @param array $f
     *
     * @return string
     */
    public static function fieldText($name, $value, $f) {
      if (!isset($f['size'])) $f['size'] = 50;
      if (!isset($f['maxlength'])) $f['maxlength'] = 50;
      if (!isset($f['id'])) $f['id'] = '';
      
      $for = ($f['id']) ? ' for="' . $f['id'] . '"' : '';
      $id = ($f['id']) ? ' id="' . $f['id'] . '"' : '';
      $type = ($f['type'] === 'password') ? 'password' : 'text';
      $output = '<div class="dm3-form-element"><label' . $for . '>' . $f['label'] . '</label><div class="dm3-form-field">';
      $output .= '<input type="' . $type . '"' . $id . ' class="dm3-textinput regular-text" name="' . $name . '" value="' . $value . '" size="' . $f['size'] . '" maxlength="' . $f['maxlength'] . '" />';

      if (isset($f['description'])) {
        $output .= '<div class="dm3-form-element-description">' . $f['description'] . '</div>';
      }

      $output .= '</div></div>';
      
      return $output;
    }
    
    /**
     * Password field
     *
     * @param string $name
     * @param string $value
     * @param array $f
     *
     * @return string
     */
    public static function fieldPassword($name, $value, $f) {
      self::fieldText($name, $value, $f);
    }
    
    /**
     * Textarea
     *
     * @param string $name
     * @param string $value
     * @param array $f
     *
     * @return string
     */
    public static function fieldTextarea($name, $value, $f) {
      if (!isset($f['cols'])) $f['cols'] = 50;
      if (!isset($f['rows'])) $f['rows'] = 4;
      if (!isset($f['id'])) $f['id'] = '';

      $for = ($f['id']) ? ' for="' . $f['id'] . '"' : '';
      $id = ($f['id']) ? ' id="' . $f['id'] . '"' : '';
      $output = '<div class="dm3-form-element"><label' . $for . '>' . $f['label'] . '</label><div class="dm3-form-field">';
      $output .= '<textarea' . $id . ' class="dm3-textarea" name="' . $name . '" cols="' . $f['cols'] . '" rows="' . $f['rows'] . '">' . $value . '</textarea>';

      if (isset($f['description'])) {
        $output .= '<div class="dm3-form-element-description">' . $f['description'] . '</div>';
      }

      $output .= '</div></div>';
      
      return $output;
    }
      
    /**
     * Select box
     *
     * @param string $name
     * @param string $value
     * @param array $f
     *
     * @return string
     */
    public static function fieldSelect($name, $value, $f) {
      if (!isset($f['id'])) $f['id'] = '';

      $for = ($f['id']) ? ' for="' . $f['id'] . '"' : '';
      $id = ($f['id']) ? ' id="' . $f['id'] . '"' : '';
      $output = '<div class="dm3-form-element"><label' . $for . '>' . $f['label'] . '</label>';
      $output .= '<div class="dm3-form-field"><select' . $id . ' class="dm3-select" name="' . $name . '">';

      foreach ($f['options'] as $key => $val) {
        if (is_array($val)) {
          $output .= '<optgroup label="' . $val['label'] . '">';
          foreach ($val['options'] as $key => $val) {
            $output .= '<option value="' . $key . '"' . ($key == $value ? ' selected="selected"' : '') . '>' . $val . '</option>';
          }
          $output .= '</optgroup>';
        } else {
          $output .= '<option value="' . $key . '"' . ($key == $value ? ' selected="selected"' : '') . '>' . $val . '</option>';
        }
      }

      $output .= '</select>';

      if (isset($f['description'])) {
        $output .= '<div class="dm3-form-element-description">' . $f['description'] . '</div>';
      }

      $output .= '</div></div>';
      return $output;
    }

    /**
     * Text field with colorpicker
     *
     * @param string $name
     * @param string $value
     * @param array $f
     *
     * @return string
     */
    public static function fieldColorpicker( $name, $value, $f ) {
      if ( ! isset( $f['classes'] ) ) {
        $f['classes'] = array();
      }

      $f['classes'] = ( array ) $f['classes'];
      $f['classes'][] = 'colorvalue';
      $f['classes'][] = 'dm3-textinput';
      $classes = ' class="' . implode( ' ', $f['classes'] ) . '"';

      $output = '<div class="dm3-form-element"><label>' . $f['label'] . '</label><div class="dm3-form-field">';
      $output .= '<input' . $classes . ' type="text" size="8" maxlength="7" name="' . $name . '"';
      
      if ($value) {
        $output .= 'value="' . $value . '" /><div class="pickcolor"><div style="background-color: ' . $value . '"></div></div>';
      } else {
        $output .= ' /><div class="pickcolor"><div></div></div>';
      }

      if (isset($f['description'])) {
        $output .= '<div class="dm3-form-element-description">' . $f['description'] . '</div>';
      }

      $output .= '</div></div>';
      return $output;
    }

    /**
     * Text field with native wordpress uploader
     *
     * @param string $name
     * @param string $value
     * @param array $f
     *
     * @return string
     */
    public static function fieldUpload($name, $value, $f) {
      if (!isset($f['size'])) $f['size'] = 48;
      if (!isset($f['id'])) $f['id'] = $name;

      $for = ($f['id']) ? ' for="' . $f['id'] . '"' : '';
      $id = ($f['id']) ? ' id="' . $f['id'] . '"' : '';
      $output = '<div class="dm3-form-element"><label' . $for . '>' . $f['label'] . '</label><div class="dm3-form-field">';
      $output .= '<input type="text"' . $id . ' class="dm3-textinput regular-text" name="' . $name . '" value="' . $value . '" size="' . $f['size'] . '" />';
      $output .= ' <a class="button button-secondary upload-image-button" href="#" rel="#' . $f['id'] . '" data-insertlabel="' . __('Insert', 'dm3-options') . '">' . __('Select', 'dm3-options') . '</a>';

      if (isset($f['description'])) {
        $output .= '<div class="dm3-form-element-description">' . $f['description'] . '</div>';
      }

      $output .= '</div></div>';
      return $output;
    }
      
    /**
     * Show a group of radio buttons
     *
     * @param string $name
     * @param string $value
     * @param array $f
     *
     * @return string
     */
    public static function fieldRadios($name, $value, $f) {
      $checked = '';
      $output = '<div class="dm3-form-element"><label>' . $f['label'] . '</label><div class="dm3-form-field">';
      
      foreach ($f['options'] as $rKey => $rTitle) {
        if ($value == $rKey) $checked = ' checked="checked"';
        $output .= '<label class="dm3-checkbox-label"><input type="radio" class="dm3-checkbox" name="' . $name . '" value="' . $rKey . '"' . $checked . ' />' . $rTitle . '</label>';
        $checked = '';
      }

      if (isset($f['description'])) {
        $output .= '<div class="dm3-form-element-description">' . $f['description'] . '</div>';
      }

      $output .= '</div></div>';
      return $output;
    }
      
    /**
     * Print one checkbox
     *
     * @param string $name
     * @param string $value
     * @param array $f
     *
     * @return string
     */
    public static function fieldCheckbox($name, $value, $f) {
      if (!isset($f['id'])) $f['id'] = '';

      $for = ($f['id']) ? ' for="' . $f['id'] . '"' : '';
      $id = ($f['id']) ? ' id="' . $f['id'] . '"' : '';
      $output = '<div class="dm3-form-element"><label' . $for . '>' . $f['label'] . '</label><div class="dm3-form-field">';
      $output .= '<input type="checkbox"' . $id . ' class="dm3-checkbox" name="' . $name . '" value="' . $f['value'] . '"' . ($value == $f['value'] ? ' checked="checked"' : '') . '/>';

      if (isset($f['description'])) {
        $output .= '<div class="dm3-form-element-description">' . $f['description'] . '</div>';
      }

      $output .= '</div></div>';
      return $output;
    }
  }
}