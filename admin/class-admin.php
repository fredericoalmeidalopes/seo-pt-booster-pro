<?php
if ( ! defined('ABSPATH') ) exit;

class SPB_Admin {
    private static $instance = null;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('admin_notices', [$this, 'show_admin_notice']);
        add_action('admin_menu', [$this, 'add_menu_page']);
    }

    public function enqueue_assets() {
        wp_enqueue_style('spb-admin-style', plugin_dir_url(__FILE__) . 'css/admin-style.css', [], '1.0');
    }

    // Notificação top admin
    public function show_admin_notice() {
        ?>
        <div class="spb-notice">
            <div class="spb-notice-icon">⚠️</div>
            <div class="spb-notice-text">
                <h2>O seu plugin de SEO global pode estar a prejudicar o seu tráfego em Portugal!</h2>
                <p>Podem existir problemas de linguagem ou localização que afetam o ranking do seu site. Descubra como otimizar.</p>
            </div>
            <div class="spb-notice-buttons">
                <a href="<?php echo admin_url('admin.php?page=spb-dashboard'); ?>" class="spb-btn spb-btn-primary">Ver Problemas do Site</a>
                <a href="https://seo-pt.pt/" target="_blank" class="spb-btn spb-btn-secondary">Descubra o SEO-PT</a>
            </div>
        </div>
        <?php
    }

    // Painel no menu
    public function add_menu_page() {
        add_menu_page(
            'SEO-PT Booster',            // Page title
            'SEO-PT Booster',            // Menu title
            'manage_options',            // Capability
            'spb-dashboard',             // Slug
            [$this, 'dashboard_page'],   // Callback
            'dashicons-chart-area',      // Icon
            3                             // Position
        );
    }

    // Dashboard
    public function dashboard_page() {
        ?>
        <div class="wrap">
            <h1>SEO-PT Booster Dashboard</h1>

            <!-- Barra de Risco -->
            <div class="spb-risk-bar">
                <span>Risco de perda de tráfego em Portugal: <strong>Alto</strong></span>
                <div class="spb-progress">
                    <div class="spb-progress-fill" style="width: 80%;"></div>
                </div>
            </div>

            <!-- Cards -->
            <div class="spb-cards-container">
                <div class="spb-card spb-card-orange">
                    <div class="spb-card-icon">⚠️</div>
                    <h3>Curadoria Linguística PT-PT</h3>
                    <p>A maioria dos plugins assume Português do Brasil. O seu conteúdo pode não soar natural em Portugal, afetando relevância e tráfego.</p>
                    <a href="#" class="spb-btn spb-btn-primary">Analisar com SEO-PT</a>
                </div>

                <div class="spb-card spb-card-red">
                    <div class="spb-card-icon">🌍</div>
                    <h3>Localização e Schema PT</h3>
                    <p>Plugins globais ignoram Distritos, Concelhos e Freguesias de Portugal, prejudicando SEO local e Schema LocalBusiness.</p>
                    <a href="#" class="spb-btn spb-btn-primary">Corrigir com SEO-PT</a>
                </div>

                <div class="spb-card spb-card-green">
                    <div class="spb-card-icon">✅</div>
                    <h3>Compatibilidade Plugins SEO</h3>
                    <p>SEO-PT integra-se com Yoast, Rank Math, AIOSEO e SEOPress, complementando o seu plugin de SEO sem conflitos.</p>
                </div>
            </div>
        </div>
        <?php
    }
}
