<?php
/**
 * Admin Enqueue functions
 */

function beauty_load_admin_scripts($hook){
    if ($hook == 'toplevel_page_beauty_options'){
        wp_register_style('beauty_admin', get_template_directory_uri().'/css/beauty.admin.css', array(), 'all');
        wp_enqueue_style('beauty_admin');
    }
}
add_action('admin_enqueue_scripts', 'beauty_load_admin_scripts');