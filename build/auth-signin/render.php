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

use Wolf\Core\DependencyInjection\Container;

/**
 * @var \Wolf\Forms\Form\FormManager $formManager
 */
$formManager = Container::getInstance()->get('wolf-forms.form.manager');
$signinForm = $formManager->get('wolf-profile.form.signin');

?>

<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php echo $signinForm->getForm(); ?>
	<p>Don't have an account? <a href="/signup">Sign Up</a></p>
</div>