<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NIC_Product {
    public static function register() {
        register_post_type('nic_product',array('labels'=>array('name'=>'Produtos','singular_name'=>'Produto'),'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-products','supports'=>array('title','editor','thumbnail','excerpt'),'rewrite'=>array('slug'=>'produtos')));
        register_taxonomy('nic_product_category','nic_product',array('label'=>'Categorias','public'=>true,'show_in_rest'=>true,'hierarchical'=>true));
        register_taxonomy('nic_brand','nic_product',array('label'=>'Marcas','public'=>true,'show_in_rest'=>true,'hierarchical'=>false));
    }
}
