<?php

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor Items (Elements)
 *
 * @since   0.1.0
 * @package AnWP_Post_Grid
 */

class AnWP_Post_Grid_Elements {

	/**
	 * Parent plugin class.
	 *
	 * @var AnWP_Post_Grid
	 * @since  0.1.0
	 */
	protected $plugin = null;

	/**
	 * Parent plugin class.
	 *
	 * @since  0.5.1
	 */
	public $published_posts = 0;

	/**
	 * Parent plugin class.
	 *
	 * @since  0.5.1
	 */
	public $published_posts_limit = 150;

	/**
	 * Constructor.
	 *
	 * @param AnWP_Post_Grid $plugin Main plugin object.
	 *
	 * @since  0.1.0
	 *
	 */
	public function __construct( $plugin ) {

		$this->plugin = $plugin;

		// Get number of published posts
		$counted_posts = wp_count_posts();

		if ( ! empty( $counted_posts->publish ) ) {
			$this->published_posts = $counted_posts->publish;
		}

		// Init Hooks
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since 0.1.0
	 */
	public function hooks() {

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_filter( 'elementor/editor/localize_settings', [ $this, 'promote_premium_widgets' ] );

		add_action( 'wp_ajax_nopriv_anwp_pg_load_more_posts', [ $this, 'ajax_load_more' ] );
		add_action( 'wp_ajax_anwp_pg_load_more_posts', [ $this, 'ajax_load_more' ] );

		add_action( 'wp_ajax_nopriv_anwp_pg_ajax_pagination_load', [ $this, 'ajax_pagination_load' ] );
		add_action( 'wp_ajax_anwp_pg_ajax_pagination_load', [ $this, 'ajax_pagination_load' ] );

		// Add premium prove at the end of all pages
		add_action( 'anwp-pg-el/element/before_controls_end', [ $this, 'load_promo_tab' ] );
	}

	/**
	 * Load promo tab
	 *
	 * @param Widget_Base $element
	 *
	 * @since 0.1.0
	 */
	public function load_promo_tab( $element ) {

		if ( AnWP_Post_Grid::is_premium_active() ) {
			return;
		}

		$element->start_controls_section(
			'section_anwp_pro_promo_tab',
			[
				'label' => __( 'Premium Features', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$element->add_control(
			'pro_tab_promo',
			[
				'type' => 'raw_html',
				'raw'  => $this->get_pro_tab_template(),
			]
		);

		$element->end_controls_section();
	}

	public function get_pro_tab_template() {
		ob_start();
		?>
		<div class="elementor-nerd-box">
			<div class="elementor-nerd-box-title" style="margin-top: 0 !important;">Premium Features</div>
			<ul style="margin-top: 15px;">
				<li>News Ticker Widget</li>
				<li>Hero Slider</li>
				<li>Mosaic Slider</li>
				<li>Card Slider</li>
				<li>Advanced Pagination</li>
				<li>Taxonomy Redirects</li>
				<li>Header Category Filter</li>
				<li>Widget Blocks</li>
			</ul>
			<a class="elementor-nerd-box-link elementor-button elementor-button-default elementor-button-go-pro" href="https://grid.anwp.pro/premium-demo/" target="_blank">
				<?php echo esc_html__( 'Premium Demo', 'anwp-post-grid' ); ?>
			</a>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Promote Premium Widgets
	 *
	 * @param array $config
	 *
	 * @return array
	 * @since 0.6.2
	 */
	public function promote_premium_widgets( $config ) {

		if ( AnWP_Post_Grid::is_premium_active() ) {
			return $config;
		}

		if ( ! isset( $config['promotionWidgets'] ) || ! is_array( $config['promotionWidgets'] ) ) {
			$config['promotionWidgets'] = [];
		}

		$premium_widgets = [
			[
				'name'       => 'anwp-pg-pro-news-ticker',
				'title'      => __( 'News Ticker', 'anwp-post-grid' ) . ' [anwp]',
				'icon'       => 'anwp-pg-pro-promotion-icon anwp-pg-pro-news-ticker__admin-icon',
				'categories' => '[ "anwp-pg", "anwp" ]',
			],
			[
				'name'       => 'anwp-pg-pro-hero-slider',
				'title'      => __( 'Hero Slider', 'anwp-post-grid' ) . ' [anwp]',
				'icon'       => 'anwp-pg-pro-promotion-icon anwp-pg-simple-slider__admin-icon',
				'categories' => '[ "anwp-pg", "anwp" ]',
			],
			[
				'name'       => 'anwp-pg-pro-mosaic-slider',
				'title'      => __( 'Mosaic Slider', 'anwp-post-grid' ) . ' [anwp]',
				'icon'       => 'anwp-pg-pro-promotion-icon anwp-pg-simple-slider__admin-icon',
				'categories' => '[ "anwp-pg", "anwp" ]',
			],
			[
				'name'       => 'anwp-pg-pro-card-slider',
				'title'      => __( 'Card Slider', 'anwp-post-grid' ) . ' [anwp]',
				'icon'       => 'anwp-pg-pro-promotion-icon anwp-pg-simple-slider__admin-icon',
				'categories' => '[ "anwp-pg", "anwp" ]',
			],
		];

		$config['promotionWidgets'] = array_merge( $config['promotionWidgets'], $premium_widgets );

		return $config;
	}

	/**
	 * Init Widgets
	 * Include widgets files and register them
	 *
	 * @throws Exception
	 * @since 0.1.0
	 */
	public function init_widgets() {

		/*
		|--------------------------------------------------------------------
		| > Simple Grid
		| @since 0.1.0
		|--------------------------------------------------------------------
		*/
		Plugin::instance()->widgets_manager->register_widget_type( new AnWP_Post_Grid_Element_Simple_Grid() );

		/*
		|--------------------------------------------------------------------
		| > Light Grid
		| @since 0.1.0
		|--------------------------------------------------------------------
		*/
		Plugin::instance()->widgets_manager->register_widget_type( new AnWP_Post_Grid_Element_Light_Grid() );

		/*
		|--------------------------------------------------------------------
		| > Classic Grid
		| @since 0.1.0
		|--------------------------------------------------------------------
		*/
		Plugin::instance()->widgets_manager->register_widget_type( new AnWP_Post_Grid_Element_Classic_Grid() );

		/*
		|--------------------------------------------------------------------
		| > Simple Slider
		| @since 0.6.0
		|--------------------------------------------------------------------
		*/
		Plugin::instance()->widgets_manager->register_widget_type( new AnWP_Post_Grid_Element_Simple_Slider() );

		/*
		|--------------------------------------------------------------------
		| > Classic Slider
		| @since 0.6.0
		|--------------------------------------------------------------------
		*/
		Plugin::instance()->widgets_manager->register_widget_type( new AnWP_Post_Grid_Element_Classic_Slider() );

		/*
		|--------------------------------------------------------------------
		| > Hero Block
		| @since 0.6.1
		|--------------------------------------------------------------------
		*/
		Plugin::instance()->widgets_manager->register_widget_type( new AnWP_Post_Grid_Element_Hero_Block() );

		/*
		|--------------------------------------------------------------------
		| > Classic Blog
		| @since 0.6.2
		|--------------------------------------------------------------------
		*/
		Plugin::instance()->widgets_manager->register_widget_type( new AnWP_Post_Grid_Element_Classic_Blog() );
	}

	/**
	 * Get All available posts show options.
	 *
	 * @return array
	 * @since 0.1.0
	 */
	public function get_posts_to_show_options() {

		$options = [
			'latest'        => __( 'Latest', 'anwp-post-grid' ),
			'oldest'        => __( 'Oldest', 'anwp-post-grid' ),
			'comment_count' => __( 'Most commented', 'anwp-post-grid' ),
			'custom'        => __( 'Custom', 'anwp-post-grid' ),
		];

		if ( AnWP_Post_Grid::is_pvc_active() ) {
			$options['post_views'] = esc_html__( 'Most viewed', 'anwp-post-grid' );
		}

		return $options;
	}

	/**
	 * Get Post Categories
	 *
	 * @return array|null
	 * @since 0.1.0
	 */
	public function get_category_options() {

		static $options = null;

		if ( null === $options ) {
			$options = get_categories(
				[
					'hide_empty' => false,
					'fields'     => 'id=>name',
				]
			);
		}

		return $options;
	}

	/**
	 * Get Post Tags
	 *
	 * @return array|null
	 * @since 0.1.0
	 */
	public function get_tag_options() {

		static $options = null;

		if ( null === $options ) {
			$options = get_tags(
				[
					'hide_empty' => false,
					'fields'     => 'id=>name',
				]
			);
		}

		return $options;
	}

	/**
	 * Get Post Formats
	 *
	 * @return array|null
	 * @since 0.1.0
	 */
	public function get_post_format_options() {

		static $options = null;

		if ( null === $options ) {

			$options = $this->get_post_format_term();

			if ( ! empty( $options ) ) {
				$options = array_map(
					function ( $el ) {
						return ltrim( $el, 'post-format-' );
					},
					$options
				);

				$options = array_combine( $options, $options );
				$options = array_map( 'ucfirst', $options );
			}

			$options = array_merge(
				[
					'all'      => __( 'All Formats', 'anwp-post-grid' ),
					'standard' => __( 'Standard', 'anwp-post-grid' ),
				],
				$options
			);
		}

		return $options;
	}

	/**
	 * Get Post Formats Term
	 *
	 * @return array|null
	 * @since 0.1.0
	 */
	public function get_post_format_term() {

		static $options = null;

		if ( null === $options ) {

			$options = get_terms(
				[
					'taxonomy'   => 'post_format',
					'hide_empty' => false,
					'fields'     => 'slugs',
				]
			);

			if ( empty( $options ) || is_wp_error( $options ) ) {
				$options = [];
			}
		}

		return $options;
	}

	/**
	 * Get Post Authors
	 *
	 * @return array|null
	 * @since 0.1.0
	 */
	public function get_author_options() {

		static $options = null;

		if ( null === $options ) {
			$post_authors = get_users(
				[
					'has_published_posts' => true,
					'who'                 => 'authors',
					'fields'              => [ 'ID', 'display_name' ],
				]
			);

			foreach ( $post_authors as $post_author ) {
				$options[ $post_author->ID ] = $post_author->display_name;
			}
		}

		return $options;
	}

	/**
	 * Get All Posts
	 *
	 * @return array|null
	 * @since 0.1.0
	 */
	public function get_posts_all_options() {

		static $options = null;

		if ( null === $options ) {

			global $wpdb;

			// Get all raw logos
			$all_posts = $wpdb->get_results(
				$wpdb->prepare(
					"
					SELECT ID, post_title
					FROM $wpdb->posts
					WHERE post_status = 'publish' AND post_type = 'post'
					ORDER BY post_date DESC
					LIMIT %d
					",
					$this->published_posts_limit
				)
			);

			/** @var WP_Post $all_post */
			foreach ( $all_posts as $all_post ) {
				$options[ $all_post->ID ] = $all_post->post_title;
			}
		}

		return $options;
	}

	/**
	 * Get grid posts.
	 *
	 * @param $options
	 * @param $output
	 *
	 * @return array
	 */
	public function get_grid_posts( $options, $output = '' ) {

		/*
		|--------------------------------------------------------------------
		| Merge options into defaults array.
		|--------------------------------------------------------------------
		*/
		$options = (object) wp_parse_args(
			$options,
			[
				'posts_to_show'          => 'latest',
				'include_ids'            => '',
				'exclude_ids'            => '',
				'exclude_by_category'    => '',
				'filter_by_category'     => '',
				'filter_by_tag'          => '',
				'filter_by_post_format'  => '',
				'filter_by_author'       => '',
				'published_in_last_days' => 0,
				'limit'                  => 3,
				'offset'                 => 0,
			]
		);

		/*
		|--------------------------------------------------------------------
		| Init query args
		|--------------------------------------------------------------------
		*/
		$args = [
			'ignore_sticky_posts' => true,
			'suppress_filters'    => false,
		];

		if ( 'custom' === $options->posts_to_show ) {

			$args['include'] = $options->include_ids;

		} else {

			// Limit
			$args['numberposts'] = 'ids' === $output ? - 1 : intval( $options->limit );

			// OrderBy
			if ( 'post_views' === $options->posts_to_show && ! AnWP_Post_Grid::is_pvc_active() ) {
				$options->posts_to_show = '';
			}

			if ( ! empty( $options->posts_to_show ) ) {

				switch ( $options->posts_to_show ) {
					case 'comment_count':
					case 'post_views':
						$args['orderby'] = $options->posts_to_show;
						break;

					case 'oldest':
						$args['order'] = 'ASC';
						break;
				}
			}

			// Category
			if ( ! empty( $options->filter_by_category ) ) {
				$args['category__in'] = wp_parse_id_list( $options->filter_by_category );
			}

			// Tag
			if ( ! empty( $options->filter_by_tag ) ) {
				$args['tag__in'] = wp_parse_id_list( $options->filter_by_tag );
			}

			// Post Formats
			if ( $options->filter_by_post_format && 'standard' !== $options->filter_by_post_format && 'all' !== $options->filter_by_post_format ) {
				$args['tax_query'] = [
					[
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => 'post-format-' . sanitize_key( $options->filter_by_post_format ),
					],
				];
			} elseif ( 'standard' === $options->filter_by_post_format && ! empty( $this->get_post_format_term() ) ) {
				$args['tax_query'] = [
					[
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => $this->get_post_format_term(),
						'operator' => 'NOT IN',
					],
				];
			}

			// filter_by_author
			if ( ! empty( $options->filter_by_author ) ) {
				$args['author__in'] = wp_parse_id_list( $options->filter_by_author );
			}

			// exclude_ids
			if ( ! empty( $options->exclude_ids ) ) {
				$args['exclude'] = $options->exclude_ids;
			}

			// exclude_by_category
			if ( ! empty( $options->exclude_by_category ) ) {
				$args['category__not_in'] = wp_parse_id_list( $options->exclude_by_category );
			}

			// offset
			if ( absint( $options->offset ) ) {
				$args['offset'] = absint( $options->offset );
			}

			// published_in_last_days
			if ( $options->published_in_last_days > 0 && in_array( $options->posts_to_show, [ 'comment_count', 'post_views', 'oldest' ], true ) ) {
				$args['date_query'] = [ 'after' => absint( $options->published_in_last_days ) . ' days ago' ];
			}
		}

		if ( 'ids' === $output ) {
			$args['fields'] = 'ids';
		}

		return get_posts( $args );
	}

	/**
	 * Return an image URI.
	 *
	 * @param string   $size The image size you want to return.
	 * @param bool     $allow_placeholder
	 * @param int|null $pre_post_id
	 *
	 * @return string         The image URI.
	 * @since 0.1.0
	 */
	public function get_post_image_uri( $size = 'full', $allow_placeholder = true, $pre_post_id = null ) {

		$media_url = '';

		$post_id = $pre_post_id ? $pre_post_id : get_the_ID();

		// If featured image is present, use that.
		if ( has_post_thumbnail( $post_id ) ) {

			$featured_image_id = get_post_thumbnail_id( $post_id );
			$media_url         = wp_get_attachment_image_url( $featured_image_id, sanitize_key( $size ) );

			if ( $media_url ) {
				return $media_url;
			}
		}

		/*
		|--------------------------------------------------------------------
		| Video Post Format
		|--------------------------------------------------------------------
		*/
		// Get image for video post format
		if ( 'video' === get_post_format( $post_id ) ) {

			$video_data = array(
				'source' => get_post_meta( $post_id, '_anwp_extras_video_source', true ), // site, youtube or vimeo
				'url'    => get_post_meta( $post_id, '_anwp_extras_video_id', true ),
			);

			// Check youtube id
			if ( 'youtube' === $video_data['source'] || empty( $video_data['source'] ) ) {

				// Try to get video ID
				$video_id = $this->get_youtube_id( $video_data['url'] );

				if ( $video_id ) {
					return esc_url( sprintf( 'http://img.youtube.com/vi/%s/maxresdefault.jpg', $video_id ) );
				}
			}
		}

		/*
		|--------------------------------------------------------------------
		| Gallery Post Format
		|--------------------------------------------------------------------
		*/
		// Get image for gallery post type
		if ( 'gallery' === get_post_format( $post_id ) ) {

			$gallery_images = get_post_meta( $post_id, '_anwp_extras_gallery_images', true );

			if ( ! empty( $gallery_images ) && is_array( $gallery_images ) ) {

				reset( $gallery_images );
				$gallery_image_id = key( $gallery_images );

				$media_url = wp_get_attachment_image_url( $gallery_image_id, sanitize_key( $size ) );

				if ( $media_url ) {
					return $media_url;
				}
			}
		}

		if ( 'post' === get_post_type( $post_id ) && 'video' !== get_post_format( $post_id ) ) {
			// Check for any attached image.
			$media = get_attached_media( 'image', $post_id );

			// If an image is present, then use it.
			if ( is_array( $media ) && 0 < count( $media ) ) {
				$media     = current( $media );
				$media_url = wp_get_attachment_image_url( $media->ID, sanitize_key( $size ) );
			}
		}

		// Set up default image path.
		if ( empty( $media_url ) && $allow_placeholder ) {

			// Set default image
			$media_url = AnWP_Post_Grid::url( 'public/img/empty_image.jpg' );

			// Get default image from plugin options
			$attachment_id = AnWP_Post_Grid_Settings::get_value( 'default_featured_image' );

			if ( absint( $attachment_id ) ) {
				$default_featured_image_url = wp_get_attachment_image_url( $attachment_id, 'full' );

				if ( $default_featured_image_url ) {
					$media_url = $default_featured_image_url;
				}
			}
		}

		return $media_url;
	}

	/**
	 * Get Youtube ID from url
	 *
	 * @param $url
	 *
	 * @return string Youtube ID or empty string
	 */
	public function get_youtube_id( $url ) {

		if ( mb_strlen( $url ) <= 11 ) {
			return $url;
		}

		preg_match( "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches );

		return isset( $matches[1] ) ? $matches[1] : '';
	}

	/**
	 * Render category block/badge
	 *
	 * @param WP_Term $term_obj
	 * @param string  $class
	 */
	public function render_post_category_link_filled( $term_obj, $class = '' ) {

		$theme_slug = get_option( 'template' );

		// Try to get theme category color
		switch ( $theme_slug ) {
			case 'aneto':
				$category_color = get_metadata( 'term', $term_obj->term_id, '_anwp_extras_category_color', true );
				break;

			case 'colormag':
				if ( function_exists( 'colormag_category_color' ) ) {
					$category_color = colormag_category_color( $term_obj->term_id );
				}
				break;
		}

		if ( empty( $category_color ) && 'no' !== AnWP_Post_Grid_Settings::get_value( 'show_category_color' ) ) {
			$color          = get_term_meta( $term_obj->term_id, '_anwp_pg_category_color', true );
			$category_color = empty( $color ) ? '#1565C0' : "#{$color}";
		} else {
			$category_color = empty( $category_color ) ? '#1565C0' : $category_color;
		}

		echo '<div class="anwp-pg-category__wrapper-filled px-2 d-flex align-items-center ' . esc_attr( $class ) . '" style="background-color: ' . esc_attr( $category_color ) . '">';
		echo '<span>' . esc_html( $term_obj->name ) . '</span>';
		echo '</div>';
	}

	/**
	 * Render category block/badge
	 *
	 * @param WP_Term $term_obj
	 * @param string  $class
	 */
	public function render_post_category_link( $term_obj, $class = '' ) {

		$theme_slug = get_option( 'template' );

		// Try to get theme category color
		switch ( $theme_slug ) {
			case 'aneto':
				$category_color = get_metadata( 'term', $term_obj->term_id, '_anwp_extras_category_color', true );
				break;

			case 'colormag':
				if ( function_exists( 'colormag_category_color' ) ) {
					$category_color = colormag_category_color( $term_obj->term_id );
				}
				break;
		}

		if ( empty( $category_color ) && 'no' !== AnWP_Post_Grid_Settings::get_value( 'show_category_color' ) ) {
			$color          = get_term_meta( $term_obj->term_id, '_anwp_pg_category_color', true );
			$category_color = empty( $color ) ? '#1565C0' : "#{$color}";
		} else {
			$category_color = empty( $category_color ) ? '#1565C0' : $category_color;
		}

		$category_color = empty( $category_color ) ? '#1565C0' : $category_color;

		echo '<div class="anwp-pg-category__wrapper d-flex align-items-center ' . esc_attr( $class ) . '" style="color: ' . esc_attr( $category_color ) . '">';
		echo esc_html( $term_obj->name );
		echo '</div>';
	}

	/**
	 * Render post date
	 *
	 * @param int $post_id
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function get_post_date( $post_id ) {

		$time_string = '<time class="anwp-pg-published anwp-pg-updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="anwp-pg-published" datetime="%1$s">%2$s</time><time class="anwp-pg-updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C, $post_id ),
			get_the_date( '', $post_id ),
			get_the_modified_date( DATE_W3C, $post_id ),
			get_the_modified_date( '', $post_id )
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return '<span class="screen-reader-text">' . esc_html_x( 'Posted on', 'post date', 'anwp-post-grid' ) . '</span>' . $time_string;
	}

	/**
	 * Get teaser grid classes
	 *
	 * @param object $data
	 * @param int    $default_desktop
	 * @param int    $default_tablet
	 * @param int    $default_mobile
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function get_teaser_grid_classes( $data, $default_desktop = 3, $default_tablet = 2, $default_mobile = 1 ) {

		$data = (object) wp_parse_args(
			$data,
			[
				'grid_cols'        => $default_desktop,
				'grid_cols_tablet' => $default_tablet,
				'grid_cols_mobile' => $default_mobile,
			]
		);

		$classes = [];

		// Desktop
		$grid_cols = ( $data->grid_cols >= 1 && $data->grid_cols <= 4 ) ? absint( $data->grid_cols ) : absint( $default_desktop );
		$classes[] = 'anwp-col-lg-' . 12 / $grid_cols;

		// Tablet
		$grid_cols_tablet = ( $data->grid_cols_tablet >= 1 && $data->grid_cols_tablet <= 4 ) ? absint( $data->grid_cols_tablet ) : absint( $default_tablet );
		$classes[]        = 'anwp-col-sm-' . 12 / $grid_cols_tablet;

		// Mobile
		$grid_cols_mobile = ( $data->grid_cols_mobile >= 1 && $data->grid_cols_mobile <= 4 ) ? absint( $data->grid_cols_mobile ) : absint( $default_mobile );
		$classes[]        = 'anwp-col-' . 12 / $grid_cols_mobile;

		return implode( ' ', $classes );
	}

	/**
	 * Get "load more" data
	 *
	 * @param $data
	 * @param $template
	 *
	 * @return string
	 * @since 0.5.2
	 */
	public function get_serialized_load_more_data( $data, $template = '' ) {

		if ( isset( $data->grid_posts ) ) {
			unset( $data->grid_posts );
		}

		$default_data = [
			'posts_to_show'          => 'latest',
			'include_ids'            => '',
			'exclude_ids'            => '',
			'exclude_by_category'    => '',
			'filter_by_category'     => '',
			'filter_by_tag'          => '',
			'filter_by_post_format'  => '',
			'filter_by_author'       => '',
			'published_in_last_days' => 0,
			'limit'                  => 3,
			'offset'                 => 0,
			'grid_cols'              => 3,
			'grid_cols_tablet'       => 2,
			'grid_cols_mobile'       => 1,
			'grid_thumbnail_size'    => 'large',
			'show_category'          => 'yes',
			'category_limit'         => 1,
			'show_date'              => 'yes',
			'show_author'            => 'yes',
			'show_comments'          => 'yes',
			'card_height'            => '180',
			'show_excerpt'           => 'yes',
			'layout'                 => '',
			'show_read_more'         => '',
			'read_more_label'        => '',
			'read_more_class'        => '',
			'post_image_width'       => '1_3',
			'show_post_icon'         => 'yes',
		];

		$options = wp_parse_args( $data, $default_data );

		$output = array_intersect_key( $options, $default_data );

		// Replace null with empty string
		$output = array_map(
			function ( $e ) {
				return is_null( $e ) ? '' : $e;
			},
			$output
		);

		return wp_json_encode( $output );
	}

	/**
	 * Handle ajax request and provide posts to load.
	 *
	 * @since 0.5.2
	 */
	public function ajax_load_more() {

		// Activate referer check with hook (optional)
		if ( apply_filters( 'anwp-pg-el/config/check_public_nonce', false ) ) {
			check_ajax_referer( 'anwp-pg-public-nonce' );
		}

		$post_loaded = absint( $_POST['loaded'] );
		$post_qty    = absint( $_POST['qty'] );

		// Parse with default values
		$args = wp_parse_args(
			wp_unslash( $_POST['args'] ),
			[
				'layout'                 => '',
				'posts_to_show'          => 'latest',
				'include_ids'            => '',
				'exclude_ids'            => '',
				'exclude_by_category'    => '',
				'filter_by_category'     => '',
				'filter_by_tag'          => '',
				'filter_by_post_format'  => '',
				'filter_by_author'       => '',
				'published_in_last_days' => 0,
				'limit'                  => 3,
				'offset'                 => 0,
				'grid_cols'              => 3,
				'grid_cols_tablet'       => 2,
				'grid_cols_mobile'       => 1,
				'category_limit'         => 1,
				'grid_thumbnail_size'    => 'large',
				'show_category'          => 'yes',
				'show_date'              => 'yes',
				'show_comments'          => 'yes',
				'card_height'            => '180',
				'show_excerpt'           => 'yes',
				'post_image_width'       => '1_3',
				'show_post_icon'         => 'yes',
				'grid_post'              => (object) [],
			]
		);

		// Sanitize and validate
		$data = [
			'posts_to_show'          => sanitize_text_field( $args['posts_to_show'] ),
			'include_ids'            => wp_parse_id_list( $args['include_ids'] ),
			'exclude_ids'            => wp_parse_id_list( $args['exclude_ids'] ),
			'filter_by_category'     => wp_parse_id_list( $args['filter_by_category'] ),
			'exclude_by_category'    => wp_parse_id_list( $args['exclude_by_category'] ),
			'filter_by_tag'          => wp_parse_id_list( $args['filter_by_tag'] ),
			'filter_by_post_format'  => sanitize_text_field( $args['filter_by_post_format'] ),
			'filter_by_author'       => wp_parse_id_list( $args['filter_by_author'] ),
			'published_in_last_days' => absint( $args['published_in_last_days'] ),
			'limit'                  => absint( $args['limit'] ),
			'category_limit'         => absint( $args['category_limit'] ),
			'offset'                 => absint( $args['offset'] ),
			'grid_cols'              => absint( $args['grid_cols'] ),
			'grid_cols_tablet'       => absint( $args['grid_cols_tablet'] ),
			'grid_cols_mobile'       => absint( $args['grid_cols_mobile'] ),
			'grid_thumbnail_size'    => sanitize_text_field( $args['grid_thumbnail_size'] ),
			'show_category'          => sanitize_text_field( $args['show_category'] ),
			'show_date'              => sanitize_text_field( $args['show_date'] ),
			'show_comments'          => sanitize_text_field( $args['show_comments'] ),
			'card_height'            => is_array( $args['card_height'] ) ? array_map( 'sanitize_text_field', $args['card_height'] ) : '',
			'show_excerpt'           => sanitize_text_field( $args['show_excerpt'] ),
			'post_image_width'       => sanitize_text_field( $args['post_image_width'] ),
			'layout'                 => sanitize_text_field( $args['layout'] ),
			'show_author'            => sanitize_text_field( $args['show_author'] ),
			'show_read_more'         => sanitize_text_field( $args['show_read_more'] ),
			'read_more_label'        => sanitize_text_field( $args['read_more_label'] ),
			'read_more_class'        => sanitize_text_field( $args['read_more_class'] ),
			'show_post_icon'         => sanitize_text_field( $args['show_post_icon'] ),
		];

		$data['limit']  = $post_qty + 1;
		$data['offset'] = $post_loaded;

		$grid_posts = $this->get_grid_posts( $data );

		// Check next time "load more"
		$next_load = count( $grid_posts ) > $post_qty;

		if ( $next_load ) {
			array_pop( $grid_posts );
		}

		// Start output
		ob_start();

		foreach ( $grid_posts as $grid_post ) {
			$data['grid_post'] = $grid_post;

			if ( 'classic' === $data['layout'] ) {
				anwp_post_grid()->load_partial( $data, 'teaser/classic' );
			} else {
				anwp_post_grid()->load_partial( $data, 'teaser/teaser', sanitize_key( $data['layout'] ) );
			}
		}

		$html_output = ob_get_clean();

		wp_send_json_success(
			[
				'html'   => $html_output,
				'next'   => $next_load,
				'offset' => $post_loaded + count( $grid_posts ),
			]
		);
	}

	/**
	 * Handle ajax request and provide posts to load.
	 *
	 * @since 0.6.4
	 */
	public function ajax_pagination_load() {

		// Activate referer check with hook (optional)
		if ( apply_filters( 'anwp-pg-el/config/check_public_nonce', false ) ) {
			check_ajax_referer( 'anwp-pg-public-nonce' );
		}

		$current_page = absint( $_POST['page'] );

		if ( ! absint( $current_page ) ) {
			wp_send_json_error();
		}

		// Parse with default values
		$args = wp_parse_args(
			wp_unslash( $_POST['args'] ),
			[
				'layout'                 => '',
				'posts_to_show'          => 'latest',
				'include_ids'            => '',
				'exclude_ids'            => '',
				'exclude_by_category'    => '',
				'filter_by_category'     => '',
				'filter_by_tag'          => '',
				'filter_by_post_format'  => '',
				'filter_by_author'       => '',
				'published_in_last_days' => 0,
				'limit'                  => 3,
				'offset'                 => 0,
				'grid_cols'              => 3,
				'grid_cols_tablet'       => 2,
				'grid_cols_mobile'       => 1,
				'grid_thumbnail_size'    => 'large',
				'show_category'          => 'yes',
				'category_limit'         => 1,
				'show_date'              => 'yes',
				'show_comments'          => 'yes',
				'card_height'            => '180',
				'show_excerpt'           => 'yes',
				'post_image_width'       => '1_3',
				'show_post_icon'         => 'yes',
				'grid_post'              => (object) [],
			]
		);

		// Sanitize and validate
		$data = [
			'posts_to_show'          => sanitize_text_field( $args['posts_to_show'] ),
			'include_ids'            => wp_parse_id_list( $args['include_ids'] ),
			'exclude_ids'            => wp_parse_id_list( $args['exclude_ids'] ),
			'filter_by_category'     => wp_parse_id_list( $args['filter_by_category'] ),
			'exclude_by_category'    => wp_parse_id_list( $args['exclude_by_category'] ),
			'filter_by_tag'          => wp_parse_id_list( $args['filter_by_tag'] ),
			'filter_by_post_format'  => sanitize_text_field( $args['filter_by_post_format'] ),
			'filter_by_author'       => wp_parse_id_list( $args['filter_by_author'] ),
			'published_in_last_days' => absint( $args['published_in_last_days'] ),
			'limit'                  => absint( $args['limit'] ),
			'category_limit'         => absint( $args['category_limit'] ),
			'offset'                 => absint( $args['offset'] ),
			'grid_cols'              => absint( $args['grid_cols'] ),
			'grid_cols_tablet'       => absint( $args['grid_cols_tablet'] ),
			'grid_cols_mobile'       => absint( $args['grid_cols_mobile'] ),
			'grid_thumbnail_size'    => sanitize_text_field( $args['grid_thumbnail_size'] ),
			'show_category'          => sanitize_text_field( $args['show_category'] ),
			'show_date'              => sanitize_text_field( $args['show_date'] ),
			'show_comments'          => sanitize_text_field( $args['show_comments'] ),
			'card_height'            => is_array( $args['card_height'] ) ? array_map( 'sanitize_text_field', $args['card_height'] ) : '',
			'show_excerpt'           => sanitize_text_field( $args['show_excerpt'] ),
			'post_image_width'       => sanitize_text_field( $args['post_image_width'] ),
			'layout'                 => sanitize_text_field( $args['layout'] ),
			'show_author'            => sanitize_text_field( $args['show_author'] ),
			'show_read_more'         => sanitize_text_field( $args['show_read_more'] ),
			'read_more_label'        => sanitize_text_field( $args['read_more_label'] ),
			'read_more_class'        => sanitize_text_field( $args['read_more_class'] ),
			'show_post_icon'         => sanitize_text_field( $args['show_post_icon'] ),
		];

		$data['offset'] = $data['offset'] + ( $data['limit'] * ( $current_page - 1 ) );
		$grid_posts     = $this->get_grid_posts( $data );

		// Start output
		ob_start();

		foreach ( $grid_posts as $grid_post ) {
			$data['grid_post'] = $grid_post;

			if ( 'classic' === $data['layout'] ) {
				anwp_post_grid()->load_partial( $data, 'teaser/classic' );
			} else {
				anwp_post_grid()->load_partial( $data, 'teaser/teaser', sanitize_key( $data['layout'] ) );
			}
		}

		$html_output = ob_get_clean();

		wp_send_json_success(
			[
				'html' => $html_output,
			]
		);
	}
}

