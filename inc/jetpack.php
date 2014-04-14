<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Hemingway Rewritten
 */

function hemingway_rewritten_jetpack_setup() {
	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'footer'         => 'content',
		'render'         => 'hemingway_rewritten_render',
		'footer_widgets' => array( 'sidebar-4', 'sidebar-2', 'sidebar-3' ),
	) );

	/**
	 * Add theme support for Responsive Videos.
	 */
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'hemingway_rewritten_jetpack_setup' );

function hemingway_rewritten_render() {
	$contentpart = get_post_format();
	if ( 'image' == $contentpart || 'video' == $contentpart )
		$contentpart = 'media';

	while( have_posts() ) {
		the_post();
		get_template_part( 'content', $contentpart );
	}
}
