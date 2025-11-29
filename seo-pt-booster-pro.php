<?php
/*
Plugin Name: SEO-PT Booster PRO
Plugin URI: https://seo-pt.pt/
Description: Notificações avançadas e painel persuasivo para SEO-PT.
Version: 1.0
Author: Seu Nome
Text Domain: seo-pt-booster-pro
*/

if ( ! defined('ABSPATH') ) exit; // Proteção contra acesso direto

// Inclui classe admin
require_once plugin_dir_path(__FILE__) . 'admin/class-admin.php';

// Inicializa o plugin
function spb_pro_init() {
    SPB_Admin::get_instance();
}
add_action('plugins_loaded', 'spb_pro_init');
