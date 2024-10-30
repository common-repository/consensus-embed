<?php
/**
* Plugin Name: Consensus Embed
* Plugin URI: http://www.goconsensus.com/
* Description: Provides an easy solution to put a Consensus demo on your website.
* Version: 1.6
* Author: Consensus
* Author URI: http://www.goconsensus.com
*/

class Consensus {

  protected $plugin_url;

  public function __construct() {
    // Define the plugin url
    $this->plugin_url = plugins_url('', __FILE__);
    $this->plugin_dir = plugin_dir_path( __FILE__ );

    // Initial setup of plugin
    add_action('wp_enqueue_scripts', array($this, 'add_scripts'));
    add_action('wp_enqueue_scripts', array($this, 'add_styles'));
    add_shortcode('consensus', array($this, 'embed_demo'));
  }

  public function embed_demo($atts, $content = null) {
    // Default shortcode attributes
    $default_atts = array(
      'width'     => '1024',
      'height'    => '720',
      'lightbox'  => false,
      'mobile'    => '',
      'src'       => ''
    );

    // Extract shortcode attributes to variables
    extract(shortcode_atts($default_atts, $atts));

    if ($lightbox) {
      $embed_code = '<a class="embed-video" data-mobile="'.$mobile.'" href="'.$src.'">'.$content.'</a>';
    }
    else {
      $embed_code = '<iframe width="'.$width.'" height="'.$height.'" src="'.$src.'"></iframe>';
    }

    return $embed_code;
  }

  public function add_scripts() {
    // Register the colorbox and consensus scripts
    wp_register_script('colorbox', $this->plugin_url . '/js/jquery.colorbox-min.js', array('jquery'), $this->get_version('/js/jquery.colorbox-min.js'), true);
    wp_register_script('consensus', $this->plugin_url . '/js/consensus.js', array('colorbox'), $this->get_version('/js/consensus.js'), true);

    // Call all scripts to use
    wp_enqueue_script('consensus');
  }

  public function add_styles() {
    // Register the colorbox theme
    wp_register_style('colorbox', $this->plugin_url . '/themes/theme1/colorbox.css');

    // Call all styles to use
    wp_enqueue_style('colorbox');
  }

  public function get_version($path) {
    return filemtime($this->plugin_dir . $path);
  }
}

// Initiate class
$consensus = new Consensus();
