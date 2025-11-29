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

    // ================================
    // Enqueue CSS/JS
    // ================================
    public function enqueue_assets() {
        wp_enqueue_style('spb-admin-style', plugin_dir_url(__FILE__) . 'css/admin-style.css', [], '1.0');
        wp_enqueue_script('spb-admin-js', plugin_dir_url(__FILE__) . 'css/admin-style.js', ['jquery'], '1.0', true);
    }

    // ================================
    // Notificação persistente
    // ================================
    public function show_admin_notice() {
        ?>
        <div class="spb-notice animated-bounce">
            <div class="spb-icon">⚠️</div>
            <div class="spb-notice-text">
                <h2>O seu plugin de SEO global pode estar a prejudicar o seu tráfego em Portugal!</h2>
                <p>Podem existir problemas de linguagem ou de localização que afetam o ranking do seu site. Descubra como otimizar.</p>
            </div>
            <div class="spb-buttons">
                <a href="<?php echo admin_url('admin.php?page=spb-dashboard'); ?>" class="spb-btn spb-btn-primary">Ver Problemas do Site</a>
                <a href="https://seo-pt.pt/" target="_blank" class="spb-btn spb-btn-secondary">Descubra o SEO-PT</a>
            </div>
        </div>
        <?php
    }

    // ================================
    // Painel no menu
    // ================================
    public function add_menu_page() {
        add_menu_page(
            'SEO-PT Booster',            // Título da página
            'SEO-PT Booster',            // Título do menu
            'manage_options',            // Capabilidade
            'spb-dashboard',             // Slug
            [$this, 'dashboard_page'],   // Callback
            'dashicons-chart-area',      // Ícone
            3                             // Posição
        );
    }

    // ================================
    // Conteúdo do Painel
    // ================================
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

            <!-- Cards Persuasivos -->
            <div class="spb-cards-container">
                <!-- Curadoria Linguística -->
                <div class="spb-card spb-card-orange">
                    <div class="spb-card-icon">⚠️</div>
                    <h3>Curadoria Linguística PT-PT</h3>
                    <p>A maioria dos plugins assume Português do Brasil. O seu conteúdo pode não soar natural em Portugal, afetando relevância e tráfego.</p>
                    <a href="#" class="spb-btn spb-btn-primary">Analisar com SEO-PT</a>
                </div>

                <!-- Localização / Schema -->
                <div class="spb-card spb-card-red">
                    <div class="spb-card-icon">🌍</div>
                    <h3>Localização e Schema PT</h3>
                    <p>Plugins globais ignoram Distritos, Concelhos e Freguesias de Portugal, prejudicando SEO local e Schema LocalBusiness.</p>
                    <a href="#" class="spb-btn spb-btn-primary">Corrigir com SEO-PT</a>
                </div>

                <!-- Compatibilidade Plugins SEO -->
                <div class="spb-card spb-card-green">
                    <div class="spb-card-icon">✅</div>
                    <h3>Compatibilidade com Plugins de SEO</h3>
                    <p>SEO-PT integra-se com Yoast, Rank Math, AIOSEO e SEOPress, complementando o seu plugin de SEO sem conflitos.</p>
                </div>
            </div>
        </div>
        <?php
    }
}
