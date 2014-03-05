<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Hemingway Rewritten
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function hemingway_rewritten_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'footer'         => 'content',
		'footer_widgets' => array( 'sidebar-4', 'sidebar-2', 'sidebar-3' ),
	) );
}
add_action( 'after_setup_theme', 'hemingway_rewritten_jetpack_setup' );
