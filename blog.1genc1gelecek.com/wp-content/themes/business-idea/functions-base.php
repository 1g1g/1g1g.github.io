<?php

if ( ! defined('TEMPLATEPATH' ) ) {exit();}

/**
 * Get video HTML
 *
 * @param string $url
 * @param int $width In pixels
 * @param int $height In pixels
 *
 * @return string
 */
if ( ! function_exists( 'dm3_get_video' ) ) {
  function dm3_get_video($url, $width = 940, $height = 360) {
    $output = '';

    if (preg_match('/^(https?:\/\/)?(www\.)?youtu(\.be|be\.com)+\/(.+\=)?([^&?#]+)/i', $url, $matches)) {
      // Youtube
      $output = '<iframe width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $matches[5] . '?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
    } else if (preg_match('/^https?:\/\/vimeo\.com\/([0-9]+)/i', $url, $matches)) {
      // Vimeo
      $output = '<iframe src="http://player.vimeo.com/video/' . $matches[1] . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="' . $width . '" height="' . $height . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
    }

    return $output;
  }
}