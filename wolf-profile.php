<?php

/**
 * Plugin Name:       Wolf Profile
 * Description:       A WordPress plugin to manage profiles.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wolf-profile
 * Requires Plugins:  wolf-core, wolf-forms
 *
 * @package WolfProfile
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

require __DIR__ . '/vendor/autoload.php';

register_activation_hook(__FILE__, function () {
	$activator = new Wolf\Profile\Activator();
	$activator->activate();
});
register_deactivation_hook(__FILE__, function () {
	$activator = new Wolf\Profile\Activator();
	$activator->deactivate();
});

$plugin = new Wolf\Profile\Plugin();
$plugin->bootstrap();
