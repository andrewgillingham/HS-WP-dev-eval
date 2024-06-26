<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup() {
	load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
	add_theme_support( 'woocommerce' );
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1920; }
	register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );
	register_nav_menus( array( 'footer-menu' => esc_html__( 'Footer Menu', 'blankslate' ) ) );
}
add_action( 'admin_notices', 'blankslate_notice' );
function blankslate_notice() {
	$user_id   = get_current_user_id();
	$admin_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$param     = ( count( $_GET ) ) ? '&' : '?';
	if ( ! get_user_meta( $user_id, 'blankslate_notice_dismissed_8' ) && current_user_can( 'manage_options' ) ) {
		echo '<div class="notice notice-info"><p><a href="' . esc_url( $admin_url ), esc_html( $param ) . 'dismiss" class="alignright" style="text-decoration:none"><big>' . esc_html__( 'Ⓧ', 'blankslate' ) . '</big></a>' . wp_kses_post( __( '<big><strong>📝 Thank you for using BlankSlate!</strong></big>', 'blankslate' ) ) . '<br /><br /><a href="https://wordpress.org/support/theme/blankslate/reviews/#new-post" class="button-primary" target="_blank">' . esc_html__( 'Review', 'blankslate' ) . '</a> <a href="https://github.com/tidythemes/blankslate/issues" class="button-primary" target="_blank">' . esc_html__( 'Feature Requests & Support', 'blankslate' ) . '</a> <a href="https://calmestghost.com/donate" class="button-primary" target="_blank">' . esc_html__( 'Donate', 'blankslate' ) . '</a></p></div>';
	}
}
add_action( 'admin_init', 'blankslate_notice_dismissed' );
function blankslate_notice_dismissed() {
	$user_id = get_current_user_id();
	if ( isset( $_GET['dismiss'] ) ) {
		add_user_meta( $user_id, 'blankslate_notice_dismissed_8', 'true', true );
	}
}
add_action( 'wp_enqueue_scripts', 'blankslate_enqueue' );
function blankslate_enqueue() {
	wp_enqueue_style( 'blankslate-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'blankslate_footer' );
function blankslate_footer() {
	?>
<script>
jQuery(document).ready(function($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (deviceAgent.match(/(Android)/)) {
$("html").addClass("android");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
	<?php
}
add_filter( 'document_title_separator', 'blankslate_document_title_separator' );
function blankslate_document_title_separator( $sep ) {
	$sep = esc_html( '|' );
	return $sep;
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
	if ( $title == '' ) {
		return esc_html( '...' );
	} else {
		return wp_kses_post( $title );
	}
}
function blankslate_schema_type() {
	$schema = 'https://schema.org/';
	if ( is_single() ) {
		$type = 'Article';
	} elseif ( is_author() ) {
		$type = 'ProfilePage';
	} elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}
	echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
add_filter( 'nav_menu_link_attributes', 'blankslate_schema_url', 10 );
function blankslate_schema_url( $atts ) {
	$atts['itemprop'] = 'url';
	return $atts;
}
if ( ! function_exists( 'blankslate_wp_body_open' ) ) {
	function blankslate_wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
add_action( 'wp_body_open', 'blankslate_skip_link', 5 );
function blankslate_skip_link() {
	echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'blankslate' ) . '</a>';
}
add_filter( 'the_content_more_link', 'blankslate_read_more_link' );
function blankslate_read_more_link() {
	if ( ! is_admin() ) {
		return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
}
add_filter( 'excerpt_more', 'blankslate_excerpt_read_more_link' );
function blankslate_excerpt_read_more_link( $more ) {
	if ( ! is_admin() ) {
		global $post;
		return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'blankslate_image_insert_override' );
function blankslate_image_insert_override( $sizes ) {
	unset( $sizes['medium_large'] );
	unset( $sizes['1536x1536'] );
	unset( $sizes['2048x2048'] );
	return $sizes;
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar Widget Area', 'blankslate' ),
			'id'            => 'primary-widget-area',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'wp_head', 'blankslate_pingback_header' );
function blankslate_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
function blankslate_custom_pings( $comment ) {
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
	<?php
}
add_filter( 'get_comments_number', 'blankslate_comment_count', 0 );
function blankslate_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments     = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $get_comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

require_once __DIR__ . '/inc/custom-post-types.php';
require_once __DIR__ . '/inc/custom-taxonomies.php';

function eval_register_scripts_and_styles() {
	$asset_file = array(
		'dependencies' => array(),
		'version'      => wp_get_theme()->get( 'Version' ),
	);

	if ( file_exists( get_stylesheet_directory() . '/build/theme/index.asset.php' ) ) {
		$asset_file = include get_stylesheet_directory() . '/build/theme/index.asset.php';
	}

	$dependencies = $asset_file['dependencies'];
	$version      = $asset_file['version'];

	wp_enqueue_style( 'eval-theme-style', get_stylesheet_directory_uri() . '/build/theme/style-index.css', array(), $version );
	wp_enqueue_script( 'eval-theme-script', get_stylesheet_directory_uri() . '/build/theme/index.js', $dependencies, $version, true );
}

add_action( 'wp_enqueue_scripts', 'eval_register_scripts_and_styles' );

function eval_register_blocks() {
	register_block_type( get_stylesheet_directory() . '/build/blocks/hero' );
	register_block_type( get_stylesheet_directory() . '/build/blocks/product-info' );
	register_block_type( get_stylesheet_directory() . '/build/blocks/product-gallery' );
	register_block_type( get_stylesheet_directory() . '/build/blocks/testimonials' );
	register_block_type( get_stylesheet_directory() . '/build/blocks/taxonomy-cards', array(
		'render_callback' => function( $attributes, $content ) {
			$terms = get_terms( array(
				'taxonomy'   => $attributes['taxonomy'],
				'hide_empty' => false,
			) );
			ob_start(); ?>
			<div class="taxonomy-cards">
				<?php foreach ( $terms as $term ) : ?>
					<?php $taxonomy_image = get_field( 'taxonomy_image', $attributes['taxonomy'] . '_' . $term->term_id ); ?>
					<div class="taxonomy-card">
						<?php if ( $taxonomy_image ) : ?>
							<img src="<?php echo esc_url( $taxonomy_image['url'] ); ?>" alt="<?php echo esc_attr( $taxonomy_image['alt'] ); ?>" />
						<?php endif; ?>
						<h3><?php echo esc_html( $term->name ); ?></h3>
						<p><?php echo esc_html( $term->description ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
			<?php $terms_html = ob_get_clean();
			$new_content = str_replace( '[taxonomy_query]', $terms_html, $content);
			return $new_content;
		}
	) );
}

add_action( 'init', 'eval_register_blocks' );

function eval_get_location_by_ip( $specific_ip = null ) {
	$ip = $specific_ip ?: $_SERVER['REMOTE_ADDR'];

	// Try to get the location data from the transient
	// Note: potentially not the best way to store the location data, but it's a simple way to cache the data
	$location = get_transient( 'location_by_ip_' . $ip );

	// If the transient exists, return the location data
	if ( $location ) {
		return $location;
	}

	// If the transient does not exist, fetch the data from the API

	$res = wp_remote_get( "https://ipapi.co/$ip/json/" );
	if ( ! is_wp_error( $res ) && wp_remote_retrieve_response_code( $res ) === 200 ) {
		$body = wp_remote_retrieve_body( $res );
		if ( $body ) {
			$data = json_decode( $body );
			if ( $data->reserved ) {
				// Since localhost is by definition a reserved IP, try to hit an API to get the IP - normally we shouldn't get here when not in development
				$res = wp_remote_get( 'https://api.ipify.org?format=json' );
				if ( ! is_wp_error( $res ) && wp_remote_retrieve_response_code( $res ) === 200 ) {
					$body = wp_remote_retrieve_body( $res );
					$data = json_decode( $body );
					if ( $data->ip ) {
						return eval_get_location_by_ip( $data->ip );
					}
				}
			}
		}
		$location = json_decode( $body, true );

		// Store the location data in a transient, expires after 1 hour
		set_transient( 'location_by_ip_' . $ip, $location, HOUR_IN_SECONDS );

		return $location;
	}

	// Return a default location if the API call fails
	return array( 'city' => 'Raleigh' );
}