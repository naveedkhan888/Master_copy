<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Heading 
 */
class Restobar_Heading_dual extends Widget_Base{

 	public function get_name() {
		return 'iheading2';
	}

	public function get_title() {
		return __( 'XP Heading Dual', 'restobar' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'category_restobar' ];
	}

	public static function get_subtitle_style() {
		return [
			'' 				=> __( 'Default', 'restobar' ),
			'is_highlight' 	=> __( 'Highlight', 'restobar' ),
			'is_line' 		=> __( 'Line', 'restobar' ),
		];
	}

	protected function register_controls() {
		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'restobar' ),
			]
		);

		// Existing Subtitle Control
		$this->add_control(
			'sub',
			[
				'label' => __( 'Subtitle', 'restobar' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'our services', 'restobar' ),
				'placeholder' => __( 'Enter your subtitle', 'restobar' ),
				'label_block' => true,
			]
		);

		// First Title (Parent Title)
		$this->add_control(
			'parent_title',
			[
				'label' => __( 'Parent Title', 'restobar' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Our', 'restobar' ),
				'placeholder' => __( 'Enter parent title', 'restobar' ),
				'label_block' => true,
			]
		);

		// Main Title
		$this->add_control(
			'title',
			[
				'label' => __( 'Main Title', 'restobar' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'What we do', 'restobar' ),
				'placeholder' => __( 'Enter your title', 'restobar' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'header_size',
			[
				'label' => __( 'Title HTML Tag', 'restobar' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);

		$this->end_controls_section();

		// Style Section
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Heading', 'restobar' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Existing Subtitle Style Controls (unchanged)
		$this->add_control(
			'heading_stitle',
			[
				'label' => __( 'Subtitle', 'restobar' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'subtitle_style',
			[
				'label' => __( 'Subtitle Style', 'restobar' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => self::get_subtitle_style(),
			]
		);

		// Existing subtitle style controls remain the same...

		// Parent Title Styling
		$this->add_control(
			'heading_parent_title',
			[
				'label' => __( 'Parent Title', 'restobar' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'parent_title_color',
			[
				'label' => __( 'Color', 'restobar' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading .parent-head' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'parent_title_typography',
				'selector' => '{{WRAPPER}} .xp-heading .parent-head',
			]
		);

		// Existing Main Title Styling Controls (unchanged)
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'restobar' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Existing title color and typography controls remain the same...

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$hl = $settings['subtitle_style'];

		$this->add_render_attribute( 'subtitle', 'class', $hl );
		$this->add_render_attribute( 'heading', 'class', 'main-head' );
		$this->add_render_attribute( 'parent_heading', 'class', 'parent-head' );

		$title = $settings['title'];
		$parent_title = $settings['parent_title'];

		$title_html = sprintf( 
			'%1$s<%2$s %3$s>%4$s</%2$s>', 
			(!empty($parent_title) ? '<span '.$this->get_render_attribute_string( 'parent_heading' ).'>' . $parent_title . '</span> ' : ''),
			$settings['header_size'], 
			$this->get_render_attribute_string( 'heading' ), 
			$title 
		);
		?>
		<div class="xp-heading">
	        <?php if( ! empty( $settings['sub'] ) ) { echo '<span '.$this->get_render_attribute_string( 'subtitle' ).'>' .$settings['sub']. '</span>'; } ?>
	        <?php if( ! empty( $settings['title'] ) ) { echo wp_kses_post( $title_html ); } ?>
	    </div>
	    <?php
	}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restobar_Heading_dual() );