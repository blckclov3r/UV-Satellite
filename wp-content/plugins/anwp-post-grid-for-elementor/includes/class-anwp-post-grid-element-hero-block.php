<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

/**
 * AnWP Post Grid Elements :: Hero Block
 *
 * @since   0.6.1
 * @package AnWP_Post_Grid
 */

class AnWP_Post_Grid_Element_Hero_Block extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 * @since  0.1.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'anwp-pg-hero-block';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 * @since  0.1.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Hero Block', 'anwp-post-grid' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since  0.1.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'anwp-pg-element anwp-pg-hero-block__admin-icon';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'grid', 'posts', 'post', 'post grid', 'posts grid', 'blog post', 'blog posts', 'masonry', 'anwp' ];
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'anwp-pg' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since  0.1.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_anwp_grid_options',
			[
				'label' => __( 'Query', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_to_show',
			[
				'label'       => __( 'Posts to Show', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'latest',
				'options'     => anwp_post_grid()->elements->get_posts_to_show_options(),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		if ( anwp_post_grid()->elements->published_posts > anwp_post_grid()->elements->published_posts_limit ) {
			$this->add_control(
				'include_ids',
				[
					'label'       => __( 'Selected Posts', 'anwp-post-grid' ),
					'description' => __( 'Post IDs, separated by commas', 'anwp-post-grid' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => '',
					'condition'   => [
						'posts_to_show' => 'custom',
					],
				]
			);
		} else {
			$this->add_control(
				'include_ids',
				[
					'label'       => __( 'Selected Posts', 'anwp-post-grid' ),
					'type'        => Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => true,
					'default'     => [],
					'options'     => anwp_post_grid()->elements->get_posts_all_options(),
					'condition'   => [
						'posts_to_show' => 'custom',
					],
				]
			);
		}

		$this->add_control(
			'filter_by_category',
			[
				'label'       => __( 'Filter by Category', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => [],
				'options'     => anwp_post_grid()->elements->get_category_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'filter_by_tag',
			[
				'label'       => __( 'Filter by Tag', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => [],
				'options'     => anwp_post_grid()->elements->get_tag_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'filter_by_post_format',
			[
				'label'       => __( 'Filter by Post Format', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT,
				'multiple'    => true,
				'label_block' => true,
				'default'     => 'all',
				'options'     => anwp_post_grid()->elements->get_post_format_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'filter_by_author',
			[
				'label'       => __( 'Filter by Author', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => '',
				'options'     => anwp_post_grid()->elements->get_author_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'hr2',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'hr3',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		if ( anwp_post_grid()->elements->published_posts > anwp_post_grid()->elements->published_posts_limit ) {
			$this->add_control(
				'exclude_ids',
				[
					'label'       => __( 'Exclude Posts', 'anwp-post-grid' ),
					'description' => __( 'Post IDs, separated by commas', 'anwp-post-grid' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => '',
					'condition'   => [
						'posts_to_show!' => 'custom',
					],
				]
			);
		} else {
			$this->add_control(
				'exclude_ids',
				[
					'label'       => __( 'Exclude Posts', 'anwp-post-grid' ),
					'type'        => Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => true,
					'default'     => [],
					'options'     => anwp_post_grid()->elements->get_posts_all_options(),
					'condition'   => [
						'posts_to_show!' => 'custom',
					],
				]
			);
		}

		$this->add_control(
			'exclude_by_category',
			[
				'label'       => __( 'Exclude by Category', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => [],
				'options'     => anwp_post_grid()->elements->get_category_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'hr4',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Posts Offset', 'anwp-post-grid' ),
				'description' => __( 'number of post to pass over', 'anwp-post-grid' ),
				'label_block' => false,
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'step'        => 1,
				'default'     => 0,
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'hr5',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'published_in_last_days',
			[
				'label'       => __( 'Published in Last days', 'anwp-post-grid' ),
				'label_block' => false,
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'default'     => 0,
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------
		| Post Icons
		|--------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'section_anwp_grid_post_icon_layout',
			[
				'label' => __( 'Post Icon', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_post_icon',
			[
				'label'        => __( 'Show Post Icon', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'post_icon_size',
			[
				'label'        => __( 'Icon Size', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'16' => __( '16 px', 'anwp-post-grid' ),
					'24' => __( '24 px', 'anwp-post-grid' ),
					'36' => __( '36 px', 'anwp-post-grid' ),
				],
				'default'      => '16',
				'prefix_class' => 'anwp-pg-post-teaser__post-icon--size-',
			]
		);

		$this->add_control(
			'post_icon_position',
			[
				'label'        => __( 'Icon Position', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					''             => __( 'top right', 'anwp-post-grid' ),
					'center'       => __( 'center', 'anwp-post-grid' ),
					'bottom-right' => __( 'bottom right', 'anwp-post-grid' ),
				],
				'default'      => '',
				'prefix_class' => 'anwp-pg-post-teaser__post-icon--position-',
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------
		| Styles and Layout Section
		|--------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'section_anwp_grid_style_layout',
			[
				'label' => __( 'Styles and Layout', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Post Card Style', 'anwp-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'a',
				'options' => [
					'a' => __( 'Style A', 'anwp-post-grid' ),
					'b' => __( 'Style B', 'anwp-post-grid' ),
					'c' => __( 'Style C', 'anwp-post-grid' ),
				],
			]
		);

		$this->add_control(
			'hr_style_1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'grid_gutter',
			[
				'label'   => __( 'Grid Gutter', 'anwp-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'thin',
				'options' => [
					'thin' => __( 'Thin', 'anwp-post-grid' ),
					'none' => __( 'None', 'anwp-post-grid' ),
				],
			]
		);

		$this->add_control(
			'hr_style_3',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'        => __( 'Show Category', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'category_limit',
			[
				'label'     => __( 'Category Limit', 'anwp-post-grid' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 7,
				'step'      => 1,
				'default'   => 1,
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_date',
			[
				'label'        => __( 'Show Post Date', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_comments',
			[
				'label'        => __( 'Show Comments & Views', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'hr_style_4',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'card_height',
			[
				'label'      => __( 'Post Card Height (px)', 'anwp-post-grid' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 150,
						'max'  => 500,
						'step' => 10,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 180,
				],
			]
		);

		$this->add_control(
			'hr_style_7',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'label'   => __( 'Image Size', 'anwp-post-grid' ),
				'name'    => 'grid_thumbnail',
				'exclude' => [ 'custom' ],
				'default' => 'medium',
			]
		);

		$this->add_control(
			'hr_style_8',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'category_background',
			[
				'label'     => __( 'Category Background Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-hero-block .anwp-pg-category__wrapper-filled' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'hr_style_6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_teaser_title',
				'label'    => __( 'Post Title Typography', 'anwp-post-grid' ),
				'selector' => '{{WRAPPER}} .anwp-pg-post-teaser__title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_teaser_meta',
				'label'    => __( 'Post Meta Typography', 'anwp-post-grid' ),
				'selector' => '{{WRAPPER}} .anwp-pg-post-teaser__meta-comments, {{WRAPPER}} .anwp-pg-post-teaser__category-wrapper, {{WRAPPER}} .anwp-pg-post-teaser__meta-views, {{WRAPPER}} .anwp-pg-post-teaser__bottom-meta',
			]
		);

		$this->add_control(
			'hr_style_26',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'grid_card_bg_effect',
			[
				'label'        => __( 'Card Hover Effect', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => '',
				'options'      => [
					''            => __( 'Darken & Scale (default)', 'anwp-post-grid' ),
					'darken_only' => __( 'Darken', 'anwp-post-grid' ),
				],
				'prefix_class' => 'anwp-grid_card_bg_effect-',
			]
		);

		$this->end_controls_section();

		/**
		 * Before end of controls.
		 *
		 * @param AnWP_Post_Grid_Element_Hero_Block $this The element.
		 *
		 * @since 0.7.0
		 */
		do_action( 'anwp-pg-el/element-hero-block/before_controls_end', $this );

		/**
		 * Before end of controls.
		 *
		 * @param Widget_Base $this The element.
		 *
		 * @since 0.7.0
		 */
		do_action( 'anwp-pg-el/element/before_controls_end', $this );
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since  0.1.0
	 * @access protected
	 */
	protected function render() {

		/*
		|--------------------------------------------------------------------
		| Merge arguments into defaults array
		|--------------------------------------------------------------------
		*/
		$data = (object) wp_parse_args(
			$this->get_settings_for_display(),
			[
				'posts_to_show' => 'latest',
				'limit'         => 5,
			]
		);

		/*
		|--------------------------------------------------------------------
		| Get Posts
		|--------------------------------------------------------------------
		*/
		$data->grid_posts = anwp_post_grid()->elements->get_grid_posts( $data );

		if ( count( $data->grid_posts ) < $data->limit ) {
			return;
		}

		/*
		|--------------------------------------------------------------------
		| Render
		|--------------------------------------------------------------------
		*/
		anwp_post_grid()->load_partial( $data, 'hero-block' );
	}
}

