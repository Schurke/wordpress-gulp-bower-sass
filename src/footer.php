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
						<p>Copyright &copy; <?php echo date("Y"); ?> George Restaurant. All Rights Reserved. 111C Queen St East, Toronto T. 647-496-8275 F. 416-368-6093</p>
					</div>
					

				 
				</footer>
			</div>
		</div>
	<?php wp_footer(); ?>
	</body>
</html>