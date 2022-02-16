<?php

/**
 * Plugin Name: WP Headless BE
 * Plugin URI: https://github.com/atria-digital-marketing/asl-2.0-customizer
 * Description: Bleeding edge headless plugin for Wordpress
 * Author: Jesse Hazel
 * Text Domain: wp-headless-be
 * Version: 0.0.1
 * 
 * @package WP_Headless_BE
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
    Container::make('theme_options', __('Theme Options'))
        ->add_fields(array(
            Field::make('text', 'crb_text', 'Text Field'),
        ));
}

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}



// This just echoes the chosen line, we'll position it later
function hello_dolly()
{
    echo "<p id='dolly'>I can assure you we're open</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action('admin_notices', 'hello_dolly');

// We need some CSS to position the paragraph
function dolly_css()
{
    // This makes sure that the positioning is also good for right-to-left languages
    $x = is_rtl() ? 'left' : 'right';

    echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action('admin_head', 'dolly_css');
