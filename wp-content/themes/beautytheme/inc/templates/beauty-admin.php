<div class="wrap">
<h1>Пользовательские настройки темы</h1>
	<?php settings_errors();?>
    <?php
    $profile_picture = esc_attr(get_option('profile_picture'));
    $first_name = esc_attr(get_option('first_name'));
    $last_name = esc_attr(get_option('last_name'));
    $fullname = $first_name .' '. $last_name;
    $description = esc_attr(get_option('description'));
    ?>
    <div class="beauty-sidebar-preview">
        <div class="beauty-sidebar">
            <div class="image_container">
                <div id="profile_picture_preview" class="profile_picture" style="background-image: url(<?php echo $profile_picture?>)">
                </div>
            </div>
            <h1 class="beauty-username"><?php echo $fullname?></h1>
            <h2 class="beauty-description"><?php echo $description?></h2>
            <div class="icons-wrapper"></div>
        </div>
    </div>
	<form action="options.php" method="post" class="beauty-general-form">
		<?php settings_fields('beauty_settings_group')?>
		<?php do_settings_sections('beauty_options')?>
		<?php submit_button()?>
	</form>
</div>