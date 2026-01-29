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

/**
 * HẾT. Đơn giản vậy thôi!
 * Không cần kiểm tra phiên bản PHP, không cần Class Singleton phức tạp.
 */