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
?>

<script type="text/javascript">
function insert_shortcode() {
    if ( jQuery('#wp-posts-carousel-form .field-invalid').length > 0) {
        alert("<?php _e('Error detected.\nPlease correct your form and try again.', 'wp-posts-carousel') ?>");
    } else {
        var shortcode = '[wp_posts_carousel';
        var custom_breakpoints = '';
        jQuery('#wp-posts-carousel-form .wp-posts-carousel-left-sidebar').find('.wp-posts-carousel-field').filter(function() {
            var val = null;

            if ( this.type != "button" ) {
                if( this.type == "checkbox" ) {
                    val = this.checked ? "true" : "false";
                } else if ( this.type == "select-multiple") {
                    val = jQuery("option:selected", this).length > 1 ? jQuery(this).val().join(",") : this.value;
                } else {
                    if ( jQuery(this).hasClass('wp-posts-carousel-custom-breakpoint') ) {
                        custom_breakpoints += jQuery(this).attr('id').split('_')[2] + ':' + jQuery(this).val() + ','
                    } else {
                        val = this.value;
                    }
                }
                if ( !jQuery(this).hasClass('wp-posts-carousel-custom-breakpoint') ) {
                    var name = this.name.replace(/\[|\]/g, '');
                    shortcode += ' '+jQuery.trim( name )+'="'+jQuery.trim( val )+'"';
                }
            }
        });

        if (custom_breakpoints != null) {
            shortcode += ' custom_breakpoints="'+ custom_breakpoints.slice(0,-1) +'"';
        }
        shortcode +=']';
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
        tb_remove();
    }
}
</script>

<div class="widget metabox-holder has-right-sidebar wp-posts-carousel-form" id="wp-posts-carousel-form">
    <div  class="wp-posts-carousel-right-sidebar">
        <br />
        <?php include( 'includes/plugin-info.php' ); ?>
    </div>

    <div class="wp-posts-carousel-left-sidebar">
        <br />
        <table cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th colspan="2">
                        <h2><?php _e('Display options', 'wp-posts-carousel') ?></h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php _e('Template', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <select name="template" id="template" class="select wp-posts-carousel-field">
                        <?php
                            $files_list = WP_Posts_Carousel_Utils::getTemplates();
                            foreach($files_list as $filename) {
                                echo '<option value="' . $filename . '">' . $filename . '</option>';
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Post types', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <select class="select wp-posts-carousel-field" name="post_types[]" id="post_types" multiple="multiple" size="4" required>
                        <?php
                            $taxonomies = WP_Posts_Carousel_Utils::getTaxonomies();
                            foreach($taxonomies as $key => $type) {
                                echo '<option value="' . $key . '" '. ($key == 'post' ? 'selected="selected"' : null ) .'>' . $type->label . '</option>';
                            }
                        ?>
                        </select>
                        <br />
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("You can select multiple post types.", "wp-posts-carousel") ); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Posts limit', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="number" name="all_items" id="all_items" value="10" size="5" required min="1" pattern="^\d+$" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <fieldset>
                            <legend><?php _e('Select what you want to display', 'wp-posts-carousel') ?></legend>

                            <table cellspacing="0" cellpadding="0">
                                <tr>
                                    <th><?php _e('Show', 'wp-posts-carousel'); ?>:</th>
                                    <td>
                                        <select class="select wp-posts-carousel-field" name="show_only" id="show_only">
                                        <?php
                                            $show_list = WP_Posts_Carousel_Utils::getShows();
                                            foreach($show_list as $key => $list) {
                                                echo '<option value="' . $key . '">' . $list . '</option>';
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php _e('but', "wp-posts-carousel") ?></td>
                                </tr>
                                <tr>
                                    <th><?php _e('exclude IDs', 'wp-posts-carousel'); ?>:</th>
                                    <td>
                                        <textarea class="widefat wp-posts-carousel-field field-validate" name="exclude" id="exclude" pattern="^[1-9](0*)(,?[1-9](0*))*$"></textarea>
                                        <br />
                                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Please enter Post or custom post type IDs with comma seperated to exlude from display.", "wp-posts-carousel") );?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr /><?php _e('or', "wp-posts-carousel") ?></td>
                                </tr>
                                <tr>
                                    <th><?php _e('by selected IDs', 'wp-posts-carousel'); ?>:</th>
                                    <td>
                                        <textarea class="widefat wp-posts-carousel-field field-validate" name="posts" id="posts" pattern="^[1-9](0*)(,?[1-9](0*))*$"></textarea>
                                        <br />
                                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Please enter Post or custom post type IDs with comma seperated.", "wp-posts-carousel") );?>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Ordering', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <select class="select wp-posts-carousel-field" name="ordering" id="ordering" class="select">
                        <?php
                            $ordering_list = WP_Posts_Carousel_Utils::getOrderings();
                            foreach($ordering_list as $key => $list) {
                                echo '<option value="' . $key . '">' . $list . '</option>';
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Category IDs', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <textarea class="widefat wp-posts-carousel-field field-validate" name="categories" id="categories" pattern="^[1-9](0*)(,?[1-9](0*))*$"></textarea>
                        <br />
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Please enter Category IDs with comma seperated.", "wp-posts-carousel") ); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Relation', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <select class="select wp-posts-carousel-field" name="relation" id="relation" class="select">
                        <?php
                            $relation_list = WP_Posts_Carousel_Utils::getRelations();
                            foreach($relation_list as $key => $list) {
                                echo '<option value="' . $key . '">' . $list . '</option>';
                            }
                        ?>
                        </select>
                    </td>
                </tr>                
                <tr>
                    <th><?php _e('Tag names', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <textarea class="widefat wp-posts-carousel-field field-validate" name="tags" id="tags" pattern="^[a-zA-Z](,?[a-zA-Z])*$"></textarea>
                        <br />
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Please enter Tag names with comma seperated.", "wp-posts-carousel") ); ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <br />
        <table cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th colspan="2">
                        <h2><?php _e('Post options', 'wp-posts-carousel') ?></h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php _e('Show title', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="show_title" id="show_title" checked="checked" />
                    </td>
                </tr>
               <tr>
                    <th><?php _e('Show created date', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="show_created_date" id="show_created_date" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Show description', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <select class="select wp-posts-carousel-field" name="show_description" id="show_description" class="select" >
                        <?php
                            $description_list = WP_Posts_Carousel_Utils::getDescriptions();
                            foreach($description_list as $key => $list) {
                                echo '<option value="' . $key . '">' . $list . '</option>';
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Allow shortcodes in full content', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="allow_shortcodes" id="allow_shortcodes" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Show category', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="show_category" id="show_category" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Show tags', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="show_tags" id="show_tags" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Show more button', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="show_more_button" id="show_more_button" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Show featured image', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="show_featured_image" id="show_featured_image" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php echo _e('Image source', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <select class="select wp-posts-carousel-field" name="image_source" id="image_source">
                        <?php
                            $source_list = WP_Posts_Carousel_Utils::getSources();
                            foreach($source_list as $key => $list) {
                                echo '<option value="' . $key . '">' . $list . '</option>';
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Image height', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="text" name="image_height" id="image_height" value="100" size="5" required pattern="^[0-9](\.?[0-9])*$" />%
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Image width', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="text" name="image_width" id="image_width" value="100" size="5" required pattern="^[0-9](\.?[0-9])*$" />%
                    </td>
                </tr>
            </tbody>
        </table>

        <br />
        <table cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th colspan="2">
                        <h2><?php _e('Carousel options', 'wp-posts-carousel') ?></h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <fieldset>
                            <legend><?php _e('Items to show', 'wp-posts-carousel') ?></legend>

                            <table cellspacing="0" cellpadding="0">
                                <tr>
                                    <th><?php _e('on mobiles', 'wp-posts-carousel'); ?>:</th>
                                    <td>
                                        <input class="wp-posts-carousel-field field-validate" type="number" name="items_to_show_mobiles" id="items_to_show_mobiles" value="1" size="5" min="1" required pattern="^\d+$" />
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php _e('on tablets', 'wp-posts-carousel'); ?>:</th>
                                    <td>
                                        <input class="wp-posts-carousel-field field-validate" type="number" name="items_to_show_tablets" id="items_to_show_tablets" value="2" size="5" min="1" required pattern="^\d+$" />
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php _e('on laptops and desktops', 'wp-posts-carousel'); ?>:</th>
                                    <td>
                                        <input class="wp-posts-carousel-field field-validate" type="number" name="items_to_show" id="items_to_show" value="4" size="5" min="1" required pattern="^\d+$" />
                                    </td>
                                </tr>

                                <?php $plugin_options = get_option( 'wp-posts-carousel_options' ); ?>
                                <?php if ( $plugin_options && array_key_exists('custom_breakpoints', $plugin_options) ): ?>
                                    <?php $breakpoints = explode(',', $plugin_options['custom_breakpoints']); ?>
                                    <?php if( count($breakpoints) > 0 ): ?>
                                    <tr>
                                        <th colspan="2">
                                            <hr />
                                            <?php _e("Custom breakpoints for RWD", "wp-posts-carousel"); ?>:
                                            <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Custom breakpoint are defined on plugin's settings page.", "wp-posts-carousel") ); ?>
                                        </th>
                                    </tr>
                                        <?php sort($breakpoints); ?>
                                        <?php foreach ($breakpoints as $width): ?>
                                            <tr>
                                                <th><?php echo $width . 'px' ?>:</th>
                                                <td>
                                                    <input class="wp-posts-carousel-field wp-posts-carousel-custom-breakpoint field-validate" size="5" id="custom_breakpoints_<?php echo $width ?>" name="custom_breakpoints[<?php echo $width ?>]" type="number" value="" min="1" required pattern="^\d+$" />
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                <?php endif ?>
                            </table>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Slide by', 'wp-posts-carousel'); ?>:</tdh>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="number" name="slide_by" id="slide_by" value="1" size="5" min="1" required pattern="^\d+$" />
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Number of elements to slide.", "wp-posts-carousel") ); ?>
                    </td>
                </tr>
               <tr>
                    <th><?php _e('Margin', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="number" name="margin" id="margin" value="5" size="5" min="0" required pattern="^\d+$" />[px]
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Margin between items.", "wp-posts-carousel") ); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Inifnity loop', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="loop" id="loop" checked="checked" />
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Duplicate last and first items to get loop illusion.", "wp-posts-carousel") ); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Pause on mouse hover', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="stop_on_hover" id="stop_on_hover" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Auto play', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="auto_play" id="auto_play" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Autoplay interval timeout', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="number" name="auto_play_timeout" id="auto_play_timeout" value="1200" size="5" min="1" required pattern="^\d+$" />[ms]
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Autoplay speed', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="number" name="auto_play_speed" id="auto_play_speed" value="800" size="5" min="1" required pattern="^\d+$" />[ms]
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Show "next" and "prev" buttons', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="nav" id="nav" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Navigation speed', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="number" name="nav_speed" id="nav_speed" value="800" size="5" min="1" required pattern="^\d+$" />[ms]
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Show dots navigation', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="dots" id="dots" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Dots speed', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="wp-posts-carousel-field field-validate" type="number" name="dots_speed" id="dots_speed" value="800" size="5" min="1" required pattern="^\d+$" />[ms]
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Delays loading of images', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="lazy_load" id="lazy_load" />
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Images outside of viewport won't be loaded before user scrolls to them. Great for mobile devices to speed up page loadings.", "wp-posts-carousel") ); ?>
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("With some themes or servers it might cause problems. If you have problem with your carousel (e.g: one of the images did not show, etc.), please uncheck this option.", "wp-posts-carousel"), 'warning' ); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Mouse events', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="mouse_drag" id="mouse_drag" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Mousewheel scrolling', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="mouse_wheel" id="mouse_wheel" checked="checked" />
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("With some themes or servers it might cause problems. If you have problem with your carousel or site (e.g: you can't scroll the page, etc.), please uncheck this option.", "wp-posts-carousel"), 'warning' ); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Touch events', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="touch_drag" id="touch_drag" checked="checked" />
                    </td>
                </tr>
                <tr>
                    <th><?php echo _e('Animation', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <select class="select wp-posts-carousel-field" name="easing" id="easing">
                        <?php
                            $animation_list = WP_Posts_Carousel_Utils::getAnimations();
                            foreach($animation_list as $key => $list) {
                                echo '<option value="' . $key . '">' . $list . '</option>';
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Auto height', 'wp-posts-carousel'); ?>:</th>
                    <td>
                        <input class="checkbox wp-posts-carousel-field" type="checkbox" value="1" name="auto_height" id="auto_height" checked="checked" />
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("Height adjusted dynamically to highest displayed item.", "wp-posts-carousel") ); ?>
                        <?php echo WP_Posts_Carousel_Utils::getTooltip( __("With some themes or servers it might cause problems. If you have problem with your carousel (e.g: one of the images did not show, etc.), please uncheck this option.", "wp-posts-carousel"), 'warning' ); ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <br />
        <input type="button" class="button button-primary button-large" value="<?php _e('Insert Shortcode', 'wp-posts-carousel') ?>" onClick="insert_shortcode();">
    </div>
</div>
