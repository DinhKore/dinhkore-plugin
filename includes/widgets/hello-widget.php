<?php
/**
 * Plugin Name: DinhKore Elementor Addon (Pro Structure)
 * Description: Plugin mở rộng Elementor với cấu trúc code chuyên nghiệp, kiểm tra dependencies chặt chẽ.
 * Plugin URI:  https://dinhkore.com
 * Version:     1.0.0
 * Author:      DinhKore
 * Author URI:  https://dinhkore.com
 * Text Domain: dinhkore-plugin
 * Requires PHP: 7.4
 * Requires at least: 6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// 1. Định nghĩa Class chính (Final để không ai kế thừa linh tinh)
final class DinhKore_Plugin
{

    // Hằng số phiên bản
    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.10.0';
    const MINIMUM_PHP_VERSION = '7.4';

    // Instance (Singleton Pattern)
    private static $_instance = null;

    // Hàm lấy instance duy nhất
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor: Chạy khi class được gọi
    public function __construct()
    {
        // Nhúng hook 'plugins_loaded' để bắt đầu kiểm tra hệ thống
        add_action('plugins_loaded', [$this, 'init']);
    }

    // Hàm khởi tạo chính
    public function init()
    {
        // Kiểm tra xem Elementor đã được cài và kích hoạt chưa
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }

        // Kiểm tra phiên bản Elementor có cũ quá không
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Kiểm tra phiên bản PHP (Cho chắc ăn)
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // --- NẾU MỌI THỨ OK THÌ MỚI CHẠY TIẾP ---
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    // Định nghĩa đường dẫn
    private function define_constants()
    {
        define('DINHKORE_PLUGIN_PATH', plugin_dir_path(__FILE__));
        define('DINHKORE_PLUGIN_URL', plugin_dir_url(__FILE__));
    }

    // Nạp các file cần thiết
    private function includes()
    {
        // Nạp file widget của bạn
        require_once DINHKORE_PLUGIN_PATH . 'includes/widgets/dinhkore-hello-widget.php';
    }

    // Đăng ký các Hook hoạt động
    private function init_hooks()
    {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    // Hàm đăng ký Widget
    public function register_widgets($widgets_manager)
    {
        // Namespace này phải khớp với trong file widget của bạn
        // Giả sử namespace trong file widget là: ElementorPro\Modules\DinhKoreWidget
        // Và class là: DinhKore_Hello_Widget
        if (class_exists('\ElementorPro\Modules\DinhKoreWidget\DinhKore_Hello_Widget')) {
            $widgets_manager->register(new \ElementorPro\Modules\DinhKoreWidget\DinhKore_Hello_Widget());
        }
    }

    // Load CSS/JS
    public function enqueue_styles()
    {
        wp_enqueue_style('dinhkore-style', DINHKORE_PLUGIN_URL . 'assets/css/style.css', [], self::VERSION);
    }

    /**
     * --- CÁC HÀM HIỂN THỊ THÔNG BÁO LỖI (ADMIN NOTICES) ---
     */

    public function admin_notice_missing_elementor()
    {
        if (isset($_GET['activate']))
            unset($_GET['activate']);
        $message = sprintf(
            'Plugin <strong>"%s"</strong> yêu cầu phải cài đặt và kích hoạt <strong>Elementor</strong> trước.',
            'DinhKore Elementor Addon'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%s</p></div>', $message);
    }

    public function admin_notice_minimum_elementor_version()
    {
        if (isset($_GET['activate']))
            unset($_GET['activate']);
        $message = sprintf(
            'Plugin <strong>"%s"</strong> yêu cầu Elementor phiên bản <strong>%s</strong> trở lên.',
            'DinhKore Elementor Addon',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%s</p></div>', $message);
    }

    public function admin_notice_minimum_php_version()
    {
        if (isset($_GET['activate']))
            unset($_GET['activate']);
        $message = sprintf(
            'Plugin <strong>"%s"</strong> yêu cầu PHP phiên bản <strong>%s</strong> trở lên.',
            'DinhKore Elementor Addon',
            self::MINIMUM_PHP_VERSION
        );
        printf('<div class="notice notice-error is-dismissible"><p>%s</p></div>', $message);
    }
}

// Khởi chạy Plugin
DinhKore_Plugin::instance();