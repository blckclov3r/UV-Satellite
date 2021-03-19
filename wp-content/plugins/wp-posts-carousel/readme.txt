=== WP Posts Carousel ===
Contributors: teastudio.pl
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2SQA4FL25Y73W
Tags: carousel, slider, posts carousel, posts slider, custom post type, wordpress carousel, wordpress posts slider, wordpress owl carousel, owl carousel
Requires at least: 3.6
Tested up to: 5.5.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Posts Carousel is a widget and a shortcode generator to displays posts or custom post types in Owl Carousel.
== Description ==

= This plugin is under development, unfortunately it takes a while, so sorry for missing updates. It is further developed... =


**WP Posts Carousel** allows to view the list of selected post types in a carousel. The plugin offers rich parameters of carousel display and post information, and provides better support for mobile devices. The plugin is equipped with a code generator (allows to insert the carousel into content) and a dedicated widget.
This plugin uses [OWL Carousel](http://www.owlcarousel.owlgraphic.com/) in new version 2.0.0-beta.2.4.


= This plugin may require some others plugins or libraries: =
* **Font Awesome** - this library is included but you can disable it on the plugin's settings page
* **WordPress Popular Posts** - this plugin is required only if you want to display popular posts in the carousel


= Now available in the following Languages =

* English (en_EN)
* Polish (pl_PL)


If you need other translation or you would like to create some, please visit [crowdin.com](https://crowdin.com/project/wp-posts-carousel) project page.



For more information, check out [PLUGIN HOMEPAGE](http://www.teastudio.pl/en/product/wp-posts-carousel/).

= DEMO =
You can see the plugin in action on [DEMO PAGE](http://wordpress.teastudio.pl/category/product/wp-posts-carousel/)


I will be grateful for opinions and reviews.

== Translations: ==

* English - by Marcin Gierada
* Polish - by Marcin Gierada


== Installation ==

1. Upload plugin either via the your's WordPress installation, or by uploading to the /wp-content/plugins/ by FTP client
2. Install the plugin through the 'Plugins' menu in WordPress.
3. Activate "WP Posts Carousel" in the "Plugins" using the "Activate" link.
4. Go to the plugin settings page in the "Settings" menu.

== Frequently Asked Questions ==
If you've got any questions, don't hesitate to ask.

= I made a update from a previous version. What now? =

* If you're using on your website shortcode from this plugin, the best way is to delete old code and generate it again.
* If you're using widget, you must update its options.
* **Go to the plugin settings page and see if there are any notifications**


= How can I add custom theme? =

1. Now, you can add your custom stylesheet in your's theme directory.
2. If you don't have "css" folder in your WordPress theme, you must create it.
3. Then, in this folder create another - named "wp-posts-carousel" and now you can move custom stylesheets in there :)

Folders path should looks like this:
`/themes/my_wordpress_theme/css/wp-posts-carousel/custom.css`


= How can I use custom actions or filters? =
From 1.1.1 version you can use your own actions and filters to overwrite values or html code.


Lists of actions:

* wpc_before_item_content (1 parameter - $params)
* wpc_after_item_content (1 parameter - $params)


Lists of filters:

**new filters for developers**

* wpc_get_shows (1 parameter - $value)
* wpc_get_orderings (1 parameter - $value)
* get_descriptions (1 parameter - $value)
* get_sources (1 parameter - $value)

**standard filters**

* wpc_query (2 parameters - $value, $params)
* wpc_item_featured_image_placeholder (1 parameter - $value)
* wpc_item_featured_image (2 parameters - $value, $params)
* wpc_item_title (2 parameters - $value, $params)
* wpc_item_created_date (2 parameters - $value, $params)
* wpc_item_categories (2 parameters - $value, $params)
* wpc_item_description (2 parameters - $value, $params)
* wpc_item_tags (2 parameters - $value, $params)
* wpc_item_buttons (2 parameters - $value, $params)

Variable **$params** includes all plugin's values and other variables that are required to display.


e.g:
To overwrite html of the title, you can create function in your functions.php file:
[See "Overwrite title by filters from WP Posts Carousel"](http://pastebin.com/kZs3bDh1)


For more info visit [WordPress Function Reference/add filter](https://codex.wordpress.org/Function_Reference/add_filter)


== Screenshots ==
1. Widget configuration
2. Shortcode generator
3. WYSIWYG button
4. Settings page
5. Example of usage

== Changelog ==
= 1.3.7 =
* fixed problems with newest version of PHP and Wordpress (thanks to John Holt and Steckinsights)

= 1.3.6 =
* fixed problem with query

= 1.3.5 =
* added params value to the "wpc_query" filter
* added new filters for custom modifications
* added option to set the relation method between categories and tags 

= 1.3.4 =
* fixed bug with params in "wpc_item_categories" filter

= 1.3.3 =
* fixed small bug on generating js for the carousel (thanks to tehpopulator from wordpress.org)
* fixed small bug on the plugin settings page (thanks to studiokb from wordpress.org)

= 1.3.2 =
* added skipped "Show created date" option to the widget (thanks to Luca Franchini)
* check if some of the new variables is exists (thanks to Weronika Rudnicka)


= 1.3.1 =
* fixed filters: wpc_item_categories and wpc_item_tags

= 1.3.0 =
* fixed HTML5 validation
* added option to exclude posts from display
* added option to select where it should include plugin's scripts (head or footer section)
* added option to display many post types in one carousel
* added option to create custom breakpoints for better responsiveness

= 1.2.9 =
* fixed the problem with non existing variables
* added the "wpc_query" filter to overwrite query parameters

= 1.2.8 =
* fixed the code structure

= 1.2.7 =
* fixed conditions to display categories and tags

= 1.2.6 =
* again, fixed the problem with custom taxonomies on WordPress 4.4

= 1.2.5 =
* fixed the problem with custom taxonomies on WordPress 4.4

= 1.2.4 =
* fixed custom taxonomy queries
* added inputs validation
* added donate link

= 1.2.3 =
* fixed carousel loading - hide before load

= 1.2.2 =
* fixed custom stylesheet loading (thanks to CotswoldPhoto)

= 1.2.1 =
* fixed auto height display

= 1.2.0 =
* improved WordPress 4.3 capatible
* fixed query for custom post types
* added option to setup visible items on mobile, tablets and desktop devices
* translation update
* added new filter "wpc_item_featured_image_placeholder" for the featured image placeholder
* fixed problem with lazy loading images

= 1.1.9 =
* fixed display one item carousel

= 1.1.8 =
* added option to disable auto height

= 1.1.7 =
* added autoplay speed option
* improved lazy load for large images

= 1.1.6 =
* updated Polish language translation

= 1.1.5 =
* fixed problem with jQuery UI Effects library

= 1.1.4 =
* fixed problem with duplicate posts

= 1.1.3 =
* fixed problem with animation variable in shortcode generator

= 1.1.2 =
* replaced display the excerpt from directly field's value to automatically gererate excerpt by get_the_excerpt() function

= 1.1.1 =
* added actions and filters to overwrite html and values
* added option to select posts or custom post types by IDs

Remember to rebuild your shortcodes and update widgets options.

= 1.1.0 =
* fixed problem with WordPress queries
* added option to allow shortcodes in post content

= 1.0.9 =
* fixed problem with loading owl.carousel script

= 1.0.8 =
* fixed problem with carousel height in Safari browser

= 1.0.7 =
* fixed problem with carousel height in Safari browser
* changed way to enter tags, from ids to names

= 1.0.6 =
* new option to sort - by post views (required external plugin - Wordpress Popular Posts)
* new option to sort - by id
* new option to sort - by title
* new option to sort - by date
* new option to order - random lists

= 1.0.5 =
* fixed FontAwesome include method

= 1.0.4 =
* new way to display posts - by full content
**Important** Before update read FAQ.
* new option to set margin between items

= 1.0.3 =
* new option to display posts or other taxonomies with selected tags

= 1.0.2 =
* changed custom stylesheet directory

= 1.0.1 =
* new option to display post tags
* new way to include FontAwesome - from official Bootstrap CDN

= 1.0.0 =
Initial release

== Upgrade Notice ==
