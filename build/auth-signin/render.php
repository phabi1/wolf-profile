<?php

/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<div>
		<div>
			<input />
		</div>
		<div>
			<input />
			<div>
				<a href="/password-reset">Forgot your password?</a>
			</div>
		</div>
		<div>
			<button>Sign In</button>
		</div>
	</div>
	<p>Don't have an account? <a href="/signup">Sign Up</a></p>
</div>