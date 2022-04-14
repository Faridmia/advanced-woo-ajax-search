<?php

/**
 * Plugin Name:       Advanced Woo Ajax Search
 * Plugin URI:        https://github.com/Faridmia/advanced-woo-ajax-search
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            faridmia
 * Author URI:        https://wordpress.org/plugins/search/faridmia/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       asaw-woo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'AWAS_WOO_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-advanced-awas-woo-activator.php
 */
function activate_awas_woo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-advanced-awas-woo-activator.php';
	Advanced_Awas_Woo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-advanced-awas-woo-deactivator.php
 */
function deactivate_awas_woo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-advanced-awas-woo-deactivator.php';
	Advanced_Awas_Woo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_awas_woo' );
register_deactivation_hook( __FILE__, 'deactivate_awas_woo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-advanced-awas-woo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_awas_woo() {

	$plugin = new Advanced_Awas_Woo();
	$plugin->run();
	
}

function awas_admin_notices() { ?>
	<div class="error">
        <p><?php _e( '<strong>Advanced Woo ajax search  requires WooCommerce to be installed and active. You can download <a href="https://woocommerce.com/" target="_blank">WooCommerce</a> here.</strong>', 'awas-woo' ); ?></p>
    </div>
   	<?php
}
// woocommerce   plugin dependency
function awas_install_woocommerce_dependency() {
	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'awas_admin_notices');
	}
}

add_action( 'plugins_loaded',  'awas_install_woocommerce_dependency', 11 );
run_awas_woo();
