<?php
/**
 * Plugin Name: DinhKore Plugin
 * Description: Plugin tập sự của DinhKore.
 * Version: 1.0.0
 * Author: DinhKore
 */

// 1. Chặn truy cập trực tiếp (Cái này luôn cần)
if (!defined('ABSPATH')) {
    exit;
}

// 2. Hàm này sẽ chạy khi Elementor sẵn sàng
function dinhkore_load_widgets($widgets_manager)
{

    // BƯỚC A: Tìm và nạp file widget vào
    // Bạn nhớ kiểm tra đúng đường dẫn file nhé
    require_once __DIR__ . '/includes/widgets/hello-widget.php';

    // BƯỚC B: Đăng ký nó
    // Lưu ý: Namespace và Class phải khớp y hệt trong file hello-widget.php
    $widgets_manager->register(new \ElementorPro\Modules\DinhKoreWidget\DinhKore_Hello_Widget());

}

// 3. Móc hàm trên vào sự kiện của Elementor
// Ý nghĩa: "Ê Elementor, khi nào mày load xong widget, thì chạy giùm tao cái hàm dinhkore_load_widgets nha"
add_action('elementor/widgets/register', 'dinhkore_load_widgets');

function dinhkore_enqueue_assets()
{
    //load CSS file
    wp_enqueue_style(
        'dinhkore-plugin-styles',
        plugin_dir_url(__FILE__) . 'assets/css/dinhkore-styles.css',
        [],
        '1.0.0'
    );

    //load JS file
    wp_enqueue_script(
        'dinhkore-plugin-scripts',
        plugin_dir_url(__FILE__) . 'assets/js/dinhkore-scripts.js',
        ['jquery'], //load sau jQuery
        '1.0.0',
        true    //load ở chân trang (foooter)
    );
}

add_action('wp_enqueue_scripts', 'dinhkore_enqueue_assets');