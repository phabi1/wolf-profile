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
			<input id="auth-signup-username" name="username" />
		</div>
		<div>
			<input id="auth-signup-email" name="email" />
		</div>
		<div>
			<input id="auth-signup-firstname" name="firstname" />
		</div>
		<div>
			<input id="auth-signup-lastname" name="lastname" />
		</div>
		<div>
			<input id="auth-signup-password" name="password" />
			<input id="auth-signup-password-confirm" name="password-confirm" />
		</div>
		<div>
			<button>Sign Up</button>
		</div>
	</div>
	<p>Already have an account? <a href="/signin">Sign In</a></p>
</div>