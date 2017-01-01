<?php
/**
 * Admin Page
 */

// adding new button in admin
function beauty_add_admin_page(){
	add_menu_page('Beauty menu options', 'Beauty', 'manage_options', 'beauty_options', 'beauty_theme_create_page', 'dashicons-admin-site', 110);

	add_submenu_page('beauty_options', 'Beauty theme options', 'Общие настройки', 'manage_options', 'beauty_options', 'beauty_theme_create_page');

	add_submenu_page('beauty_options', 'Beauty css options', 'Пользовательские стили', 'manage_options', 'beauty_options_css', 'beauty_submenu_page_callback');

	//activate custom settings
	add_action('admin_init', 'beauty_custom_settings');
}

add_action( 'admin_menu', 'beauty_add_admin_page' );

// выводит контент страницы пункта меню
function beauty_theme_create_page(){
	require_once (get_template_directory() . '/inc/templates/beauty-admin.php');
}

function beauty_custom_settings(){
	register_setting('beauty_settings_group', 'first_name');
	register_setting('beauty_settings_group', 'last_name');
	register_setting('beauty_settings_group', 'twitter', 'sanitize_twitter');
	register_setting('beauty_settings_group', 'facebook');
	register_setting('beauty_settings_group', 'google');

	add_settings_section('beauty_sidebar_options', 'Настройки для сайдбара', 'beauty_sidebar_options', 'beauty_options');

	add_settings_field('sidebar_name', 'Ваше имя и фамилия', 'beauty_sidebar_name', 'beauty_options', 'beauty_sidebar_options');
	add_settings_field('sidebar_twitter', 'Ваш Твиттер аккаунт', 'beauty_sidebar_twitter', 'beauty_options', 'beauty_sidebar_options');
	add_settings_field('sidebar_facebook', 'Ваш Фейсбук аккаунт', 'beauty_sidebar_facebook', 'beauty_options', 'beauty_sidebar_options');
	add_settings_field('google', 'Ваш Google аккаунт', 'beauty_sidebar_google', 'beauty_options', 'beauty_sidebar_options');
}

function beauty_sidebar_options(){
	echo 'Настойки для сайдбара';
}
function beauty_sidebar_name(){
	$first_name = esc_attr(get_option('first_name'));
	$last_name = esc_attr(get_option('last_name'));
	?>
	<input
		type="text"
		name="first_name"
	    placeholder="Ваше имя"
	    value="<?php echo $first_name?>"
	/>

	<input
		type="text"
		name="last_name"
		placeholder="Ваша фамилия"
		value="<?php echo $last_name?>"
	/>
	<?
}
function beauty_sidebar_twitter(){
	$twitter = esc_attr(get_option('twitter'));
	?>
	<input
		type="text"
		name="twitter"
		placeholder="Ссылка"
		value="<?php echo $twitter?>"
	/>
	<?
}

function beauty_sidebar_facebook(){
	$facebook = esc_attr(get_option('facebook'));
	?>
	<input
		type="text"
		name="facebook"
		placeholder="Ссылка"
		value="<?php echo $facebook?>"
	/>
	<?
}

function beauty_sidebar_google(){
	$google = esc_attr(get_option('google'));
	?>
	<input
		type="text"
		name="google"
		placeholder="Ссылка"
		value="<?php echo $google?>"
	/>
	<?
}

function sanitize_twitter( $input ){
	$output = str_replace('@', '', $input);
	$output = sanitize_text_field( $output );
	return $output;
}

function beauty_submenu_page_callback(){

}