<?php

/**
 * Fired during plugin activation
 *
 * @link       https://elixinol.com/
 * @since      1.0.0
 *
 * @package    Elix_Monitor
 * @subpackage Elix_Monitor/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Elix_Monitor
 * @subpackage Elix_Monitor/includes
 * @author     Zvi Epner <zvi.epner@elixinol.com>
 */
class Elix_Monitor_Activator {

	/**
	 * Add options.
	 *
	 * This is a temporary measure until a settings page is created to allow customizing the options.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {


		if( !wp_next_scheduled( 'elix_monitor_cronjob' ) ) {
			wp_schedule_event( time(), '5m', 'elix_monitor_cronjob' );
		}

	}

}
