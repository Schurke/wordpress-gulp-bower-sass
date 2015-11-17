<div class="ribbon container">
	<!-- output contact info -->
	<?php echo get_option( 'voidx_theme_options_customer_contact' ); ?>
	<!-- output language switcher --> 
	<?php do_action('wpml_add_language_selector'); ?>
	<!-- link to ingenia's mail system -->
	<a href="<?php echo get_option( 'voidx_theme_options_corp_email' ); ?>">[mail_icon]</a>
	<!-- link to ingenia's corp backend -->
	<a href="<?php echo get_option( 'voidx_theme_options_corp_backend' ); ?>">[lock_icon]</a>
</div>