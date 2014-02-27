<?php

// Theme setup
add_action( 'after_setup_theme', 'hemingway_setup' );

function hemingway_setup() {

	// Automatic feed
	add_theme_support( 'automatic-feed-links' );

	// Custom background
	add_theme_support( 'custom-background' );

	// Post thumbnails
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	add_image_size( 'post-image', 676, 9999 );

	// Post formats
	add_theme_support( 'post-formats', array( 'video', 'aside', 'quote' ) );

	// Custom header
	$args = array(
		'width'         => 1280,
		'height'        => 416,
		'default-image' => get_template_directory_uri() . '/images/header.jpg',
		'uploads'       => true
	);
	add_theme_support( 'custom-header', $args );

	// Add nav menu
	register_nav_menu( 'primary', 'Primary Menu' );

	// Make the theme translation ready
	load_theme_textdomain('hemingway', get_template_directory() . '/languages');

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) )
	  require_once($locale_file);

}

// Enqueue Javascript files
function hemingway_load_javascript_files() {

	if ( !is_admin() )
		wp_register_script( 'hemingway_global', get_template_directory_uri().'/js/global.js', array('jquery'), '', true );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'hemingway_global' );
}

add_action( 'wp_enqueue_scripts', 'hemingway_load_javascript_files' );


// Enqueue styles
function hemingway_load_style() {
	if ( !is_admin() )
	    wp_register_style('hemingway_googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic|Raleway:700,400' );
		wp_register_style('hemingway_style', get_stylesheet_uri() );

	    wp_enqueue_style( 'hemingway_googleFonts' );
	    wp_enqueue_style( 'hemingway_style' );
}

add_action('wp_print_styles', 'hemingway_load_style');


// Add footer widget areas
add_action( 'widgets_init', 'hemingway_sidebar_reg' );

function hemingway_sidebar_reg() {
	register_sidebar(array(
	  'name' => __( 'Footer A', 'hemingway' ),
	  'id' => 'footer-a',
	  'description' => __( 'Widgets in this area will be shown in the left column in the footer.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
	register_sidebar(array(
	  'name' => __( 'Footer B', 'hemingway' ),
	  'id' => 'footer-b',
	  'description' => __( 'Widgets in this area will be shown in the middle column in the footer.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
	register_sidebar(array(
	  'name' => __( 'Footer C', 'hemingway' ),
	  'id' => 'footer-c',
	  'description' => __( 'Widgets in this area will be shown in the right column in the footer.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
	register_sidebar(array(
	  'name' => __( 'Sidebar', 'hemingway' ),
	  'id' => 'sidebar',
	  'description' => __( 'Widgets in this area will be shown in the sidebar.', 'hemingway' ),
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	  'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	  'after_widget' => '</div><div class="clear"></div></div>'
	));
}

// Add theme widgets
require_once (get_template_directory() . "/widgets/dribbble-widget.php");
require_once (get_template_directory() . "/widgets/flickr-widget.php");
require_once (get_template_directory() . "/widgets/video-widget.php");


// Set content-width
if ( ! isset( $content_width ) ) $content_width = 676;


// Custom title function
function hemingway_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'hemingway' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'hemingway_wp_title', 10, 2 );


// Add classes to next_posts_link and previous_posts_link
add_filter('next_posts_link_attributes', 'hemingway_posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'hemingway_posts_link_attributes_2');

function hemingway_posts_link_attributes_1() {
    return 'class="post-nav-older"';
}
function hemingway_posts_link_attributes_2() {
    return 'class="post-nav-newer"';
}


// Menu walker adding "has-children" class to menu li's with children menu items
class hemingway_nav_walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( !empty( $children_elements[ $element->$id_field ] ) ) {
            $element->classes[] = 'has-children';
        }
        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}


// Add class to body if the post/page has a featured image
add_action('body_class', 'hemingway_if_featured_image_class' );

function hemingway_if_featured_image_class($classes) {
	if ( has_post_thumbnail() ) {
		array_push($classes, 'has-featured-image');
	}
	return $classes;
}


// Custom more-link text
add_filter( 'the_content_more_link', 'hemingway_custom_more_link', 10, 2 );

function hemingway_custom_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, __('Continue reading', 'hemingway'), $more_link );
}


// Remove inline styling of attachment
add_shortcode('wp_caption', 'hemingway_fixed_img_caption_shortcode');
add_shortcode('caption', 'hemingway_fixed_img_caption_shortcode');

function hemingway_fixed_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	$output = apply_filters('img_caption_shortcode', '', $attr, $content);

	if ( $output != '' ) return $output;
	extract(shortcode_atts(array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
	return $content;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

// Style the admin area
function hemingway_custom_colors() {
   echo '<style type="text/css">

#postimagediv #set-post-thumbnail img {
	max-width: 100%;
	height: auto;
}

         </style>';
}

add_action('admin_head', 'hemingway_custom_colors');


// hemingway comment function
if ( ! function_exists( 'hemingway_comment' ) ) :
function hemingway_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<?php __( 'Pingback:', 'hemingway' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'hemingway' ), '<span class="edit-link">', '</span>' ); ?>

	</li>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<div id="comment-<?php comment_ID(); ?>" class="comment">

			<div class="comment-meta comment-author vcard">

				<?php echo get_avatar( $comment, 120 ); ?>

				<div class="comment-meta-content">

					<?php printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span class="post-author"> ' . __( '(Post author)', 'hemingway' ) . '</span>' : ''
					); ?>

					<p><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . ' at ' . get_comment_time() ?></a></p>

				</div> <!-- /comment-meta-content -->

			</div> <!-- /comment-meta -->

			<div class="comment-content post-content">

				<?php if ( '0' == $comment->comment_approved ) : ?>

					<p class="comment-awaiting-moderation"><?php _e( 'Awaiting moderation', 'hemingway' ); ?></p>

				<?php endif; ?>

				<?php comment_text(); ?>

				<div class="comment-actions">

					<?php edit_comment_link( __( 'Edit', 'hemingway' ), '', '' ); ?>

					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'hemingway' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

					<div class="clear"></div>

				</div> <!-- /comment-actions -->

			</div><!-- /comment-content -->

		</div><!-- /comment-## -->
	<?php
		break;
	endswitch;
}
endif;

// Add and save meta boxes for post links
add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add() {
	add_meta_box( 'postvideo-box', __('Video URL (video post format)', 'hemingway'), 'cd_meta_box_cc', 'post', 'side', 'high' );
}

function cd_meta_box_cc( $post ) {
	$values = get_post_custom( $post->ID );
	$text_videourl = isset( $values['videourl'] ) ? esc_attr( $values['videourl'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
		<p>
			<input type="text" name="videourl" id="videourl" value="<?php echo $text_videourl; ?>" />
		</p>
	<?php
}

add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id ) {
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);

	// Probably a good idea to make sure the data is set
	if( isset( $_POST['videourl'] ) )
		update_post_meta( $post_id, 'videourl', wp_kses( $_POST['videourl'], $allowed ) );

}

?>