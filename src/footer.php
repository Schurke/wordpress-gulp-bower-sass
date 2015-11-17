			</div>
			<div id="wrap-footer" class="wrap-footer">
				<footer id="colophon" class="site-footer container" role="contentinfo">
					<div class="row">
						<div class="col-sm-4">
							<?php
								if(is_active_sidebar('footer-sidebar-1')){
								dynamic_sidebar('footer-sidebar-1');
							}
							?>

						</div>
						<div class="col-sm-4">
							<?php
								if(is_active_sidebar('footer-sidebar-2')){
								dynamic_sidebar('footer-sidebar-2');
							}
							?>
						</div>
						<div class="col-sm-4">
							<?php
								if(is_active_sidebar('footer-sidebar-3')){
								dynamic_sidebar('footer-sidebar-3');
							}
							?>
						</div>
					</div>
					<div>
						<p><?php echo get_option( 'voidx_theme_options_copyright' ); ?></p>
					</div>
					

				 
				</footer>
			</div>
		</div>
	<?php wp_footer(); ?>
	</body>
</html>