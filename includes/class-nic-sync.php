<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NIC_Sync {
    public static function run() {
        return new WP_Error('nic_no_connector','Nenhum conector externo está habilitado na versão 1.0.1.');
    }
}
