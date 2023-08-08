<?php

/**
 * Plugin Arsip Nomor Agenda oleh Nur Dita Damayanti
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/dhytalu/yanum-arsip-plugin.git
 * @since             1.0.0
 * @package           arsip_yanum
 *
 * Plugin Name: Arsip Nomor Agenda
 * Description: Arsip Nomor Agenda adalah plugin untuk mencatat arsip nomor agenda di pelayanan umum kantor Kecamatan Weru dan sebagai projek tugas akhir.
 * Author: Nur Dita Damayanti - 20141287
 * Author URI: https://github.com/dhytalu
 * Version: 1.0.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       arsip-yanum
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!defined('ARSIP_YANUM_VERSION'))       define('ARSIP_YANUM_VERSION', '1.0.2'); // Plugin version constant
if (!defined('ARSIP_YANUM_PLUGIN'))        define('ARSIP_YANUM_PLUGIN', trim(dirname(plugin_basename(__FILE__)), '/')); // Name of the plugin folder eg - 'arsip-yanum'
if (!defined('ARSIP_YANUM_PLUGIN_DIR'))    define('ARSIP_YANUM_PLUGIN_DIR', plugin_dir_path(__FILE__)); // Plugin directory absolute path with the trailing slash. Useful for using with includes eg - /var/www/html/wp-content/plugins/arsip-yanum/
if (!defined('ARSIP_YANUM_PLUGIN_URL'))    define('ARSIP_YANUM_PLUGIN_URL', plugin_dir_url(__FILE__)); // URL to the plugin folder with the trailing slash. Useful for referencing src eg - http://localhost/wp/wp-content/plugins/arsip-yanum/

$includes = [
    'inc/ajax.php',
    'inc/nikah-posttype.php',
    'inc/form-post.php',
    'inc/kredit-posttype.php',
    'inc/ktp-kk-posttype.php',
    'inc/pindah-datang-posttype.php',
    'inc/pindah-keluar-posttype.php',
    'inc/shortcode.php',
    'inc/skck-posttype.php',
    'inc/tabel-data.php',
    'inc/umum-post-type.php',
];

foreach ($includes as $include) {
    require_once(ARSIP_YANUM_PLUGIN_DIR . $include);
}

function arsipyanum_register_scripts()
{
    wp_enqueue_style('dataTable-button-styles', 'https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css', array(), ARSIP_YANUM_VERSION, false);
    wp_enqueue_style('dataTable-bootstrap5-styles', 'https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css', array(), ARSIP_YANUM_VERSION, false);
    wp_enqueue_style('glightbox-style', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', array(), ARSIP_YANUM_VERSION, false);
    wp_enqueue_style('arsipyanum-style', ARSIP_YANUM_PLUGIN_URL . 'css/custom.css', array(), ARSIP_YANUM_VERSION, false);

    wp_enqueue_script('jquery');
    wp_enqueue_script('dataTable-scripts', 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('dataTable-button-scripts', 'https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('dataTable-buttonbootstrap5-scripts', 'https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('dataTable-bootstrap5-scripts', 'https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('jszip-button-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('pdft-button-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('vfs_fonts-button-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('chart-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('buttonsdata-button-scripts', 'https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('glightbox-script', 'https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_enqueue_script('arsipyanum-script', ARSIP_YANUM_PLUGIN_URL . 'js/script.js', array('jquery'), ARSIP_YANUM_VERSION, true);
    wp_localize_script(
        'arsipyanum-script',
        'arsipyanum',
        array(
            'ajaxurl'   => admin_url('admin-ajax.php'),
            'siteurl'   => get_site_url(),
        )
    );
}
add_action('wp_enqueue_scripts', 'arsipyanum_register_scripts');

add_action('init', 'myhead_custom');
function myhead_custom()
{
    //start session
    if (!session_id()) {
        session_start();
    }

    if (empty($_SESSION["Captcha"])) {
        $_SESSION["Captcha"] =  uniqid();
    }
}

add_action('wp_head', 'myajax_ajaxurl');
function myajax_ajaxurl()
{
    $html    = '<script type="text/javascript">';
    $html   .= 'var ajaxurl = "' . admin_url('admin-ajax.php') . '"';
    $html   .= '</script>';
    echo $html;
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
