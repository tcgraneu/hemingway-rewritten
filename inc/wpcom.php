<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Hemingway Rewritten
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 * @return void
 */
function hemingway_rewritten_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => 'ffffff',
			'border' => '666666',
			'text'   => '444444',
			'link'   => '1abc9c',
			'url'    => '1abc9c',
		);
	}
}
add_action( 'after_setup_theme', 'hemingway_rewritten_wpcom_setup' );

//WordPress.com specific styles
function hemingway_rewritten_wpcom_styles() {
	wp_enqueue_style( 'hemingway_rewritten-wpcom', get_template_directory_uri() . '/inc/style-wpcom.css', '022714' );
}
add_action( 'wp_enqueue_scripts', 'hemingway_rewritten_wpcom_styles' );

/*
 * De-queue Google fonts if custom fonts are being used instead
 */
function hemingway_rewritten_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
		$customfonts = TypekitData::get( 'families' );
		if ( $customfonts && $customfonts['site-title']['id'] && $customfonts['headings']['id'] && $customfonts['body-text']['id'] ) {
			wp_dequeue_style( 'hemingway-rewritten-raleway' );
			wp_dequeue_style( 'hemingway-rewritten-latos' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'hemingway_rewritten_dequeue_fonts' );

/**
 * Adds support for WP.com print styles
 */
function hemingway_rewritten_theme_support() {
	add_theme_support( 'print-style' );
}
add_action( 'after_setup_theme', 'hemingway_rewritten_theme_support' );
