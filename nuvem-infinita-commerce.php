<?php
/**
 * Plugin Name: Nuvem Infinita Commerce
 * Description: Catálogo de produtos, lojas e ofertas para o Nuvem Infinita Tech.
 * Version: 1.0.1
 * Author: Nuvem Infinita Tech
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Requires at least: 6.4
 * Requires PHP: 7.4
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'NIC_VERSION', '1.0.1' );
define( 'NIC_PATH', plugin_dir_path( __FILE__ ) );
define( 'NIC_URL', plugin_dir_url( __FILE__ ) );


require_once NIC_PATH . 'includes/class-nic-database.php';
require_once NIC_PATH . 'includes/class-nic-product.php';
require_once NIC_PATH . 'includes/class-nic-store.php';
require_once NIC_PATH . 'includes/class-nic-offer.php';
require_once NIC_PATH . 'includes/class-nic-sync.php';
require_once NIC_PATH . 'includes/class-nic-plugin.php';

/**
 * Plugin activation callback.
 */
function nic_activate() {
    NIC_Database::install();
    NIC_Product::register();
    flush_rewrite_rules();
    update_option( 'nic_version', NIC_VERSION );
}

/**
 * Plugin deactivation callback.
 */
function nic_deactivate() {
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'nic_activate' );
register_deactivation_hook( __FILE__, 'nic_deactivate' );

NIC_Plugin::instance();
