<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Stop Nagging
 * Description:       This plugin removes admin notices which refuse to go away and unwanted dashboard widgets
 * Version:           1.0.1
 * Author:            Christopher Cook
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

if ( is_admin() ) {
  add_action( 'init', 'stop_nagging_nags' );

  // Remove YITH dashboard widgets
  add_filter( 'yith_plugin_fw_show_dashboard_widgets', '__return_false' );
}

function stop_nagging_nags() {

  // Remove useless core dashboard widgets
  add_action('wp_dashboard_setup', 'stop_nagging_dashboard_widgets' );

  // Remove WooCommerce.com connection reminder
  add_filter( 'woocommerce_helper_suppress_connect_notice', '__return_true' );

  // Remove WooCommerce footer
  add_filter( 'woocommerce_display_admin_footer_text', '__return_false' );

  // Remove invoiceexpress advertisement from flat-rate-per-countryregion-for-woocommerce
  remove_action( 'admin_notices', 'webdados_invoicexpress_nag' );

  // Set transient to disable affiliate-wp license nag
  if ( ! get_transient( 'affwp_license_notice' ) ) {
    set_transient( 'affwp_license_notice', true, 1.8 * WEEK_IN_SECONDS );
  }

  // Remove YITH promos
  remove_action( 'admin_notices', 'yith_plugin_fw_promo_notices', 15 );
  remove_action( 'admin_enqueue_scripts', 'yith_plugin_fw_notice_dismiss', 20 );

}

function stop_nagging_dashboard_widgets() {
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
}
