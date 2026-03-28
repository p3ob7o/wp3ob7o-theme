<?php
/**
 * The Publishing Universe — Theme Functions
 *
 * @package wp3ob7o
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue additional stylesheets (typography + print).
 */
function wp3ob7o_enqueue_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'wp3ob7o-typography',
		get_theme_file_uri( 'assets/css/typography.css' ),
		array(),
		$theme_version
	);

	wp_enqueue_style(
		'wp3ob7o-print',
		get_theme_file_uri( 'assets/css/print.css' ),
		array(),
		$theme_version,
		'print'
	);
}
add_action( 'wp_enqueue_scripts', 'wp3ob7o_enqueue_styles' );


/**
 * Inject inline dark mode preference script in <head> before paint.
 * Reads localStorage and applies .dark-mode class on <html> before
 * the page renders, preventing flash-of-wrong-theme.
 */
function wp3ob7o_dark_mode_head_script() {
	?>
	<script>
	(function(){
		var d = document.documentElement;
		var stored = null;
		try { stored = localStorage.getItem('wp3ob7o-dark-mode'); } catch(e) {}
		if (stored === 'on') {
			d.classList.add('dark-mode');
		} else if (stored === 'off') {
			d.classList.remove('dark-mode');
		} else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
			d.classList.add('dark-mode');
		}
	})();
	</script>
	<?php
}
add_action( 'wp_head', 'wp3ob7o_dark_mode_head_script', 1 );

/**
 * Register block patterns.
 */
function wp3ob7o_register_patterns() {
	register_block_pattern_category( 'wp3ob7o', array(
		'label' => __( 'W P3OB7O', 'wp3ob7o' ),
	) );
}
add_action( 'init', 'wp3ob7o_register_patterns' );

/**
 * Add style variation body class for cross-site nav highlighting.
 * Reads the active style variation and adds a body class like
 * 'has-variation-paolo-blog'.
 */
function wp3ob7o_body_class( $classes ) {
	// Check for active style variation via global styles
	$global_styles = wp_get_global_styles();

	// Add template-specific class for dark mode surface scoping
	if ( is_singular() ) {
		$template_slug = get_page_template_slug();
		if ( $template_slug ) {
			$classes[] = 'template-' . sanitize_html_class( str_replace( '.html', '', basename( $template_slug ) ) );
		} else {
			$classes[] = 'template-single';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'wp3ob7o_body_class' );

/**
 * Add theme support.
 */
function wp3ob7o_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_editor_style( 'assets/css/typography.css' );
}
add_action( 'after_setup_theme', 'wp3ob7o_setup' );

/**
 * Output skip-to-content link via wp_body_open.
 * This is the canonical WordPress approach for skip links in block themes.
 */
function wp3ob7o_skip_link() {
	echo '<a class="skip-to-content" href="#main-content">' . esc_html__( 'Skip to content', 'wp3ob7o' ) . '</a>';
}
add_action( 'wp_body_open', 'wp3ob7o_skip_link' );
