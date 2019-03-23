<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://elixinol.com
 * @since      1.0.0
 *
 * @package    Elix_Monitor
 * @subpackage Elix_Monitor/admin
 */

function elix_monitor_admin_page() {
	print '<div class="wrap">';
    print '<div id="icon-users" class="icon32"><br/></div>';
    print '<h2>' . __('Commerce Monitor') . '</h2>';
    print '</div>';
}

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Elix_Monitor
 * @subpackage Elix_Monitor/admin
 * @author     Zvi Epner <zvi.epner@elixinol.com>
 */
class Elix_Monitor_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	function _monitor_add_menu_items() {
		$page_title = __('Commerce Monitor', 'elix-monitor');
		if (current_user_can('view_woocommerce_reports')) {
			add_submenu_page( 'woocommerce', $page_title, $page_title, 'view_woocommerce_reports', 'elix-monitor', 'elix_monitor_admin_page');
		}
	}

	function __return_true() {
		return true;
	}

}
