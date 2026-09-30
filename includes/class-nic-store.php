<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NIC_Store {
    public static function table() { global $wpdb; return $wpdb->prefix . 'nic_stores'; }
}
