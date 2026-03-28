<?php
/**
 * The Publishing Universe — Theme Functions
 *
 * @package publishing-universe
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue additional stylesheets (typography + print).
 */
function pu_enqueue_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'pu-typography',
		get_theme_file_uri( 'assets/css/typography.css' ),
		array(),
		$theme_version
	);

	wp_enqueue_style(
		'pu-print',
		get_theme_file_uri( 'assets/css/print.css' ),
		array(),
		$theme_version,
		'print'
	);
}
add_action( 'wp_enqueue_scripts', 'pu_enqueue_styles' );

/**
 * Enqueue Google Fonts — Source Serif 4.
 */
function pu_enqueue_fonts() {
	wp_enqueue_style(
		'pu-google-fonts',
		'https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap',
		array(),
		null
	);
}
add_action( 'wp_enqueue_scripts', 'pu_enqueue_fonts' );
add_action( 'enqueue_block_editor_assets', 'pu_enqueue_fonts' );

/**
 * Inject inline dark mode preference script in <head> before paint.
 * Reads localStorage and applies .dark-mode class on <html> before
 * the page renders, preventing flash-of-wrong-theme.
 */
function pu_dark_mode_head_script() {
	?>
	<script>
	(function(){
		var d = document.documentElement;
		var stored = null;
		try { stored = localStorage.getItem('pu-dark-mode'); } catch(e) {}
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
add_action( 'wp_head', 'pu_dark_mode_head_script', 1 );

/**
 * Register the dark-mode-toggle block.
 */
function pu_register_blocks() {
	register_block_type( get_theme_file_path( 'blocks/dark-mode-toggle' ) );
}
add_action( 'init', 'pu_register_blocks' );

/**
 * Register block patterns.
 */
function pu_register_patterns() {
	register_block_pattern_category( 'publishing-universe', array(
		'label' => __( 'Publishing Universe', 'publishing-universe' ),
	) );
}
add_action( 'init', 'pu_register_patterns' );

/**
 * Add style variation body class for cross-site nav highlighting.
 * Reads the active style variation and adds a body class like
 * 'has-variation-paolo-blog'.
 */
function pu_body_class( $classes ) {
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
add_filter( 'body_class', 'pu_body_class' );

/**
 * Add theme support.
 */
function pu_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_editor_style( 'assets/css/typography.css' );
}
add_action( 'after_setup_theme', 'pu_setup' );
