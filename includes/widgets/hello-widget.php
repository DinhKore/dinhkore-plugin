<?php
namespace DinhKore\Plugin\Widgets; // 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit;
}

class DinhKore_Hello_Widget extends Widget_Base
{
    //ID Widget
    public function get_name()
    {
        return 'dinhkore_hello';
    }

    //Tên hiển thị
    public function get_title()
    {
        return 'DinhKore Hello';
    }

    //Icon
    public function get_icon()
    {
        return 'eicon-code';
    }

    //Danh mục
    public function get_categories()
    {
        return ['basic'];
    }

    //Controls (nhập text)
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Cài đặt nội dung',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_content',
            [
                'label' => 'Nội dung hiển thị',
                'type' => Controls_Manager::TEXTAREA, // Dùng TextArea nhập cho thoải mái
                'default' => 'Xin chào! Đây là Widget đầu tiên của DinhKore.',
            ]
        );

        $this->end_controls_section();
    }

    //echo ra
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Thêm class để CSS cho đẹp
        echo '<div class="dinhkore-box">';
        echo '<h3 class="dinhkore-title">Thông báo:</h3>';
        // Giữ nguyên style color: blue như ý bạn
        echo '<div class="dinhkore-text" style="color: blue;">' . $settings['text_content'] . '</div>';
        echo '</div>';
    }
}