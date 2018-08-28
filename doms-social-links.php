<?php
/*
* Plugin Name:  DOMS Social Links
* Plugin URI:   https://github.com/darwin06/doms-social-links/
* Description:  Basic plugin to add social link shortcode in Post, Page and HTML Widget
* Version:      0.0.1
* Author:       Darwin Mateos
* Author URI:   https://github.com/darwin06/
* License:      GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:  doms
* Domain Path:  /languages
*/

  if ( !defined( 'ABSPATH') ) {
    die;
  }

  function doms_social_media_links( $atts ) {
    // * Get Values
    $url = shortcode_atts( array (
      'title' => '',
      'desc' => '',
      'custom' => '',
      'fb' => '',
      'tw' => '',
      'yt' => '',
      'in' => '',
    ), $atts );

    // * Validate if value isn't empty
    $length = count($url);
    $tagOpen = ( $length > 0 ) ? '<div class="doms-social-links-containers" >' : '';
    $tagClose = ( $length > 0 ) ? '</div>' : '';

    $title = ( !empty($url['title']) ) ? '<h5 class="card-title">' .  $url['title'] . '</h5>' : '';
    $desc = ( !empty($url['desc']) ) ? '<p class="card-text">' . $url['desc'] . '</p>' : '';
    $custom = ( !empty($url['custom']) ) ? '<a href="' . $url['custom'] . '" target="_blank" class="btn btn-sm cu" role="button" ><i class="fa fa-link" aria-hidden="true"></i></a>' : '';
    $fb = ( !empty($url['fb']) ) ? '<a href="https://www.facebook.com/' . $url['fb'] . '" target="_blank" class="btn btn-sm fb " role="button" ><i class="fa fa-facebook" aria-hidden="true"></i></a>' : '';
    $tw = ( !empty($url['tw']) ) ? '<a href="https://www.twitter.com/' . $url['tw'] . '" target="_blank" class="btn btn-sm tw " role="button" ><i class="fa fa-twitter" aria-hidden="true"></i></a>' : '';
    $yt = ( !empty($url['yt']) ) ? '<a href="https://www.youtube.com/' . $url['yt'] . '" target="_blank" class="btn btn-sm yt " role="button" ><i class="fa fa-youtube" aria-hidden="true"></i></a>' : '';
    $in = ( !empty($url['in']) ) ? '<a href="https://www.instagram.com/' . $url['in'] . '" target="_blank" class="btn btn-sm in " role="button" ><i class="fa fa-instagram" aria-hidden="true"></i></a>' : '';

    // * Add values
    $content = '<div class="doms-social-links-wrap card">';
    $content .= '<div class="card-body">';
    $content .= $title;
    $content .= $desc;
    $content .= $tagOpen;
    $content .= $custom;
    $content .= $fb;
    $content .= $tw;
    $content .= $yt;
    $content .= $in;
    $content .= $tagClose;
    $content .= '</div>';
    $content .= '</div>';

    return $content;
  }

  // * Add shortcode to WordPress
  add_shortcode( 'doms_social_links', 'doms_social_media_links' );

  // * Add Styles
  function doms_enqueue_style() {
    // wp_enqueue_style( 'bootstrap', plugins_url( 'public/css/bootstrap.min.css', __FILE__ ), false, 'all' );
    wp_enqueue_style( 'doms-social-links', plugins_url( 'public/css/doms-link-styles.css', __FILE__ ), false, 'all' );
  }

  add_action( 'wp_enqueue_scripts', 'doms_enqueue_style' );

  // * Activation
  function doms_social_activation() {
    // trigger our function that registers the custom post type
    doms_social_media_links();
  }

  register_activation_hook( __FILE__, 'doms_social_activation' );

  // * Deactivation
  function doms_social_deactivation() {
    // Flush cache
    wp_cache_flush();

  }
  register_deactivation_hook( __FILE__, 'doms_social_deactivation' );

  // * Uninstall
  function doms_social_uninstall() {
    // Remove shortcode
    remove_shortcode( 'doms_social_links' );

  }

  register_uninstall_hook(__FILE__, 'doms_social_uninstall');


?>
