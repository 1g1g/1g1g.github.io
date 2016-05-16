<?php

if ( function_exists( 'dm3sb_dynamic_sidebar' ) ) {
  dm3sb_dynamic_sidebar( 'default-theme-sidebar' );
} else {
  dynamic_sidebar( 'default-theme-sidebar' );
}