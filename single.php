<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Hemingway Rewritten
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php
				$contentpart = 'single';
				if ( 'image' == get_post_format() || 'video' == get_post_format() )
					$contentpart = 'media'; ?>

			<?php get_template_part( 'content', $contentpart ); ?>

			<?php hemingway_rewritten_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>