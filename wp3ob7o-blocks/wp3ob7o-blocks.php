<?php
/**
 * Plugin Name: W P3OB7O Blocks
 * Plugin URI: https://p3ob7o.blog/
 * Description: Custom blocks for the W P3OB7O theme. Provides the dark mode toggle and reading time blocks.
 * Version: 0.2.0
 * Author: Paolo Belcastro
 * Author URI: https://paolobelcastro.com
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp3ob7o-blocks
 *
 * @package wp3ob7o-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register all custom blocks.
 */
function wp3ob7o_blocks_init() {
	register_block_type( __DIR__ . '/blocks/dark-mode-toggle' );
	register_block_type( __DIR__ . '/blocks/reading-time' );
}
add_action( 'init', 'wp3ob7o_blocks_init' );
