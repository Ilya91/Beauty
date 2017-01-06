<?php
/**
 * Admin Enqueue functions
 */

function beauty_load_admin_scripts($hook){
    if ($hook == 'toplevel_page_beauty_options'){
        wp_register_style('beauty_admin', get_template_directory_uri().'/css/beauty.admin.css', array(), '1.0.0', 'all');
        wp_enqueue_style('beauty_admin');

        wp_register_script('beauty_admin_script', get_template_directory_uri().'/js/beauty.admin.js', array('jquery'));
        wp_enqueue_script('beauty_admin_script');

        wp_enqueue_media();
    }elseif ($hook == 'beauty_page_beauty_options_css'){
        wp_enqueue_style('ace', get_template_directory_uri().'/css/ace.css', array(), '1.0.0', 'all');
        wp_enqueue_style('custom-theme', get_template_directory_uri().'/css/custom-theme.css', array(), '1.0.0', 'all');
        wp_enqueue_script('ace', get_template_directory_uri().'/js/ace/ace.js',  array('jquery'), '1.2.1', true);
        wp_enqueue_script('beauty-custom-css-script', get_template_directory_uri().'/js/beauty.custom_css.js',  array('jquery'), '1.0.0', true);

    }
}
add_action('admin_enqueue_scripts', 'beauty_load_admin_scripts');


/**
 * Front-end Enqueue functions
 */
function beauty_load_scripts(){
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), '3.3.6', 'all');
    wp_enqueue_style('main', get_template_directory_uri().'/css/main.css', array(), '1.1.0', 'all');

    $custom_css = esc_attr( get_option( 'beauty_css' ) );
    if(!empty($custom_css)){
        wp_enqueue_style('custom-theme', get_template_directory_uri().'/css/custom-theme.css', array(), '1.2.0', 'all');
    }
    wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri().'/js/jquery.js', false, '1.11.3', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.3.6', true);
}
add_action('wp_enqueue_scripts', 'beauty_load_scripts');