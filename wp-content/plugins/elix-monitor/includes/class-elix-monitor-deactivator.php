<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://elixinol.com/
 * @since      1.0.0
 *
 * @package    Elix_Monitor
 * @subpackage Elix_Monitor/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Elix_Monitor
 * @subpackage Elix_Monitor/includes
 * @author     Zvi Epner <zvi.epner@elixinol.com>
 */
class Elix_Monitor_Deactivator {

	/**
	 * Delete options.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$timestamp = wp_next_scheduled('elix_monitor_cronjob');
		wp_unschedule_event($timestamp, 'elix_monitor_cronjob');
	}

}
