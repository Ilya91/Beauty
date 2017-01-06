<div class="wrap">
<h1>Опции темы</h1>
	<?php settings_errors();?>
    <?php
    $profile_picture = esc_attr(get_option('profile_picture'));
    $first_name = esc_attr(get_option('first_name'));
    $last_name = esc_attr(get_option('last_name'));
    $fullname = $first_name .' '. $last_name;
    $description = esc_attr(get_option('description'));
    ?>
	<form action="options.php" method="post" class="beauty-general-form">
		<?php settings_fields('beauty_theme_options')?>
		<?php do_settings_sections('beauty_options_theme')?>
		<?php submit_button()?>
	</form>
</div>