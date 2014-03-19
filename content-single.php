<?php
/**
 * @package Hemingway Rewritten
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'link' == get_post_format() ) : ?>
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( hemingway_rewritten_get_link_url() ) . '" rel="bookmark">', '</a></h1>' ); ?>
		<?php else : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php endif; ?>
		<div class="entry-meta">
			<?php hemingway_rewritten_posted_on(); ?>
			<?php edit_post_link( __( 'Edit', 'hemingway-rewritten' ), '<span class="edit-link"><span class="sep"> / </span>', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'hemingway-rewritten' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'hemingway-rewritten' ) );

			if ( '' != $category_list ) : ?>
				<div class="entry-categories">
					<?php echo $category_list; ?>
				</div>
			<?php endif; ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list();

			if ( '' != $tag_list ) : ?>
				<div class="entry-tags">
					<?php echo $tag_list; ?>
				</div>
			<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
