<?php
/**
 * Dark Mode Toggle — server-side render.
 *
 * Outputs the toggle button HTML. The viewScript (view.js) handles
 * the click interaction and localStorage persistence.
 *
 * @package wp3ob7o-blocks
 */

$wrapper_attributes = get_block_wrapper_attributes( array(
	'class' => 'dark-mode-toggle',
) );
?>
<button
	<?php echo $wrapper_attributes; ?>
	role="switch"
	aria-checked="false"
	aria-label="<?php esc_attr_e( 'Dark mode', 'wp3ob7o-blocks' ); ?>"
>
	<span class="icon-moon">&#9789;</span>
	<span class="icon-sun">&#9788;</span>
</button>
