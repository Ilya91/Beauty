<div class="wrap">
<h1>Сообщения пользователей</h1>
	<?php settings_errors();?>
	<form action="options.php" method="post" class="beauty-general-form">
		<?php settings_fields('beauty_contact_options')?>
		<?php do_settings_sections('beauty_options_theme_messages')?>
		<?php submit_button()?>
	</form>
</div>