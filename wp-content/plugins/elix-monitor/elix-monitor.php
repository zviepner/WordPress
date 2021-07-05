<?php

/**
 * The elix-monitor plugin.
 *
 * @link              https://elixinol.com
 * @since             1.0.0
 * @package           elix_monitor
 *
 * @wordpress-plugin
 * Plugin Name:       Commerce Monitor
 * Plugin URI:        https://elixinol.com
 * Description:       Commerce Monitor
 * Version:           1.0.2
 * Author:            Zvi Epner
 * Author URI:        https://elixinol.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       elix-monitor
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'ELIX_MONITOR_VERSION', '1.0.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-elix-monitor-activator.php
 */
function activate_elix_monitor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elix-monitor-activator.php';
	Elix_Monitor_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-elix-monitor-deactivator.php
 */
function deactivate_elix_monitor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elix-monitor-deactivator.php';
	Elix_Monitor_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_elix_monitor' );
register_deactivation_hook( __FILE__, 'deactivate_elix_monitor' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-elix-monitor.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_elix_monitor() {

	$plugin = new Elix_Monitor();
	$plugin->run();

}
run_elix_monitor();
