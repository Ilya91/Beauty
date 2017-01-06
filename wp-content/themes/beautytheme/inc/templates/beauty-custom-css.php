<div class="wrap">
<h1>Пользовательские стили</h1>
	<?php settings_errors();?>
	<form id="save-custom-css-form" action="options.php" method="post" class="beauty-general-form">
		<?php settings_fields('beauty-custom-css-options')?>
		<?php do_settings_sections('beauty_options_css')?>
		<?php submit_button()?>
	</form>
</div>