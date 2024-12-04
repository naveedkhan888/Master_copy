<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Restobar_Elementor_Circular_Text extends Widget_Base {

	public function get_name() {
		return 'restobar_elementor_circular_text';
	}

	public function get_title() {
		return esc_html__( 'Circular Animated Text', 'restobar' );
	}

	public function get_icon() {
		return 'eicon-animation-text';
	}

	public function get_categories() {
		return [ 'restobar' ];
	}

	// Add Your Controls In This Function
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'restobar' ),
			]
		);	

		// Main Icon
		$this->add_control(
			'main_icon',
			[
				'label' => esc_html__( 'Main Icon', 'restobar' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'flaticon flaticon-flower',
					'library' => 'flaticon',
				],
			]
		);

		// Repeater for Circular Items
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_icon',
			[
				'label' => esc_html__( 'Item Icon', 'restobar' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'flaticon flaticon-leaf',
					'library' => 'flaticon',
				],
			]
		);

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'restobar' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Your Text' , 'restobar' ),
				'show_label' => true,
			]
		);

		$repeater->add_control(
			'color',
			[
				'label' => esc_html__( 'Color', 'restobar' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Circular Items', 'restobar' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Delicious Food','restobar' ),
					],
					[
						'text' => esc_html__( 'Fresh Ingredients','restobar' ),
					],
					[
						'text' => esc_html__( 'Great Atmosphere', 'restobar' ),
					],
					[
						'text' => esc_html__( 'Unique Experience', 'restobar' ),
					],
				],
			]
		);

		$this->end_controls_section();

		// Style Sections
		$this->start_controls_section(
			'general_section_style',
			[
				'label' => esc_html__( 'General', 'restobar' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'circle_size',
			[
				'label' => esc_html__( 'Circle Size', 'restobar' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 800,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .xp-circular-text' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'circle_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .xp-circular-text',
			]
		);

		$this->end_controls_section();

		// Icon Style Section
		$this->start_controls_section(
			'icon_section_style',
			[
				'label' => esc_html__( 'Icons', 'restobar' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'main_icon_size',
			[
				'label' => esc_html__( 'Main Icon Size', 'restobar' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-circular-text .center-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xp-circular-text .center-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'main_icon_color',
			[
				'label' => esc_html__( 'Main Icon Color', 'restobar' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xp-circular-text .center-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .xp-circular-text .center-icon svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'circle_icon_size',
			[
				'label' => esc_html__( 'Circle Icons Size', 'restobar' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-circular-text .circle-item-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xp-circular-text .circle-item-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Text Style Section
		$this->start_controls_section(
			'text_section_style',
			[
				'label' => esc_html__( 'Text', 'restobar' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'circle_text_typography',
				'selector' => '{{WRAPPER}} .xp-circular-text .circle-item-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'restobar' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .xp-circular-text .circle-item-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings_for_display();
		$items = $settings['items'];
		$total_items = count($items);
		?>

		<div class="xp-circular-text">
			<div class="center-icon">
				<?php \Elementor\Icons_Manager::render_icon( $settings['main_icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>

			<?php foreach($items as $index => $item) {
				$item_id = 'elementor-repeater-item-' . $item['_id'];
				$angle = ($index / $total_items) * 360;
				?>
				<div 
					class="circle-item <?php echo esc_attr($item_id); ?>"
					style="--item-angle: <?php echo esc_attr($angle); ?>deg;"
				>
					<div class="circle-item-icon">
						<?php \Elementor\Icons_Manager::render_icon( $item['item_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
					<div class="circle-item-text">
						<?php echo esc_html($item['text']); ?>
					</div>
				</div>
			<?php } ?>
		</div>

		<?php
	}

	// CSS for the widget
	public function get_style_depends() {
		return [ 'restobar-circular-text-style' ];
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Restobar_Elementor_Circular_Text() );