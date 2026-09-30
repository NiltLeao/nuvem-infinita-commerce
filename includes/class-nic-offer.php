<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NIC_Offer {
    public static function table() { global $wpdb; return $wpdb->prefix . 'nic_offers'; }
}
