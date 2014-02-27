	<div class="footer section large-padding bg-dark">

		<div class="footer-inner section-inner">

			<?php if ( is_active_sidebar( 'footer-a' ) ) : ?>

				<div class="column column-1 left">

					<div class="widgets">

						<?php dynamic_sidebar( 'footer-a' ); ?>

					</div>

				</div>

			<?php else : ?>

				<div class="column column-1 left">

					<div class="widgets">

						<div id="search" class="widget widget_search">

							<div class="widget-content">

								<h3 class="widget-title"><?php _e( 'Search form', 'hemingway' ); ?></h3>
				                <?php get_search_form(); ?>

							</div>

		                </div>

					</div>

				</div>

			<?php endif; ?> <!-- /footer-a -->

			<?php if ( is_active_sidebar( 'footer-b' ) ) : ?>

				<div class="column column-2 left">

					<div class="widgets">

						<?php dynamic_sidebar( 'footer-b' ); ?>

					</div> <!-- /widgets -->

				</div>

			<?php else : ?>

				<div class="column column-2 left">

					<div class="widgets">

						<div class="widget widget_recent_entries">

							<div class="widget-content">

								<h3 class="widget-title"><?php _e( 'Latest posts', 'hemingway' ); ?></h3>

								<ul>
					                <?php
										$args = array( 'numberposts' => '5' );
										$recent_posts = wp_get_recent_posts( $args );
										foreach( $recent_posts as $recent ){
											echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
										}
									?>
								</ul>

							</div>

		                </div>

					</div> <!-- /widgets -->

				</div>

			<?php endif; ?> <!-- /footer-b -->

			<?php if ( is_active_sidebar( 'footer-c' ) ) : ?>

				<div class="column column-3 left">

					<div class="widgets">

						<?php dynamic_sidebar( 'footer-c' ); ?>

					</div> <!-- /widgets -->

				</div>

			<?php else : ?>

				<div class="column column-3 left">

					<div id="meta" class="widget widget_text">
						<div class="widget-content">

							<h3 class="widget-title"><?php _e( "Text widget", "hemingway" ); ?></h3>
							<p><?php _e( "These widgets are displayed because you haven't added any widgets of your own yet. You can do so at Appearance > Widgets in the WordPress settings.", "hemingway" ); ?></p>

						</div>
	                </div>

				</div>

			<?php endif; ?> <!-- /footer-c -->

			<div class="clear"></div>

		</div> <!-- /footer-inner -->

	</div> <!-- /footer -->

	<div class="credits section bg-dark no-padding">

		<div class="credits-inner section-inner">

			<p class="credits-left">

				&copy; <?php echo date("Y") ?> <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>

			</p>

			<p class="credits-right">

				<span><?php printf( __( 'Theme by <a href="%s">Anders Noren</a>', 'hemingway'), 'http://www.andersnoren.se' ); ?></span> &mdash; <a title="<?php _e('To the top', 'hemingway'); ?>" class="tothetop"><?php _e('Up', 'hemingway' ); ?> &uarr;</a>

			</p>

			<div class="clear"></div>

		</div> <!-- /credits-inner -->

	</div> <!-- /credits -->

</div> <!-- /big-wrapper -->

<?php wp_footer(); ?>

</body>
</html>