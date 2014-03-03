<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package Hemingway Rewritten
 */

if ( ! is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4' ) )
	return;
?>
	<div id="tertiary" class="widget-areas clear" role="complementary">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div>
		<?php endif; ?>
	</div><!-- #tertiary -->
