<?php
/**
 * Admin Page
 */

// adding new button in admin
function beauty_add_admin_page(){
	add_menu_page('Beauty menu options', 'Beauty', 'manage_options', 'beauty_options', 'beauty_theme_create_page', 'dashicons-admin-site', 110);

	add_submenu_page('beauty_options', 'Beauty theme options', 'Общие настройки', 'manage_options', 'beauty_options', 'beauty_theme_create_page');

	add_submenu_page('beauty_options', 'Опции темы', 'Опции темы', 'manage_options', 'beauty_options_theme', 'beauty_theme_options_page');

	add_submenu_page('beauty_options', 'Beauty css options', 'Пользовательские стили', 'manage_options', 'beauty_options_css', 'beauty_submenu_page_callback');

	//activate custom settings
	add_action('admin_init', 'beauty_custom_settings');
}

add_action( 'admin_menu', 'beauty_add_admin_page' );

// выводит контент страницы пункта меню
function beauty_theme_create_page(){
	require_once (get_template_directory() . '/inc/templates/beauty-admin.php');
}

function beauty_theme_options_page(){
	require_once (get_template_directory() . '/inc/templates/beauty-theme-support.php');
}

function beauty_custom_settings(){
	// Sidebar options
	register_setting('beauty_settings_group', 'profile_picture');
	register_setting('beauty_settings_group', 'first_name');
	register_setting('beauty_settings_group', 'last_name');
	register_setting('beauty_settings_group', 'description');
	register_setting('beauty_settings_group', 'twitter', 'sanitize_twitter');
	register_setting('beauty_settings_group', 'facebook');
	register_setting('beauty_settings_group', 'google');

	add_settings_section('beauty_sidebar_options', 'Настройки для сайдбара', 'beauty_sidebar_options', 'beauty_options');

	add_settings_field('sidebar_picture', 'Profile picture', 'beauty_sidebar_picture', 'beauty_options', 'beauty_sidebar_options');
	add_settings_field('sidebar_name', 'Ваше имя и фамилия', 'beauty_sidebar_name', 'beauty_options', 'beauty_sidebar_options');
	add_settings_field('sidebar_description', 'Описание', 'beauty_sidebar_description', 'beauty_options', 'beauty_sidebar_options');
	add_settings_field('sidebar_twitter', 'Ваш Твиттер аккаунт', 'beauty_sidebar_twitter', 'beauty_options', 'beauty_sidebar_options');
	add_settings_field('sidebar_facebook', 'Ваш Фейсбук аккаунт', 'beauty_sidebar_facebook', 'beauty_options', 'beauty_sidebar_options');
	add_settings_field('google', 'Ваш Google аккаунт', 'beauty_sidebar_google', 'beauty_options', 'beauty_sidebar_options');

	//Theme Options
	register_setting('beauty_theme_options', 'post_format');
	register_setting('beauty_theme_options', 'custom_header');
	register_setting('beauty_theme_options', 'custom_background');

	add_settings_section('beauty_theme_options_support', 'Опции темы', 'beauty_theme_options_support', 'beauty_options_theme');

	add_settings_field('post_format', 'Post formats', 'beauty_post_formats', 'beauty_options_theme', 'beauty_theme_options_support');

	add_settings_field('custom-header', 'Опции шапки', 'beauty_custom_header', 'beauty_options_theme', 'beauty_theme_options_support');

	add_settings_field('custom-background', 'Опции фона', 'beauty_custom_background', 'beauty_options_theme', 'beauty_theme_options_support');
}

//Post formats callback function
function beauty_custom_header(){
	$options = get_option('custom_header');
	$checked = ($options == 1 ? 'checked' : '');
	$otput = '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '. $checked .'>Активировать кастомную шапку</label><br>';
	echo $otput;
}

function beauty_custom_background(){
	$options = get_option('custom_background');
	$checked = ($options == 1 ? 'checked' : '');
	$otput = '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '. $checked .'>Активировать кастомный фон</label><br>';
	echo $otput;
}
function beauty_theme_options_support(){
	echo 'Настойки для темы';
}

function beauty_post_formats(){
	$options = get_option('post_format');
	$formats = [
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	];
	$otput = '';
	foreach ($formats as $format){
		$checked = (@$options[$format] == 1 ? 'checked' : '');
		$otput .= '<label><input type="checkbox" id="'. $format .'" name="post_format['. $format .']" value="1" '. $checked .'>'. $format .' </label><br>';
	}
	echo $otput;
}







function beauty_sidebar_options(){
	echo 'Настойки для сайдбара';
}


function beauty_sidebar_picture(){
	$profile_picture = esc_attr(get_option('profile_picture'));
	//echo $profile_picture;
	if(empty($profile_picture)){
?>
		<input
			type="button"
			placeholder="Profile picture"
			value="Загрузить изображение"
			id="upload-button"
			class="button button-primary"
		/>
		<input type="hidden"
			   name="profile_picture"
			   id="profile_picture"
			   value="<?php echo $profile_picture?>"
		>
		<?php
	}else{
	?>
	<input
		type="button"
		placeholder="Profile picture"
		value="Поменять изображение"
		id="upload-button"
		class="button button-primary"
	/>
	<input type="hidden"
		   name="profile_picture"
		   id="profile_picture"
		   value="<?php echo $profile_picture?>"
	>
		<input
			type="button"
			placeholder="Profile picture"
			value="Удалить изображение"
			id="remove-button"
			class="button button-secondary"
		/>
	<?
	}
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

function beauty_sidebar_description(){
	$description = esc_attr(get_option('description'));
	?>
	<input
		type="text"
		name="description"
		placeholder="Ваше имя"
		value="<?php echo $description?>"
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