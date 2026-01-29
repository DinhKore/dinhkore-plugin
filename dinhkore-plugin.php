<?php
/**
 * Plugin Name: DinhKore Plugin
 * Description: Plugin tập sự của DinhKore.
 * Version: 1.0.0
 * Author: DinhKore
 */

//Chặn truy cập trực tiếp
if (!defined('ABSPATH')) {
    exit;
}

//Hàm input Widget (Chạy khi Elementor sẵn sàng)
function dinhkore_load_widgets($widgets_manager)
{
    //Ipnut file widget
    // __DIR__ trỏ đúng vào thư mục dinhkore-plugin hiện tại
    require_once __DIR__ . '/includes/widgets/hello-widget.php';

    //Đăng ký Widget
    $widgets_manager->register(new \DinhKore\Plugin\Widgets\DinhKore_Hello_Widget());
}
add_action('elementor/widgets/register', 'dinhkore_load_widgets');


//Hàm nạp CSS và JS
function dinhkore_enqueue_assets()
{
    // Load file style.css
    wp_enqueue_style(
        'dinhkore-style', // ID
        plugin_dir_url(__FILE__) . 'assets/css/style.css', // Đường dẫn file
        [],
        '1.0.0'
    );

    // Load file main.js
    wp_enqueue_script(
        'dinhkore-script', // ID
        plugin_dir_url(__FILE__) . 'assets/js/main.js', // Đường dẫn file
        ['jquery'], // Load sau jQuery
        '1.0.0',
        true // Load ở footer
    );
}
add_action('wp_enqueue_scripts', 'dinhkore_enqueue_assets');