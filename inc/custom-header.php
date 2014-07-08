<?php
/**
 * @package Hemingway Rewritten
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses hemingway_rewritten_header_style()
 * @uses hemingway_rewritten_admin_header_style()
 * @uses hemingway_rewritten_admin_header_image()
 *
 * @package Hemingway Rewritten
 */
function hemingway_rewritten_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'hemingway_rewritten_custom_header_args', array(
		'default-image'          => '%s/images/header.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1280,
		'height'                 => 426,
		'flex-height'            => true,
		'wp-head-callback'       => 'hemingway_rewritten_header_style',
		'admin-head-callback'    => 'hemingway_rewritten_admin_header_style',
		'admin-preview-callback' => 'hemingway_rewritten_admin_header_image',
	) ) );

	register_default_headers( array(
		'default' => array(
			'url'           => '%s/images/header.jpg',
			'thumbnail_url' => '%s/images/header-thumbnail.jpg',
		),
	) );
}
add_action( 'after_setup_theme', 'hemingway_rewritten_custom_header_setup' );

if ( ! function_exists( 'hemingway_rewritten_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see hemingway_rewritten_custom_header_setup().
 */
function hemingway_rewritten_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();

	// If no custom options for text or header image are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color && '' == $header_image ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description,
		.site-branding {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	<?php if ( $header_image ) : ?>
		.site-header-image {
			background-image: url(<?php echo $header_image; ?>);
		}
	<?php endif; // End header image check. ?>
	</style>
	<?php
}
endif; // hemingway_rewritten_header_style

if ( ! function_exists( 'hemingway_rewritten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see hemingway_rewritten_custom_header_setup().
 */
function hemingway_rewritten_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			background-color: #262626;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			-moz-background-size: cover;
			-webkit-background-size: cover;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			border: none;
			display: block;
			min-height: 426px;
			padding: 10% 0;
			position: relative;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
			text-transform: uppercase;
			letter-spacing: 4px;
			font-weight: 700;
			font-size: 32px;
			font-family: 'Raleway', sans-serif;
			text-align: center;
			width: 100%;
		}
		#headimg h1 a {
			text-decoration: none;
		}
		#desc {
			font-family: 'Raleway', sans-serif;
			font-size: 18px;
			font-weight: 300;
			opacity: 0.6;
			text-align: center;
		}
		#desc:before {
			content: "";
			display: block;
			width: 100px;
			height: 2px;
			background: rgba(255,255,255,0.1);
			margin: 20px auto;
		}
		#headimg img {
			display: block;
			position: absolute;
				top: 0;
				left: 0;
			z-index: 1;
		}
		.site-header-wrapper {
			position: relative;
			text-align: center;
			z-index: 2;
		}
		.site-header-inner-wrapper {
			background: #1d1d1d;
			display: inline-block;
			padding: 30px;
		}
	</style>
<?php
}
endif; // hemingway_rewritten_admin_header_style

if ( ! function_exists( 'hemingway_rewritten_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see hemingway_rewritten_custom_header_setup().
 */
function hemingway_rewritten_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
	$image = '';
	if ( get_header_image() )
		$image = sprintf( ' style="background-image:url(%s);"', get_header_image() );
?>
	<div id="headimg" <?php echo $image; ?>>
		<div class="site-header-wrapper displaying-header-text">
			<div class="site-header-inner-wrapper">
				<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
			</div>
		</div>
		<?php if ( get_header_image() ) : ?>
		<img src="" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // hemingway_rewritten_admin_header_image
