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
<div class="postbox">
    <div class="inside hndle">
        <p class="inner"><?php _e('Version', 'wp-posts-carousel') ?>: <?php echo self::VERSION ?></p>
    </div>

    <h3 class="hndle"><?php _e('Donate, if you like this plugin', 'wp-posts-carousel') ?></h3>
    <div class="inside">
        <p><?php _e('Thanks for all donations, no matter the size.', 'wp-posts-carousel') ?></p>

        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="2SQA4FL25Y73W">
            <input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online." style="margin: 0 auto;display: block;">
            <img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>


    <h3 class="hndle" style="border-top: 1px solid #eee;">
        <span><?php _e('Need support?', 'wp-posts-carousel') ?></span>
    </h3>
    <div class="inside">
        <p class="inner">
            <?php _e('If you are having problems with this plugin, please contact by', $this->plugin_slug) ?> <a href="mailto:info@teastudio.pl" target="_blank" title="info@teastudio.pl">info@teastudio.pl</a><br />
            <?php _e('For more information about this plugin, please visit', 'wp-posts-carousel') ?> <a href="http://www.teastudio.pl/en/product/wp-posts-carousel/" target="_blank" title="http://www.teastudio.pl/en/product/wp-posts-carousel/"><?php _e('plugin page', 'wp-posts-carousel') ?></a><br />
        </p>
    </div>

    <h3 class="hndle" style="color:#A6CF38;border-top: 1px solid #eee;">
        <span><?php _e('Need custom modification, plugin or theme?', 'wp-posts-carousel') ?></span>
    </h3>
    <div class="inside">
        <p class="inner">
            <?php _e('If you like this plugin, but need something a bit more custom or completely new, you can hire me to work for you! Email me at <a href="mailto:m.gierada@teastudio.pl" title="Hire me">m.gierada@teastudio.pl</a> for more information!', 'wp-posts-carousel') ?><br />
        </p>
    </div>
    <div class="inside" style="border-top: 1px solid #eee;">
        <p>
            <a href="http://www.teastudio.pl" target="_blank" title="Design and web development - www.teastudio.pl"><img src="<?php echo plugins_url('/../images/teastudio-logo.png' , __FILE__ ) ?>" alt="www.teastudio.pl" /></a>
        </p>
    </div>
</div>