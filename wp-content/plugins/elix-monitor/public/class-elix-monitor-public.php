<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://elixinol.com/
 * @since      1.0.0
 *
 * @package    Elix_Monitor
 * @subpackage Elix_Monitor/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Elix_Monitor
 * @subpackage Elix_Monitor/public
 * @author     Zvi Epner <zvi.epner@elixinol.com>
 */
class Elix_Monitor_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function elix_monitor_cron() {

		global $wpdb;
		$query = "SELECT post_modified from wp_posts where post_type = 'shop_order' LIMIT 0,1";
		$results = $wpdb->get_row($query);
		$post_date = new DateTime($results->post_modified);
		$now = new DateTime("now");
        $interval = $now->getTimestamp() - $post_date->getTimestamp();
        $threshhold = get_option( 'order_gap_threshhold', 900 );
        $env = (isset($_ENV['PANTHEON_ENVIRONMENT'])) ? $_ENV['PANTHEON_ENVIRONMENT'] : 'local';

        if ($interval > $threshhold) {
            $to = 'chris.cook@elixinol.com';
            $subject = 'No orders in past ' . ($threshhold / 60) . ' mins';
            $body = 'This is a notice from the elix-monitor plugin. There have been no orders placed on the ' . $env .  ' environment.';
            $headers = ['Content-Type: text/html; charset=UTF-8'];
            $headers[] = 'Cc: zvi.epner@elixinol.com';
            wp_mail( $to, $subject, $body, $headers );
        }
	}


}
