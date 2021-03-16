<?php
namespace WB_PS\POST_SLIDER;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
/**
 * Elementor Post Slider Slider Widget.
 *
 * Main widget that create the Post Slider widget
 *
 * @since 1.0.0
*/
class WB_PS_WIDGET extends \Elementor\Widget_Base
{

	/**
	 * Get widget name
	 *
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wb-post-slider';
	}

	/**
	 * Get widget title
	 *
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html( 'Post Slider', 'post-slider-for-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-columns';
	}

	/**
	 * Retrieve the widget category.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_categories() {
		return [ 'web-builder-element' ];
	}

	public function get_style_depends()
    {
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim',
        ];
    }

    public function get_script_depends()
    {
        return [
            'font-awesome-4-shim'
        ];
    }

	/**
	 * Retrieve the widget category.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'query_configuration',
			[
				'label' => esc_html( 'Query', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$post_types = wb_get_post_types();
		$this->add_control(
			'post_types',
			[
				'label' => esc_html__( 'Post Types', 'post-slider-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Post Types', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'post',
				'options' => $post_types,
				'description' => __('You can select <strong><a href="'.WB_PS_PRO_LINK.'" target="_blank" >Custom Post Types</a></strong> on the <a href="'.WB_PS_PRO_LINK.'" target="_blank" >Pro</a> Version. <a style="font-size: 12px; padding: 0 10px" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>'),
			]
		);

		$taxonomies = get_taxonomies([], 'objects');
		foreach ($taxonomies as $taxonomy => $object) {
            if (!isset($object->object_type[0]) || !in_array($object->object_type[0], array_keys($post_types))) {
                continue;
            }

            $this->add_control(
                $taxonomy . '_ids',
                [
                    'label' => $object->label,
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'object_type' => $taxonomy,
                    'options' => wp_list_pluck(get_terms($taxonomy), 'name', 'term_id'),
                    'condition' => [
                        'post_types' => $object->object_type,
                    ],
                ]
            );
        }

        $this->add_control(
			'post_status',
			[
				'label' => esc_html__( 'Post Status', 'post-slider-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Post Status', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'publish',
				'multiple' => true,
				'options' => wb_ps_get_post_status(),
			]
		);

        $this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Limit', 'post-slider-for-elementor' ),
				'placeholder' => esc_html__( 'Default is 10', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -1,
				'default' => 10,
			]
		);

		/*$this->add_control(
			'include_posts',
			[
				'label' => esc_html__( 'Include Posts:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'exclude_posts',
			[
				'label' => esc_html__( 'Exclude Posts:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'ignore_sticky_posts',
			[
				'label' => esc_html__( 'Ignore Sticky Posts:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);*/

		$this->add_control(
			'more_feature_one',
			[
				'label' => __( '<strong>Need More Options:</strong>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'separator'	=> 'before',
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item_configuration',
			[
				'label' => esc_html( 'Item Configurtion', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'template_style',
			[
				'label' => esc_html__( 'Template Style', 'post-slider-for-elementor' ),
				'placeholder' => esc_html__( 'Choose Template from Here', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => 'default',
				'options' => [
					'default'  => esc_html__( 'Default', 'post-slider-for-elementor' ),
					// 'template-2'  => esc_html__( 'Template 2', 'post-slider-for-elementor' ),
				],
				'description' => __('There is <strong><a href="'.WB_PS_PRO_LINK.'" target="_blank" >Another Template</a></strong> on the <a href="'.WB_PS_PRO_LINK.'" target="_blank" >Pro</a> Version. We have developed more templates continiously. <a style="font-size: 12px; padding: 0 10px" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>'),
			]
		);

		$this->add_control(
			'display_image',
			[
				'label' => esc_html__( 'Show Image', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'post-slider-for-elementor' ),
				'label_off' => esc_html__( 'No', 'post-slider-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_size',
				'default' => 'medium',
				'condition' => [
					'display_image'	=>	'yes',
				]
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More:', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Read More', 'post-slider-for-elementor'),
				// 'label_block' => true,
				'description'	=>	'Change Read More Text from Here',
			]
		);

		/*$this->add_control(
			'display_title',
			[
				'label' => esc_html__( 'Display Title:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Show/Hide Post Title</strong>',
			]
		);

		$this->add_control(
			'display_content',
			[
				'label' => esc_html__( 'Display Content:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Show/Hide Post Content</strong>',
			]
		);

		$this->add_control(
			'display_read_more',
			[
				'label' => esc_html__( 'Display Read More:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Show/Hide Read More Button</strong>',
			]
		);

		$this->add_control(
			'item_spacing',
			[
				'label' => esc_html__( 'Item Spacing:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Manage Spacing Between Items</strong>',
			]
		);*/

		$this->add_control(
			'more_feature_two',
			[
				'label' => __( '<strong>Need More Options:</strong>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_configuration',
			[
				'label' => esc_html( 'Slider Configurtion', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slide_to_show',
			[
				'label' => __( 'Slides to Show', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		$this->add_control(
			'slides_to_scroll',
			[
				'label' => __( 'Slides to Scroll', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		/*$this->add_control(
			'display_nav_arrows',
			[
				'label' => esc_html__( 'Display Navigation:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Show/Hide Navigation Arrows</strong>',
			]
		);

		$this->add_control(
			'display_dots',
			[
				'label' => esc_html__( 'Display Dots:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Show/Hide Dots</strong>',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'AutoPlay:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Enable AutoPlay to Move Slider Automatically</strong>',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'AutoPlay Speed:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Choose after how many seconds of Page Load the AutoPlay will start after If AutoPlay is enable</strong>',
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__( 'Pause On Hover:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Pause the Slider on Mouse Hover if AutoPlay is Enable</strong>',
			]
		);

		$this->add_control(
			'pause_on_dots_hover',
			[
				'label' => esc_html__( 'Pause On Dots Hover:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Pause the Slider on Mouse Hover on Dots if AutoPlay is Enable</strong>',
			]
		);

		$this->add_control(
			'slide_speed',
			[
				'label' => esc_html__( 'Slide Speed:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Change Slider Speed Here</strong>',
			]
		);

		$this->add_control(
			'rows_to_show',
			[
				'label' => __( 'Rows', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description' => __('<strong>Use this field for displaying Multiple Rows</strong>', 'plugin-domain'),
				// 'separator'	=>	'before'
			]
		);

		$this->add_control(
			'rows_per_group',
			[
				'label' => __( 'Slides Per Row', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description' => __('<strong>Choose how many Sliders you want to display on each row</strong>', 'plugin-domain'),
				// 'separator'	=>	'before'
			]
		);*/

		$this->add_control(
			'more_feature_three',
			[
				'label' => __( '<strong>Need More Options:</strong>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->end_controls_section();

		/*$this->start_controls_section(
			'responsive_control',
			[
				'label' => esc_html( 'Responsive Configurtion', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();  //Start Responsive Slider Control Section

		$repeater->add_control(
			'slide_to_show', [
				'label' => __( 'Slides to Show', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				// 'description'	=>	'<strong>Pause the Slider on Mouse Hover on Dots if AutoPlay is Enable</strong>',
			]
		);

		$repeater->add_control(
			'slides_to_scroll', [
				'label' => __( 'Slides to Scroll', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'rows_to_show', [
				'label' => __( 'Rows', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'rows_per_group', [
				'label' => __( 'Slides Per Row', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'breakpoint_size', [
				'label' => __( 'Breakpoint Width', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 768 , 'plugin-domain' ),
				'label_block' => false,
				'separator'=> 'before',
			]
		);

		$this->add_control(
			'slider_responsive_control',
			[
				'label' => __( 'Responsive Breakpoints', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'separator' => 'before',
				'default' => [
					[
						'slide_to_show' => __( 2, 'plugin-domain' ),
						'slides_to_scroll' => __( 2, 'plugin-domain' ),
						'breakpoint_size' => __( 768, 'plugin-domain' ),
					],
					[
						'slide_to_show' => __( 1, 'plugin-domain' ),
						'slides_to_scroll' => __( 1, 'plugin-domain' ),
						'breakpoint_size' => __( 480, 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ breakpoint_size }}}',
				'prevent_empty'=>false,
			]
		); // End Reponsive Carousel Control Section

		$this->end_controls_section();*/

		/*$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html( 'Customize Style', 'news-ticker-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'more_feature_four',
			[
				'label' => __( 'You can <a style=" font-size: 12px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >customize the slider styles</a> thoroughly with the <a style=" font-size: 12px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Pro Version</a>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'label_block' => true,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);


		$this->end_controls_section();*/

		//Start Style Section
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html( 'Title Style', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'title_link_tabs'
		);

		$this->start_controls_tab(
			'title_link_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wb_ps_title a' => 'color: {{VALUE}}',
				],
				'separator'	=>	'after'
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_link_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Hover Color', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wb_ps_title a:hover' => 'color: {{VALUE}}',
				],
				'separator'	=>	'after'
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		/* $this->add_control(
			'title_typography',
			[
				'label' => esc_html__( 'Typography:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Change Font family, Font Size, Line Height etc.</strong>',
			]
		);

		$this->add_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				//'description'	=>	'<strong>Change Font family, Font Size, Line Height etc.</strong>',
			]
		);

		$this->add_control(
			'title_text_align',
			[
				'label' => esc_html__( 'Text Align:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				//'description'	=>	'<strong>Change Font family, Font Size, Line Height etc.</strong>',
			]
		);	*/

		$this->add_control(
			'more_feature_four',
			[
				'label' => __( '<strong>Need More Options:</strong>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html( 'Content Style', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wb_ps_description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .wb_ps_content',
				'description' =>	'<strong><a href="'.WB_PS_PRO_LINK.'" target="_blank" >Upgrade to PRO</a> for using </strong>Linear Gradient',
			]
		);

		/*$this->add_control(
			'content_typography',
			[
				'label' => esc_html__( 'Typography:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Change Font family, Font Size, Line Height etc.</strong>',
			]
		);

		$this->add_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				//'description'	=>	'<strong>Change Font family, Font Size, Line Height etc.</strong>',
			]
		);

		$this->add_control(
			'content_text_align',
			[
				'label' => esc_html__( 'Text Align', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);	*/

		$this->add_control(
			'more_feature_five',
			[
				'label' => __( '<strong>Need More Options:</strong>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'read_more_style_section',
			[
				'label' => esc_html( 'Read More Style', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'read_more_style_tabs'
		);

		$this->start_controls_tab(
			'read_more_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' => __( 'Color', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wb_ps_readmore_link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'read_more_border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .wb_ps_readmore_link',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'read_more_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .wb_ps_readmore_link',
			]
		);

		/*$this->add_control(
			'read_more_text_align',
			[
				'label' => esc_html__( 'Button Align', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);	

		$this->add_control(
			'read_more_typography',
			[
				'label' => esc_html__( 'Typography:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Change Font family, Font Size, Line Height etc.</strong>',
			]
		);

		$this->add_control(
			'read_more_padding',
			[
				'label' => __( 'Padding', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);*/

		$this->end_controls_tab();

		$this->start_controls_tab(
			'read_more_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);

		$this->add_control(
			'read_more_hover_color',
			[
				'label' => __( 'Color', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wb_ps_readmore_link:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'read_more_hover_border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .wb_ps_readmore_link:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'read_more_hover_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .wb_ps_readmore_link:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'more_feature_six',
			[
				'label' => __( '<strong>Need More Options:</strong>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);


		$this->end_controls_section();


		// Arrow Style
		$this->start_controls_section(
			'nav_arrow_style_section',
			[
				'label' => esc_html( 'Navigation Arrow Style', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs(
			'nav_arrow_style_tabs'
		);

		$this->start_controls_tab(
			'nav_arrow_normal_tab',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);

		$this->add_control(
			'nav_arrow_color',
			[
				'label' => __( 'Color', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wbel-arrow' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nav_arrow_border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .wbel-arrow',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'nav_arrow_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .wbel-arrow',
			]
		);

		/*$this->add_control(
			'nav_arrow_left_icon',
			[
				'label' => __( 'Left Icon', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'nav_arrow_right_icon',
			[
				'label' => __( 'Right Icon', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'nav_arrow_width',
			[
				'label' => __( 'Width', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'nav_arrow_height',
			[
				'label' => __( 'Height', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'nav_arrow_typography',
			[
				'label' => esc_html__( 'Typography:', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
				'description'	=>	'<strong>Change Font family, Font Size, Line Height etc.</strong>',
			]
		);*/


		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_arrow_hover_tab',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);

		$this->add_control(
			'nav_arrow_hover_color',
			[
				'label' => __( 'Color', 'post-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wbel-arrow:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nav_arrow_border_hover',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .wbel-arrow:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'nav_arrow_hover_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .wbel-arrow:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'more_feature_seven',
			[
				'label' => __( '<strong>Need More Options:</strong>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'others_style_section',
			[
				'label' => esc_html( 'Others Style', 'post-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'full_content_box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .wb_ps_single_item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => __( 'Image Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .wb_ps_thumbnail img',
			]
		);

		$this->add_control(
			'more_feature_eight',
			[
				'label' => __( '<strong>Need More Options:</strong>', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'label_block' => false,
				'button_type' => 'danger',
				'text' => __( '<a style="color: #fff; font-size: 12px; padding: 0 10px; height: 100%; display: block; line-height: 28px;" href="'.WB_PS_PRO_LINK.'" target="_blank" >Buy Pro</a>', 'plugin-domain' ),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$element_id = 'wb_post_slider'.$this->get_id();

		$template_style = $settings['template_style'];
		$slide_to_show = isset($settings['slide_to_show']) && $settings['slide_to_show'] ? $settings['slide_to_show'] : 3;
		$slides_to_scroll = isset($settings['slides_to_scroll']) && $settings['slides_to_scroll'] ? $settings['slides_to_scroll'] : 3;
		$read_more_text = isset($settings['read_more_text']) && $settings['read_more_text'] ? $settings['read_more_text'] : '';


		$args = array();

		$args['post_type'] = $settings['post_types'];
		$args['post_status'] = 'publish';
		if( $settings['post_status'] && is_array($settings['post_status']) ){
			$args['post_status'] = $settings['post_status'];
		}

		if( isset($settings['posts_per_page']) && intval($settings['posts_per_page']) > 0 ){
			$args['posts_per_page'] = $settings['posts_per_page'];
		}

		if( isset($settings['posts_per_page']) && intval($settings['posts_per_page']) == -1 ){
			$args['posts_per_page'] = $settings['posts_per_page'];
		}

	        if( $args['post_type'] && $args['post_type'] != 'none' ){
	        if( $args['post_type'] !== 'page' ) {
	            $args['tax_query'] = [];
	            $taxonomies = get_object_taxonomies($settings['post_types'], 'objects');

	            foreach ($taxonomies as $object) {
	                $setting_key = $object->name . '_ids';

	                if (!empty($settings[$setting_key])) {
	                    $args['tax_query'][] = [
	                        'taxonomy' => $object->name,
	                        'field' => 'term_id',
	                        'terms' => $settings[$setting_key],
	                    ];
	                }
	            }

	            if (!empty($args['tax_query'])) {
	                $args['tax_query']['relation'] = 'AND';
	            }
	        }

	        echo '<div
	        		class="wbel_post_slider_wrapper wbel_post_slider_'.$template_style.'"
	        		id="wbel_post_slider_'.esc_attr($element_id).'"
	        		data-slide-to-show="'.$slide_to_show.'"
	        		data-slides-to-scroll="'.$slides_to_scroll.'"
	        	>';
	        $post_query = new \WP_Query($args);
	        if( $post_query->have_posts() ){
	        	$count=0;
				while( $post_query->have_posts() ){
					$post_query->the_post();
					$count++;
					$thumbnail_id = get_post_thumbnail_id();
					require( WB_PS_PATH . 'templates/style-1/template.php' );
				}
				wp_reset_postdata();
			}
			echo "</div>";

			?>
				<div class="wbel-arrow wb-arrow-prev">
					<i class="fa fa-angle-left"></i>
				</div>
				<div class="wbel-arrow wb-arrow-next">
					<i class="fa fa-angle-right"></i>
				</div>
			<?php

		}


	}


}
