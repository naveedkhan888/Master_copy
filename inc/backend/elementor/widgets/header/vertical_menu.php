<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Vertical Services Menu
 */
class Restobar_Vertical_Menu extends Widget_Base{

 	public function get_name() {
		return 'vertical_services_menu';
	}

	public function get_title() {
		return __( 'XP Vertical Services Menu', 'restobar' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'category_restobar_sidebar' ];
	}

	protected function register_controls() {
		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Menu', 'restobar' ),
			]
		);

		$menus = $this->get_available_menus();
		$this->add_control(
			'nav_menu',
			[
				'label' => esc_html__( 'Select Services Menu', 'restobar' ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'options' => $menus,
				'default' => array_keys( $menus )[0],
				'save_default' => true,
			]
		);

		// Left Icon Options
		$this->add_control(
			'show_left_icon',
			[
				'label' => __( 'Show Left Icon', 'restobar' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'restobar' ),
				'label_off' => __( 'Hide', 'restobar' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'left_icon',
			[
				'label' => __( 'Left Icon', 'restobar' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_left_icon' => 'yes',
				],
			]
		);

		// Right Icon Options
		$this->add_control(
			'show_right_icon',
			[
				'label' => __( 'Show Right Icon', 'restobar' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'restobar' ),
				'label_off' => __( 'Hide', 'restobar' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'right_icon',
			[
				'label' => __( 'Right Icon', 'restobar' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_right_icon' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Icon Style Section
		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => __( 'Icon Style', 'restobar' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Left Icon Color
		$this->add_control(
			'left_icon_color',
			[
				'label' => __( 'Left Icon Color', 'restobar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .vertical-services-menu li a .left-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_left_icon' => 'yes',
				],
			]
		);

		// Right Icon Color
		$this->add_control(
			'right_icon_color',
			[
				'label' => __( 'Right Icon Color', 'restobar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .vertical-services-menu li a .right-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_right_icon' => 'yes',
				],
			]
		);

		// Icon Size
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'restobar' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vertical-services-menu li a .left-icon, 
					 {{WRAPPER}} .vertical-services-menu li a .right-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Section for Vertical Menu
		$this->start_controls_section(
			'style_vertical_menu_section',
			[
				'label' => __( 'Vertical Menu Style', 'restobar' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Background Color for Vertical Menu
		$this->add_control(
			'vertical_menu_bg_color',
			[
				'label' => __( 'Background Color', 'restobar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .vertical-services-menu' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Text Color for Menu Items
		$this->add_control(
			'vertical_menu_text_color',
			[
				'label' => __( 'Text Color', 'restobar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .vertical-services-menu li a' => 'color: {{VALUE}};',
				],
			]
		);

		// Hover Text Color
		$this->add_control(
			'vertical_menu_hover_color',
			[
				'label' => __( 'Hover Text Color', 'restobar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .vertical-services-menu li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		// Active Menu Item Color
		$this->add_control(
			'vertical_active_menu_color',
			[
				'label' => __( 'Active Menu Item Color', 'restobar' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .vertical-services-menu li.current-menu-item > a' => 'color: {{VALUE}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'vertical_menu_typography',
				'selector' => '{{WRAPPER}} .vertical-services-menu li a',
			]
		);

		// Padding
		$this->add_responsive_control(
			'vertical_menu_item_padding',
			[
				'label' => __( 'Item Padding', 'restobar' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .vertical-services-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function get_available_menus(){
		$menus = wp_get_nav_menus();
		$options = [];
		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}
		return $options;
	}

   	protected function render() {
		$settings = $this->get_settings_for_display();
		$active_mmenu = in_array('xp_mega-menu/xp_mega-menu.php', apply_filters('active_plugins', get_option('active_plugins')));
		
		// Prepare icon classes and conditions
		$show_left_icon = $settings['show_left_icon'] === 'yes';
		$show_right_icon = $settings['show_right_icon'] === 'yes';
	?>
		<nav class="vertical-services-navigation">			
			<?php
			// Custom walker to add icons
			class Vertical_Menu_With_Icons_Walker extends \Walker_Nav_Menu {
				private $settings;

				public function __construct($settings) {
					$this->settings = $settings;
				}

				public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
					// Start parent method
					$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
					$classes = empty( $item->classes ) ? array() : (array) $item->classes;
					$classes[] = 'menu-item-' . $item->ID;

					// Prepare class string
					$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
					$class_names = ' class="' . esc_attr( $class_names ) . '"';

					// Start output
					$output .= $indent . '<li' . $class_names .'>';

					// Prepare link attributes
					$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
					$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
					$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
					$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

					// Prepare left icon
					$left_icon_html = '';
					if ($this->settings['show_left_icon'] === 'yes') {
						$left_icon = $this->settings['left_icon'];
						$left_icon_html = sprintf(
							'<span class="left-icon %s" aria-hidden="true"></span>',
							esc_attr($left_icon['value'])
						);
					}

					// Prepare right icon
					$right_icon_html = '';
					if ($this->settings['show_right_icon'] === 'yes') {
						$right_icon = $this->settings['right_icon'];
						$right_icon_html = sprintf(
							'<span class="right-icon %s" aria-hidden="true"></span>',
							esc_attr($right_icon['value'])
						);
					}

					// Link output with icons
					$item_output  = $args->before;
					$item_output .= '<a' . $attributes . '>';
					$item_output .= $left_icon_html;
					$item_output .= '<span class="menu-item-text">' . $item->title . '</span>';
					$item_output .= $right_icon_html;
					$item_output .= '</a>';
					$item_output .= $args->after;

					$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				}
			}

			// Prepare walker with current settings
			$walker = new Vertical_Menu_With_Icons_Walker($settings);

			wp_nav_menu( array(
				'menu' 			 => $settings['nav_menu'],
				'menu_id'        => 'services-menu',
				'menu_class'     => 'vertical-services-menu',
				'container'      => 'ul',
				'theme_location' => '__no_such_location',
				'fallback_cb'    => '__return_empty_string', 
				'walker'         => $active_mmenu ? new \Xp_Mega_Menu_Walker() : $walker,
			) );
			?>
		</nav>
    <?php
	}
}

// Register the new vertical menu widget with Elementor
Plugin::instance()->widgets_manager->register( new Restobar_Vertical_Menu() );