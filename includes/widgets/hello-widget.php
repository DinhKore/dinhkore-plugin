<?php
namespace ElementorPro\Modules\DinhKoreWidget;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class DinhKore_Hello_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'dinhkore_hello';
    }

    public function get_title()
    {
        return 'DinhKore Hello';
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Nội Dung',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_content',
            [
                'label' => 'Nhập văn bản',
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Xin chào! Đây là Widget đầu tiên của DinhKore.',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Thêm class "dinhkore-box" để tí nữa mình viết CSS cho nó đẹp
        echo '<div class="dinhkore-box">';
        echo '<h3 class="dinhkore-title">Thông báo từ DinhKore:</h3>';
        echo '<div class="dinhkore-text">' . $settings['text_content'] . '</div>';
        echo '</div>';
    }
}