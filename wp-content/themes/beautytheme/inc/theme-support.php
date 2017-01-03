<?php
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
$otput = [];
foreach ($formats as $format) {
	$otput[] = (@$options[$format] == 1 ? $format : '');
}
	if (!empty($options)){
	add_theme_support('post-formats', $otput);
}

$header = get_option('custom_header');
if ($header == 1){
    add_theme_support('custom-header');
}

$background = get_option('custom_background');
if ($background == 1){
    add_theme_support('custom-background');
}

// Create custom pos type messages
$contact_activate = get_option('activate');
if($contact_activate == 1){
    add_action( 'init', 'true_register_post_type_init' );

    add_filter( 'manage_messages_posts_columns', 'beauty_set_contact_columns' );

    add_action( 'manage_messages_posts_custom_column', 'beauty_contact_custom_column', 10, 2 );

    add_action('add_meta_boxes', 'beauty_messages_add_meta_box');

    add_action('save_post', 'beauty_save_email_data');
}

function true_register_post_type_init() {
    $labels = array(
        'name' => 'Сообщения',
        'singular_name' => 'Сообщение', // админ панель Добавить->Функцию
        'add_new' => 'Добавить сообщение',
        'add_new_item' => 'Добавить новое сообщение', // заголовок тега <title>
        'edit_item' => 'Редактировать сообщение',
        'new_item' => 'Новое сообщение',
        'all_items' => 'Все сообщения',
        'view_item' => 'Просмотр сообщений на сайте',
        'search_items' => 'Искать сообщение',
        'not_found' =>  'Сообщений не найдено.',
        'not_found_in_trash' => 'В корзине нет сообщений.',
        'menu_name' => 'Сообщения' // ссылка в меню в админке
    );
    $args = array(
        'description' => 'Сообщения пользователей',
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt', // иконка в меню
        'menu_position' => 5, // порядок в меню
        'supports' => array( 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','tag')
    );
    register_post_type('messages', $args);
}

function beauty_set_contact_columns($columns){
    $newColumns = [];
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';
    //$newColumns['author'] = 'Author';
    return $newColumns;
}

function beauty_contact_custom_column($column, $post_id){
    switch ($column){
        case 'message':
            echo get_the_excerpt();
            break;
        case 'email':
            $email = get_post_meta($post_id, '_contact_email_value_key', true);
            echo '<a href="mailto:'. $email .'">'. $email .'</a>';
            break;
    }
}

// contact meta box
function beauty_messages_add_meta_box(){
    add_meta_box('message_email', 'User email', 'beauty_message_email_callback', 'messages', 'normal', 'high');
}
function beauty_message_email_callback($post){
    wp_nonce_field('beauty_save_email_data', 'beauty_contact_email_meta_box');

    $value = get_post_meta($post->ID, '_contact_email_value_key', true);

    echo '<label for="message_email_field">User email address</label>';
    echo '<input type="email" id="message_email_field" name="message_email_field" value="'. esc_attr($value) .'" size="25"/>';
}

function beauty_save_email_data($post_id){
    if(!isset($_POST['beauty_contact_email_meta_box'])){
        return;
    }

    if ( !wp_verify_nonce($_POST['beauty_contact_email_meta_box'], 'beauty_save_email_data')){
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }

    if (! current_user_can('edit_post', $post_id)){
        return;
    }

    if (!isset($_POST['message_email_field'])){
        return;
    }

    $data = sanitize_text_field($_POST['message_email_field']);

    update_post_meta($post_id, '_contact_email_value_key', $data);
}