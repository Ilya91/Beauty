<?php
/**
 * Admin Page
 */

// adding new button in admin
function beauty_add_admin_page(){
	add_menu_page('Beauty menu options', 'Beauty', 'manage_options', 'manage_options', 'beauty_theme_create_page', 'dashicons-admin-site', 110);
}
add_action( 'admin_menu', 'beauty_add_admin_page' );

// выводит контент страницы пункта меню
function beauty_theme_create_page(){
	echo '<div class="wrap">';
	echo '<h1>Beauty Theme Options</h1>';
	echo '</div>';
}