<?php
/*
Plugin Name: SEO-PT Booster Clean
Plugin URI: https://seo-pt.pt/
Description: Plugin SEO-PT Booster com layout clean, responsivo e dashboard avançado.
Version: 1.0
Author: Seu Nome
Text Domain: seo-pt-booster-clean
*/

if ( ! defined('ABSPATH') ) exit;

// Inclui classe admin
require_once plugin_dir_path(__FILE__) . 'admin/class-admin.php';

// Inicializa plugin
function spb_clean_init() {
    SPB_Admin::get_instance();
}
add_action('plugins_loaded', 'spb_clean_init');
