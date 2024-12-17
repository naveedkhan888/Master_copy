<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Restobar_Icon_List extends Widget_Base {

    public function get_name() {
        return 'iicon_list';
    }

    public function get_title() {
        return __( 'XP Icon List', 'restobar' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return [ 'category_restobar' ];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Icon List', 'restobar' ),
            ]
        );

        // Repeater for Icon List Items
        $repeater = new Repeater();

        $repeater->add_control(
            'list_icon',
            [
                'label' => __( 'Icon', 'restobar' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'list_title',
            [
                'label' => __( 'Title', 'restobar' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'List Item', 'restobar' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_link',
            [
                'label' => __( 'Link', 'restobar' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'restobar' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'icon_list',
            [
                'label' => __( 'Icon List', 'restobar' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'list_title' => __( 'First Item', 'restobar' ),
                    ],
                    [
                        'list_icon' => [
                            'value' => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'list_title' => __( 'Second Item', 'restobar' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'restobar' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'restobar' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'restobar' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'restobar' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-icon-list' => 'text-align: {{VALUE}};',
                ],
                'default' => '',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Icon List Style', 'restobar' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Icon Styling
        $this->add_control(
            'icon_heading',
            [
                'label' => __( 'Icon', 'restobar' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'restobar' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xp-icon-list-item .xp-icon' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'restobar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-icon-list-item .xp-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __( 'Spacing', 'restobar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-icon-list-item .xp-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Text Styling
        $this->add_control(
            'text_heading',
            [
                'label' => __( 'Text', 'restobar' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Color', 'restobar' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xp-icon-list-item-text' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .xp-icon-list-item-text',
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => __( 'Item Spacing', 'restobar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-icon-list-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="xp-icon-list">
            <?php foreach ( $settings['icon_list'] as $index => $item ) : 
                $migrated = isset( $item['__fa4_migrated']['list_icon'] );
                $is_new = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();
                $link_key = 'link_' . $index;
            ?>
                <div class="xp-icon-list-item">
                    <?php 
                    if ( ! empty( $item['list_link']['url'] ) ) {
                        $this->add_link_attributes( $link_key, $item['list_link'] );
                        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                    }
                    ?>
                    <?php if ( $item['list_icon']['value'] ) : ?>
                        <span class="xp-icon">
                            <?php
                            if ( $is_new || $migrated ) {
                                Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] );
                            } else {
                                echo '<i class="' . esc_attr( $item['list_icon']['value'] ) . '" aria-hidden="true"></i>';
                            }
                            ?>
                        </span>
                    <?php endif; ?>
                    <span class="xp-icon-list-item-text"><?php echo esc_html( $item['list_title'] ); ?></span>
                    <?php 
                    if ( ! empty( $item['list_link']['url'] ) ) {
                        echo '</a>';
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}

// Register the new widget
Plugin::instance()->widgets_manager->register( new Restobar_Icon_List() );