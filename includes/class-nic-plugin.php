<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class NIC_Plugin {
    private static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        add_action( 'init', array( 'NIC_Product', 'register' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'public_assets' ) );
        add_shortcode( 'nic_product', array( $this, 'shortcode_product' ) );
        add_shortcode( 'nic_offers', array( $this, 'shortcode_offers' ) );
    }

    public function admin_menu() {
        add_menu_page( 'Nuvem Commerce', 'Nuvem Commerce', 'manage_options', 'nic-commerce', array( $this, 'dashboard' ), 'dashicons-cart' );
        add_submenu_page( 'nic-commerce', 'Ofertas', 'Ofertas', 'manage_options', 'nic-offers', array( $this, 'offers' ) );
        add_submenu_page( 'nic-commerce', 'Lojas', 'Lojas', 'manage_options', 'nic-stores', array( $this, 'stores' ) );
        add_submenu_page( 'nic-commerce', 'Sincronização', 'Sincronização', 'manage_options', 'nic-sync', array( $this, 'sync' ) );
        add_submenu_page( 'nic-commerce', 'Configurações', 'Configurações', 'manage_options', 'nic-settings', array( $this, 'settings' ) );
    }

    public function dashboard() {
        echo '<div class="wrap"><h1>Nuvem Infinita Commerce</h1><p>Catálogo, lojas e ofertas.</p></div>';
    }

    public function offers() {
        echo '<div class="wrap"><h1>Ofertas</h1><p>O gerenciamento de ofertas será expandido nas próximas versões.</p></div>';
    }

    public function stores() {
        echo '<div class="wrap"><h1>Lojas</h1><p>O gerenciamento de lojas será expandido nas próximas versões.</p></div>';
    }

    public function sync() {
        echo '<div class="wrap"><h1>Sincronização</h1><p>Integrações externas estão desativadas na V1.0.1.</p></div>';
    }

    public function settings() {
        echo '<div class="wrap"><h1>Configurações</h1><p>As configurações serão ampliadas nas próximas versões.</p></div>';
    }

    public function admin_assets() {
        wp_enqueue_style( 'nic-admin', NIC_URL . 'assets/css/admin.css', array(), NIC_VERSION );
    }

    public function public_assets() {
        wp_enqueue_style( 'nic-public', NIC_URL . 'assets/css/public.css', array(), NIC_VERSION );
    }

    /**
     * Render a product by ID.
     * Usage: [nic_product id="123"]
     */
    public function shortcode_product( $atts ) {
        $atts = shortcode_atts(
            array(
                'id' => 0,
            ),
            $atts,
            'nic_product'
        );

        $product_id = absint( $atts['id'] );
        if ( ! $product_id ) {
            return '';
        }

        $product = get_post( $product_id );
        if ( ! $product || 'nic_product' !== $product->post_type || 'publish' !== $product->post_status ) {
            return '';
        }

        ob_start();
        ?>
        <article class="nic-product-card">
            <?php if ( has_post_thumbnail( $product_id ) ) : ?>
                <div class="nic-product-image">
                    <?php echo wp_kses_post( get_the_post_thumbnail( $product_id, 'medium' ) ); ?>
                </div>
            <?php endif; ?>
            <div class="nic-product-content">
                <h2 class="nic-product-title"><?php echo esc_html( get_the_title( $product_id ) ); ?></h2>
                <?php if ( ! empty( $product->post_excerpt ) ) : ?>
                    <div class="nic-product-excerpt"><?php echo wp_kses_post( wpautop( $product->post_excerpt ) ); ?></div>
                <?php endif; ?>
                <div class="nic-product-description">
                    <?php echo wp_kses_post( apply_filters( 'the_content', $product->post_content ) ); ?>
                </div>
            </div>
        </article>
        <?php
        return ob_get_clean();
    }

    /**
     * Render offers for a product.
     * Usage: [nic_offers product_id="123"]
     */
    public function shortcode_offers( $atts ) {
        global $wpdb;

        $atts = shortcode_atts(
            array(
                'product_id' => 0,
            ),
            $atts,
            'nic_offers'
        );

        $product_id = absint( $atts['product_id'] );
        if ( ! $product_id ) {
            return '';
        }

        $offers_table = NIC_Offer::table();
        $stores_table = NIC_Store::table();

        $offers = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT o.*, s.name AS store_name
                FROM {$offers_table} o
                LEFT JOIN {$stores_table} s ON s.id = o.store_id
                WHERE o.product_id = %d
                ORDER BY o.price IS NULL ASC, o.price ASC, o.id ASC",
                $product_id
            )
        );

        if ( empty( $offers ) ) {
            return '<div class="nic-no-offers">Nenhuma oferta cadastrada para este produto.</div>';
        }

        ob_start();
        ?>
        <div class="nic-offers-list">
            <?php foreach ( $offers as $offer ) : ?>
                <article class="nic-offer-card">
                    <div class="nic-offer-info">
                        <?php if ( ! empty( $offer->store_name ) ) : ?>
                            <div class="nic-offer-store"><?php echo esc_html( $offer->store_name ); ?></div>
                        <?php endif; ?>
                        <?php if ( ! empty( $offer->title ) ) : ?>
                            <div class="nic-offer-title"><?php echo esc_html( $offer->title ); ?></div>
                        <?php endif; ?>
                        <?php if ( null !== $offer->price && '' !== $offer->price ) : ?>
                            <div class="nic-offer-price">
                                <?php echo esc_html( number_format_i18n( (float) $offer->price, 2 ) ); ?>
                                <span class="nic-offer-currency"><?php echo esc_html( strtoupper( $offer->currency ) ); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $offer->availability ) ) : ?>
                            <div class="nic-offer-availability"><?php echo esc_html( $offer->availability ); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $offer->affiliate_url ) ) : ?>
                        <a class="nic-offer-button" href="<?php echo esc_url( $offer->affiliate_url ); ?>" target="_blank" rel="nofollow sponsored noopener">Ver oferta</a>
                    <?php elseif ( ! empty( $offer->product_url ) ) : ?>
                        <a class="nic-offer-button" href="<?php echo esc_url( $offer->product_url ); ?>" target="_blank" rel="nofollow noopener">Ver produto</a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}
