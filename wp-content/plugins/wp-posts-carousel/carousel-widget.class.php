<?php
/*
Author: Marcin Gierada
Author URI: http://www.teastudio.pl/
Author Email: m.gierada@teastudio.pl
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/*
 * widget
 */
class WpPostsCarouselWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wp_posts_carousel',
            __("WP Posts Carousel", "wp-posts-carousel"),
            array(
                'classname'  => 'widget_wp_posts_carousel',
                'description' =>  __("Show posts in Owl Carousel", "wp-posts-carousel")
            )
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters("widget_title", $instance["title"]);

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        echo WpPostsCarouselGenerator::generate($instance);
        echo $after_widget;
    }

    public function update ( $new_instance, $old_instance ) {
        $instance = $new_instance;
        $instance['custom_breakpoints'] = '';

        if ( array_key_exists('custom_breakpoints', $new_instance) ) {
            if ( !empty($new_instance['custom_breakpoints']) ) {
                $instance['custom_breakpoints'] = serialize($new_instance['custom_breakpoints']);
            }
        }
        return $instance;
    }

/**
 * the configuration form.
 */
public function form( $instance ) {
    /*
     * load defaults if new
     */
    if ( empty($instance) ) {
            $instance = WpPostsCarouselGenerator::getDefaults();
    }

    if( array_key_exists('custom_breakpoints', $instance) ) {
        $instance['custom_breakpoints'] = unserialize($instance['custom_breakpoints']);
    }
?>
    <div class="wp-posts-carousel-form">
        <p>
            <label for="<?php echo $this->get_field_id("title"); ?>"><?php _e("Title"); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr(array_key_exists('title', $instance) ? $instance["title"] : ''); ?>" />
        </p>

        <p>
            <h2><?php _e("Display options", "wp-posts-carousel") ?></h2>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("template"); ?>"><?php _e("Template", "wp-posts-carousel"); ?>:</label>
            <br />
            <select class="select wp-posts-carousel-field" name="<?php echo $this->get_field_name("template"); ?>" id="<?php echo $this->get_field_id("template"); ?>">
            <?php
                $files_list = WP_Posts_Carousel_Utils::getTemplates();
                foreach($files_list as $list) {
                    echo "<option value=\"".$list."\" ". (esc_attr($instance["template"]) == $list ? "selected=\"selected\"" : null) .">". $list ."</option>";
                }
            ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("post_type"); ?>"><?php _e("Post types", "wp-posts-carousel"); ?>:</label>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("You can select multiple post types.", "wp-posts-carousel") ); ?>
            <br />
            <select class="select wp-posts-carousel-field" name="<?php echo $this->get_field_name("post_types"); ?>[]" id="<?php echo $this->get_field_id("post_types"); ?>" multiple="multiple" size="4" required>
            <?php
                $taxonomies = WP_Posts_Carousel_Utils::getTaxonomies();
                foreach($taxonomies as $key => $type) {
                    echo "<option value=\"" .$key ."\" ". ( (is_array($instance["post_types"]) && in_array($key, $instance["post_types"]) || $instance["post_types"]  == $key) ? 'selected="selected"' : null) .">". $type->label ."</option>";
                }
            ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("all_items"); ?>"><?php _e("Posts limit", "wp-posts-carousel"); ?>:</label>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("all_items"); ?>" name="<?php echo $this->get_field_name("all_items"); ?>" type="number" value="<?php echo esc_attr($instance["all_items"]); ?>" required min="1" pattern="^\d+$" />
        </p>
        <div>
            <fieldset style="padding:10px;">
                <legend><?php _e('Select what you want to display', 'wp-posts-carousel') ?></legend>
                <p>
                    <label for="<?php echo $this->get_field_id("show_only"); ?>"><?php _e("Show", "wp-posts-carousel"); ?>:</label>
                    <br />
                    <select class="select wp-posts-carousel-field" name="<?php echo $this->get_field_name("show_only"); ?>" id="<?php echo $this->get_field_id("show_only"); ?>">
                    <?php
                        $show_list = WP_Posts_Carousel_Utils::getShows();
                        foreach($show_list as $key => $list) {
                            echo "<option value=\"".$key."\" ". (esc_attr($instance["show_only"]) == $key ? 'selected="selected"' : null) .">". $list ."</option>";
                        }
                    ?>
                    </select>
                </p>
                <p><?php _e('but', "wp-posts-carousel") ?></p>
                <p>
                    <label for="<?php echo $this->get_field_id("exclude"); ?>"><?php _e("exclude IDs", "wp-posts-carousel"); ?>:</label>
                    <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Please enter Post or custom post type IDs with comma seperated to exlude from display.", "wp-posts-carousel") );?>
                    <textarea class="widefat wp-posts-carousel-field field-validate" id="<?php echo $this->get_field_id("exclude"); ?>" name="<?php echo $this->get_field_name("exclude"); ?>" pattern="^[1-9](0*)(,?[1-9](0*))*$"><?php echo ( array_key_exists('exclude', $instance) ? esc_attr($instance["exclude"]) : null ); ?></textarea>
                </p>
                <p><hr /><?php _e('or', "wp-posts-carousel") ?></p>
                <p>
                    <label for="<?php echo $this->get_field_id("posts"); ?>"><?php _e("by selected IDs", "wp-posts-carousel"); ?>:</label>
                    <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Please enter Post or custom post type IDs with comma seperated.", "wp-posts-carousel") );?>
                    <textarea class="widefat wp-posts-carousel-field field-validate" id="<?php echo $this->get_field_id("posts"); ?>" name="<?php echo $this->get_field_name("posts"); ?>" pattern="^[1-9](0*)(,?[1-9](0*))*$"><?php echo esc_attr($instance["posts"]); ?></textarea>
                </p>
            </fieldset>
        </div>
        <p>
            <label for="<?php echo $this->get_field_id("ordering"); ?>"><?php _e("Ordering", "wp-posts-carousel"); ?>:</label>
            <br />
            <select class="select wp-posts-carousel-field" name="<?php echo $this->get_field_name("ordering"); ?>" id="<?php echo $this->get_field_id("ordering"); ?>">
            <?php
                $ordering_list = WP_Posts_Carousel_Utils::getOrderings();
                foreach($ordering_list as $key => $list) {
                    echo "<option value=\"" .$key ."\" ". (esc_attr($instance["ordering"]) == $key ? 'selected="selected"' : null) .">". $list ."</option>";
                }
            ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("categories"); ?>"><?php _e("Category IDs", "wp-posts-carousel"); ?>:</label>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Please enter Category IDs with comma seperated.", "wp-posts-carousel") ); ?>
            <textarea class="widefat wp-posts-carousel-field field-validate" id="<?php echo $this->get_field_id("categories"); ?>" name="<?php echo $this->get_field_name("categories"); ?>" pattern="^[1-9](0*)(,?[1-9](0*))*$"><?php echo esc_attr($instance["categories"]); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("relation"); ?>"><?php _e("Relation", "wp-posts-carousel"); ?>:</label>
            <br />
            <select class="select wp-posts-carousel-field" name="<?php echo $this->get_field_name("relation"); ?>" id="<?php echo $this->get_field_id("relation"); ?>">
            <?php
                $relation_list = WP_Posts_Carousel_Utils::getRelations();
                foreach($relation_list as $key => $list) {
                    echo "<option value=\"" .$key ."\" ". (esc_attr($instance["relation"]) == $key ? 'selected="selected"' : null) .">". $list ."</option>";
                }
            ?>
            </select>
        </p>        
        <p>
            <label for="<?php echo $this->get_field_id("tags"); ?>"><?php _e("Tag names", "wp-posts-carousel"); ?>:</label>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Please enter Tag names with comma seperated.", "wp-posts-carousel") ); ?>
            <textarea class="widefat wp-posts-carousel-field field-validate" id="<?php echo $this->get_field_id("tags"); ?>" name="<?php echo $this->get_field_name("tags"); ?>" pattern="^[a-zA-z](,?[a-zA-Z])*$"><?php echo esc_attr($instance["tags"]); ?></textarea>
        </p>

        <p>
            <h2><?php _e("Post options", "wp-posts-carousel") ?></h2>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("show_title"); ?>" name="<?php echo $this->get_field_name("show_title"); ?>" <?php array_key_exists('show_title', $instance) ? checked( (bool) $instance["show_title"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("show_title"); ?>"><?php _e("Show title", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("show_created_date"); ?>" name="<?php echo $this->get_field_name("show_created_date"); ?>" <?php array_key_exists('show_created_date', $instance) ? checked( (bool) $instance["show_created_date"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("show_created_date"); ?>"><?php _e("Show created date", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("show_description"); ?>"><?php _e("Show description", "wp-posts-carousel"); ?>:</label>
            <br />
            <select class="select wp-posts-carousel-field" name="<?php echo $this->get_field_name("show_description"); ?>" id="<?php echo $this->get_field_id("show_description"); ?>">
            <?php
                $description_list = WP_Posts_Carousel_Utils::getDescriptions();
                foreach($description_list as $key => $list) {
                    echo "<option value=\"". $key ."\" ". (esc_attr($instance["show_description"]) == $key ? 'selected="selected"' : null) .">". $list ."</option>";
                }
            ?>
            </select>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("allow_shortcodes"); ?>" name="<?php echo $this->get_field_name("allow_shortcodes"); ?>" <?php array_key_exists('allow_shortcodes', $instance) ? checked( (bool) $instance["allow_shortcodes"], false ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("allow_shortcodes"); ?>"><?php _e("Allow shortcodes in full content", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("show_category"); ?>" name="<?php echo $this->get_field_name("show_category"); ?>" <?php array_key_exists('show_category', $instance) ? checked( (bool) $instance["show_category"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("show_category"); ?>"><?php _e("Show category", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("show_tags"); ?>" name="<?php echo $this->get_field_name("show_tags"); ?>" <?php array_key_exists('show_tags', $instance) ? checked( (bool) $instance["show_tags"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("show_tags"); ?>"><?php _e("Show tags", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("show_more_button"); ?>" name="<?php echo $this->get_field_name("show_more_button"); ?>" <?php array_key_exists('show_more_button', $instance) ? checked( (bool) $instance["show_more_button"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("show_more_button"); ?>"><?php _e("Show more button", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("show_featured_image"); ?>" name="<?php echo $this->get_field_name("show_featured_image"); ?>" <?php array_key_exists('show_featured_image', $instance) ? checked( (bool) $instance["show_featured_image"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("show_featured_image"); ?>"><?php _e("Show featured image", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("image_source"); ?>"><?php echo _e("Image source", "wp-posts-carousel"); ?>:</label>
            <br />
            <select class="select wp-posts-carousel-field" name="<?php echo $this->get_field_name("image_source"); ?>" id="<?php echo $this->get_field_id("image_source"); ?>">
            <?php
                $source_list = WP_Posts_Carousel_Utils::getSources();
                foreach($source_list as $key => $list) {
                    echo "<option value=\"". $key ."\" ". (esc_attr($instance["image_source"]) == $key ? 'selected="selected"' : null) .">". $list ."</option>";
                }
            ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("image_height"); ?>"><?php _e("Image height", "wp-posts-carousel"); ?>:</label>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="10" id="<?php echo $this->get_field_id("image_height"); ?>" name="<?php echo $this->get_field_name("image_height"); ?>" type="text" value="<?php echo esc_attr($instance["image_height"]); ?>" required pattern="^[0-9](\.?[0-9])*$" />%
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("image_width"); ?>"><?php _e("Image width", "wp-posts-carousel"); ?>:</label>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="10" id="<?php echo $this->get_field_id("image_width"); ?>" name="<?php echo $this->get_field_name("image_width"); ?>" type="text" value="<?php echo esc_attr($instance["image_width"]); ?>" required pattern="^[0-9](\.?[0-9])*$" />%
        </p>
        <p>
            <h2><?php _e("Carousel options", "wp-posts-carousel") ?></h2>
        </p>
        <div>
            <fieldset style="border:1px solid #dfdfdf;padding:10px;">
                <legend>
                    <strong><?php _e('Items to show', 'wp-posts-carousel') ?>:</strong>
                    <?php echo WP_Posts_Carousel_Utils::getTooltip( __("If you need to create some other breakpoints suits to your website, you can define custombreakpoints on plugin's settings page.", "wp-posts-carousel") ); ?>
                </legend>
                    <p>
                        <label for="<?php echo $this->get_field_id("items_to_show_mobiles"); ?>"><?php _e("on mobiles", "wp-posts-carousel"); ?>:</label>
                        <br />
                        <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("items_to_show_mobiles"); ?>" name="<?php echo $this->get_field_name("items_to_show_mobiles"); ?>" type="number" value="<?php echo esc_attr($instance["items_to_show_mobiles"]); ?>" min="1" required pattern="^\d+$" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id("items_to_show_tablets"); ?>"><?php _e("on tablets", "wp-posts-carousel"); ?>:</label>
                        <br />
                        <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("items_to_show_tablets"); ?>" name="<?php echo $this->get_field_name("items_to_show_tablets"); ?>" type="number" value="<?php echo esc_attr($instance["items_to_show_tablets"]); ?>" min="1" required pattern="^\d+$" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id("items_to_show"); ?>"><?php _e("on laptops and desktops", "wp-posts-carousel"); ?>:</label>
                        <br />
                        <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("items_to_show"); ?>" name="<?php echo $this->get_field_name("items_to_show"); ?>" type="number" value="<?php echo esc_attr($instance["items_to_show"]); ?>" min="1" required pattern="^\d+$" />
                    </p>


                    <?php $plugin_options = get_option( 'wp-posts-carousel_options' ); ?>
                    <?php if ( $plugin_options && array_key_exists('custom_breakpoints', $plugin_options) ): ?>
                        <?php $breakpoints = explode(',', $plugin_options['custom_breakpoints']); ?>
                        <?php if( count($breakpoints) > 0 ): ?>
                            <p><hr /></p>
                            <p>
                                <?php _e("Custom breakpoints for RWD", "wp-posts-carousel"); ?>:
                                <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Custom breakpoint are defined on plugin's settings page.", "wp-posts-carousel") ); ?>
                            </p>
                            <?php sort($breakpoints); ?>
                            <?php foreach ($breakpoints as $width): ?>
                                <p>
                                    <label for="<?php echo $this->get_field_id("custom_breakpoints") . '_' . $width; ?>"><?php echo $width . 'px' ?>:</label>
                                    <br />
                                    <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("custom_breakpoints") . '_' . $width; ?>" name="<?php echo $this->get_field_name("custom_breakpoints") . '[' . $width . ']'; ?>" type="number" value="<?php echo ( array_key_exists('custom_breakpoints', $instance) && array_key_exists($width, $instance["custom_breakpoints"]) ? esc_attr($instance["custom_breakpoints"][$width]) : null ); ?>" min="1" required pattern="^\d+$" />
                                </p>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endif ?>
             </fieldset>
        </div>
        <p>
            <label for="<?php echo $this->get_field_id("slide_by"); ?>"><?php _e("Slide by", "wp-posts-carousel"); ?>:</label>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Number of elements to slide.", "wp-posts-carousel") ); ?>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("slide_by"); ?>" name="<?php echo $this->get_field_name("slide_by"); ?>" type="number" value="<?php echo esc_attr($instance["slide_by"]); ?>" min="1" required pattern="^\d+$" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("margin"); ?>"><?php _e("Margin", "wp-posts-carousel"); ?>:</label>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Margin between items.", "wp-posts-carousel") ); ?>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("margin"); ?>" name="<?php echo $this->get_field_name("margin"); ?>" type="number" value="<?php echo esc_attr($instance["margin"]); ?>" min="0" required pattern="^\d+$" />[px]
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("loop"); ?>" name="<?php echo $this->get_field_name("loop"); ?>" <?php array_key_exists('loop', $instance) ? checked( (bool) $instance["loop"], true ): null; ?> value="1" />
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Duplicate last and first items to get loop illusion.", "wp-posts-carousel") ); ?>
            <br />
            <label for="<?php echo $this->get_field_id("loop"); ?>"><?php _e("Inifnity loop", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("stop_on_hover"); ?>" name="<?php echo $this->get_field_name("stop_on_hover"); ?>" <?php array_key_exists('stop_on_hover', $instance) ? checked( (bool) $instance["stop_on_hover"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("stop_on_hover"); ?>"><?php _e("Pause on mouse hover", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("auto_play"); ?>" name="<?php echo $this->get_field_name("auto_play"); ?>" <?php array_key_exists('auto_play', $instance) ? checked( (bool) $instance["auto_play"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("auto_play"); ?>"><?php _e("Auto play", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("auto_play_timeout"); ?>"><?php _e("Autoplay interval timeout", "wp-posts-carousel"); ?>:</label>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("auto_play_timeout"); ?>" name="<?php echo $this->get_field_name("auto_play_timeout"); ?>" type="number" value="<?php echo esc_attr($instance["auto_play_timeout"]); ?>" min="1" required pattern="^\d+$" />[ms]
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("auto_play_speed"); ?>"><?php _e("Autoplay speed", "wp-posts-carousel"); ?>:</label>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("auto_play_speed"); ?>" name="<?php echo $this->get_field_name("auto_play_speed"); ?>" type="number" value="<?php echo esc_attr($instance["auto_play_speed"]); ?>" min="1" required pattern="^\d+$" />[ms]
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("nav"); ?>" name="<?php echo $this->get_field_name("nav"); ?>" <?php array_key_exists('nav', $instance) ? checked( (bool) $instance["nav"], true ): null; ?> value="1"/>
            <label for="<?php echo $this->get_field_id("nav"); ?>"><?php _e("show \"next\" and \"prev\" buttons", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("nav_speed"); ?>"><?php _e("Navigation speed", "wp-posts-carousel"); ?>:</label>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("nav_speed"); ?>" name="<?php echo $this->get_field_name("nav_speed"); ?>" type="number" value="<?php echo esc_attr($instance["nav_speed"]); ?>" min="1" required pattern="^\d+$" />[ms]
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("dots"); ?>" name="<?php echo $this->get_field_name("dots"); ?>" <?php array_key_exists('dots', $instance) ? checked( (bool) $instance["dots"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("dots"); ?>"><?php _e("Show dots navigation", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("dots_speed"); ?>"><?php _e("Dots speed", "wp-posts-carousel"); ?>:</label>
            <br />
            <input class="wp-posts-carousel-field field-validate" size="5" id="<?php echo $this->get_field_id("dots_speed"); ?>" name="<?php echo $this->get_field_name("dots_speed"); ?>" type="number" value="<?php echo esc_attr($instance["dots_speed"]); ?>" min="1" required pattern="^\d+$" />[ms]
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("lazy_load"); ?>" name="<?php echo $this->get_field_name("lazy_load"); ?>" <?php array_key_exists('lazy_load', $instance) ? checked( (bool) $instance["lazy_load"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("lazy_load"); ?>"><?php _e("Delays loading of images", "wp-posts-carousel"); ?></label>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Images outside of viewport won't be loaded before user scrolls to them. Great for mobile devices to speed up page loadings.", "wp-posts-carousel") ); ?>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("With some themes or servers it might cause problems. If you have problem with your carousel (e.g: one of the images did not show, etc.), please uncheck this option.", "wp-posts-carousel"), 'warning' ); ?>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("mouse_drag"); ?>" name="<?php echo $this->get_field_name("mouse_drag"); ?>" <?php array_key_exists('mouse_drag', $instance) ? checked( (bool) $instance["mouse_drag"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("mouse_drag"); ?>"><?php _e("Mouse events", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("mouse_wheel"); ?>" name="<?php echo $this->get_field_name("mouse_wheel"); ?>" <?php array_key_exists('mouse_wheel', $instance) ? checked( (bool) $instance["mouse_wheel"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("mouse_wheel"); ?>"><?php _e("Mousewheel scrolling", "wp-posts-carousel"); ?></label>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("With some themes or servers it might cause problems. If you have problem with your carousel or site (e.g: you can't scroll the page, etc.), please uncheck this option.", "wp-posts-carousel"), 'warning' ); ?>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" id="<?php echo $this->get_field_id("touch_drag"); ?>" name="<?php echo $this->get_field_name("touch_drag"); ?>" <?php array_key_exists('touch_drag', $instance) ? checked( (bool) $instance["touch_drag"], true ): null; ?> value="1" />
            <label for="<?php echo $this->get_field_id("touch_drag"); ?>"><?php _e("Touch events", "wp-posts-carousel"); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("easing"); ?>"><?php echo _e("Animation", "wp-posts-carousel"); ?>:</label>
            <br />
            <select class="select wp-posts-carousel-field field-validate" name="<?php echo $this->get_field_name("easing"); ?>" id="<?php echo $this->get_field_id("easing"); ?>">
            <?php
                $animation_list = WP_Posts_Carousel_Utils::getAnimations();
                foreach($animation_list as $key => $list) {
                    echo "<option value=\"". $key ."\" ". (esc_attr($instance["easing"]) == $key ? 'selected="selected"' : null) .">". $list ."</option>";
                }
            ?>
            </select>
        </p>
        <p>
            <input class="checkbox wp-posts-carousel-field" type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("auto_height"); ?>" name="<?php echo $this->get_field_name("auto_height"); ?>" <?php array_key_exists('auto_height', $instance) ? checked( (bool) $instance["auto_height"], true ): null; ?> value="1"/>
            <label for="<?php echo $this->get_field_id("auto_height"); ?>"><?php _e("Auto height", "wp-posts-carousel"); ?></label>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Height adjusted dynamically to highest displayed item.", "wp-posts-carousel") ); ?>
            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("With some themes or servers it might cause problems. If you have problem with your carousel (e.g: one of the images did not show, etc.), please uncheck this option.", "wp-posts-carousel"), 'warning' ); ?>
        </p>
    </div>
<?php
    }
}

add_action("widgets_init", function() {
    return register_widget('WpPostsCarouselWidget');
});
?>