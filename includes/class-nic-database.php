<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NIC_Database {
    public static function install() {
        global $wpdb;
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        $charset=$wpdb->get_charset_collate();
        $stores=$wpdb->prefix.'nic_stores';
        $offers=$wpdb->prefix.'nic_offers';
        dbDelta("CREATE TABLE $stores (id bigint(20) unsigned NOT NULL AUTO_INCREMENT,name varchar(190) NOT NULL,slug varchar(190) NOT NULL,website_url text NULL,status varchar(20) NOT NULL DEFAULT 'active',created_at datetime NOT NULL,updated_at datetime NOT NULL,PRIMARY KEY (id),UNIQUE KEY slug (slug)) $charset;");
        dbDelta("CREATE TABLE $offers (id bigint(20) unsigned NOT NULL AUTO_INCREMENT,product_id bigint(20) unsigned NOT NULL,store_id bigint(20) unsigned NOT NULL,external_id varchar(190) NULL,title text NULL,price decimal(12,2) NULL,previous_price decimal(12,2) NULL,currency varchar(10) NOT NULL DEFAULT 'BRL',availability varchar(50) NULL,affiliate_url text NULL,product_url text NULL,image_url text NULL,last_synced_at datetime NULL,created_at datetime NOT NULL,updated_at datetime NOT NULL,PRIMARY KEY (id),KEY product_id (product_id),KEY store_id (store_id)) $charset;");
    }
}
