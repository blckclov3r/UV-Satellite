=== Slide Anything - Responsive Content / HTML Slider and Carousel ===
Contributors: simonpedge
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RP7JLGK6VT252
Tags: slider, carousel, content slider, responsive slider, html slider, owl carousel
Requires at least: 4.0
Tested up to: 5.6.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create a responsive carousel or slider where the content for each slide can be anything you want - images, text, HTML, and even shortcodes.

== Description ==

Slide Anything allows you to create a carousel/slider where the content for each slide can be anything you want - images, text, HTML, and even shortcodes. This plugin uses the Owl Carousel 2 jQuery plugin, and lets you create beautiful, touch enabled, responsive carousels and sliders.

Slide Anything provides many Owl Carousel 2 features, which include:

* Touch and Drag Support - Designed specially to boost mobile browsing experience. Mouse drag works great on desktop too!
* Fully Responsive - You can define the number of slides to display for various breakpoint settings, e.g. 4 slides on desktop, 3 slides on tablet and 2 slides on mobile.
* Modern Browsers - Owl uses hardware acceleration with CSS3 Translate3d transitions. Its fast and works like a charm! It also supports CSS2 fallbacks to cater for older browsers.
* New Lazy Load Images - with this feature enabled, slide images (<img> tags) are only loaded when the relevant slides are displayed (all of the slider's images are NOT loaded up-front).
* Infinite Looping - introduced with Owl Carousel 2, this feature means that the first slide is now seamlessly displayed after the last slide without any carousel rewind.
* New Transition Effects - New Owl Carousel transitions include Slide, Fade, Zoom In, Zoom Out, Flip Out X/Y, Rotate Left/Right, Bounce Out, Roll Out and Slide Down.
* Slide Link Feature - A feature which allows you to create a hover-over link button for any slide within your carousels.
* Re-Order Slides Facility - Now you can use a 'drag-and-drop' interface to easily re-order your slides within the sliders you create.

[Usage Examples](https://edgewebpages.com/slide-anything-usage-examples)

= Slide Anything PRO =

[SLIDE ANYTHING PRO](https://edgewebpages.com/) adds the following extra features:

* MODAL POPUPS - Each slide can now open a MODAL POPUP, which can be an IMAGE popup, a VIDEO EMBED popup (YouTube/Vimeo), a HTML CODE popup or a popup displaying a WordPress SHORTCODE.
* HERO SLIDER - A Hero Slider is a slider that always is 100% of the width/height of the device it's being viewed on (or 100% of the window width/height if on a desktop device). 
* THUMBNAIL PAGINATION - Allows you to add an area of small clickable thumb images, with each image representing a single slide that can be clicked to navigate to that slide.
* SHOWCASE CAROUSEL - A Carousel with a width exceeding the width of the container that it's placed in, which results in the left/rightmost visible slides becoming partially visible.

[MODAL POPUPS DEMO](https://edgewebpages.com/)

[HERO SLIDER WITH THUMBNAILS DEMO](https://edgewebpages.com/hero-slider-with-thumbnails/)

[SHOWCASE CAROUSEL](https://edgewebpages.com/showcase-carousel-demo/)

= Owl Carousel =

[Owl Carousel](https://owlcarousel2.github.io/OwlCarousel2/) is an extremely powerful and flexible carousel/slider JQuery plugin, and it is also free to use! Unfortunately, it's not easy to integrate Owl Carousel into a WordPress site if you are a non-developer, and requires JQuery and PHP coding skills. That is why I developed this plugin.

I use Owl Carousel a in various WordPress sites I develop, specifically where I need the additional flexibility to develop a carousel with a more complex layout, or use a layout not catered for by any existing carousel plugin product.

Please view the [FAQ Page](https://wordpress.org/plugins/slide-anything/faq/) for information on how to use `Slide Anything`.

== Installation ==

1. Upload the entire `slide-anything` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu within the WordPress Dashboard.

You will now see the `Sliders` menu in your WordPress admin panel.

== Frequently Asked Questions ==

= How do I insert 'Slide Anything' sliders into my WordPress pages or posts? =

There are two ways to do this. If you are using the visual editor to edit a page or post, you will see a `Slide Anything Sliders` button/icon in the toolbar of the editor. Click this button and a popup will be displayed containing a list of sliders that you have created. Select the title of a slider within this list and click `OK` to insert the shortcode for the selected slider into your page or post content.

The other method: When you are editing your slider within the WordPress Dashboard, you will see a box with the heading `Shortcode / Preview` on the right-hand side. Click the `Copy to Clipboard` button within this box to copy the slider shortcode to your clipboard. Paste this copied shortcode into the page or post where you would like your slider to appear. This is also the method to use if you want to insert your slider into a text widget or another custom content type, such as a portfolio post.

= The difference between a Slider and a Carousel, and how to create either =

By definition a `slider` has a single slide displayed on-page at a time, whilst a `carousel` has multiple slides displayed 'on-page' at a time. The `Items Displayed` box, on the right-hand side of the slider edit page in the WordPress dashboard controls how many slides are displayed on-page at a time.

To define a slider, all the settings within this box must be set to `1`. When these are set to values greater than `1`, a carousel will be displayed, for example you may want to display a carousel with 4 slides visible on desktop devices, 3 slides visible on tablets and only 2 slides visible on mobile phones.

= How do I define slide background images? =

The `Slide Background` box for each slide in your slider allows you to define a background image or a background color for each slide. Note that the content you add to each slide within the slide editor box for each slide is foreground content and sits on `top` of the slide background - this content can be other images and textual content.

To set a slide background image, click the `Set Image` button. The `Background Size` setting determines if, and how the background image is stretched/shrunk to cover the slide content area and the `Background Repeat` setting determines if the backgroung image should be repeated, like tiles. The `Background Color` setting allows you set a color for the slide background - note that you can have both a slide background color AND a slide background image. The small background preview window to the left of these settings give you an indication on how the settings you choose will look.

The `Min Height` setting (within the `Slider Style` box), is often used in conjunction with defining slide backgrounds, as this setting controls how much of the slide background is visible if the slide contains no (foreground) content.

= How do I use the 'Slider Style' settings? =

At the top of this box, which appears on the right-hand side when editing a slider, you can set and copy the CSS `ID` for the slider. This is useful for developers who are familiar with CSS coding, and this CSS `ID` can be used to create custom styles for your slider within your theme or child-theme's style/CSS file.

The `Padding (pixels)` settings are used to define the amount of padding space around the entire slider - top, right, bottom and left. The `Background/Border` settings define the background colour for the entire slider (`Note:` each slide's background image/color will appear on top of this slider background), and also if a border should appear around the entire slider - the width, color and border radius of this border.

The `SLIDE STYLE` settings are the style settings for each individual slide with the slider/carousel. Here you can define the minimum height each slide and also the padding space around each slide.

= Using 'Slide Anything' in WordPress 5.0 =

Adding a SLIDE ANYTHING slider using the WordPress 5.0 'Block Editor' is pretty straight-forward. You can paste a Slide Anything shortcode into a 'Paragraph Block' or use the 'Shortcode Block'.

== Screenshots ==

1. The Create/Edit slider page within the WordPress Dashboard - this is where you define the settings and create the slides for your `Slide Anything` slider or carousel.
2. How a carousel created using `Slide Anything` appears within the slider preview popup.

== Changelog ==

= 2.3.33 =
* An issue exists with Slide Anything within the WP Dashboard when the Yoast SEO plugin is installed, and when previously created created sliders are edited the slide content previously created dissapears. After some investigation I discovered that Yoast SEO is clashing somehow with the 'Preview Slider' feature which opens a Popup Preview of the slider within the WP Dashboard Edit Slider page. So as a workaround/solution I detect whether Yoast SEO is installed and then disable the 'Preview Slider' functionality if Yoast SEO is installed on the site.

= 2.3.32 =
* Changed the order of the items displayed within the 'Changelog' so that the most recent changes are displayed at the top of the list.

= 2.3.31 =
* Added a new feture to allow you to specify the WordPress image size to use for slide background images. Previously slide background images were all set the the "full" WordPress image size.

= 2.3.30 =
* Added a new feture to set the 'Starting Slide Number' for a slider. This sets the Owl Carousel 'startPosition' option to set the slide number to display first within the list of slides created for a slider.

= 2.3.29 =
* Added 2 new features. The 'Right to Left Slider' feature changes the direction of the slider to be right to left. The 'Disable Preview Feature' disables the 'Preview Slider' button within the SA slider settings page and also disables the auto-generation of the 'Slide Anything Popup Preview' WordPress page.

= 2.3.28 =
* 2 small fixes. Added transparent (invisible) 'Previous' and 'Next' text to the Previous & Next arrow buttons so that accessibility errors are no longer generated with accessibility evaluation tools. Do not use the 'window.dispatchEvent' function call on IE11 browsers when executing a 'resize' event.

= 2.3.27 =
* Adding a new Slide Anything global setting which appears under 'Settings->Writing' within the WordPress Dashbaord. This is a checkbox setting called 'Disable TinyMCE Button', and when checked the 'Slide Anything Sliders' button within the toolbar of the WordPress Classic Editor when editing pages and posts will be disabled. This TinyMCE button is causing issues on some sites, and adding the facility to turn off this button resolves this issue.

= 2.3.26 =
* When thumbnail pagination and popup options are used together (PRO version only) there was an issue - the popup images or popup YouTube video thumbs were not be used to set the thumbnail images.

= 2.3.25 =
* Small Bug Fix: If the 'lazy load images' option was enabled and a slide content was blank then a PHP warning message was being displayed.

= 2.3.24 =
* Small Bug Fix to fix a conflict with the 'Photonic Gallery & Lightbox' plugin. The slide 'Add Media' button was not working when this plugin is installed.

= 2.3.23 =
* Small Bug Fix: The Re-Order slides page was displaying a PHP warning notice on sites with PHP 7.4.

= 2.3.22 =
* Small Bug Fix to fix a clash with the 'Woody Snippets' plugin within the WordPress Dashboard

= 2.3.21 =
* Small Bug Fix to remove PHP Notice (warnings) within 'slide-anything-admin.php' for possible undefined indexs for 'popup_type', 'popup_video_type' and 'popup_video_id'

= 2.3.20 =
* Added a new feature 'Slide Goto Links', which allows the creation of links (or buttons) that when clicked will go to a specific slide within your slider.

= 2.3.19 =
* Fixed an issue with the slider arrows that occurs when multiple Showcase Carousels (SA PRO) are displayed on a page.

= 2.3.18 =
* Call the JavaScript 'window resize' event when the Owl Carousel 'initialized' event is executed - this resolves an issue some uses have been experiencing with slides not being sized correctly after page load

= 2.3.17 =
* Small Bug Fix: Click to Advance feature was not working properly with multiple sliders on the page

= 2.3.16 =
* Small Bug Fix: Using the Slide Anything shortcode with an incorrect ID sometimes did not display an error message - this has been resolved

= 2.3.15 =
* Added 'Click to Advance' feature which when enabled allows users to click on the slider to advance it one slide

= 2.3.14 =
* YouTube popups now set the slide background to the YouTube thumbnail by default

= 2.3.13 =
* Minor bug fix: PHP 'Undefined Index' warnings were sometimes displayed after upgrading to Slide Anything PRO (and the slider was created using the Slide Anything FREE plugin)

= 2.3.12 =
* Added a new feature (checkbox) to vertically center content within slides.

= 2.3.11 =
* Couple of small bug fixes: Undefined index error for 'popup_shortcode' vairables and hide "SA PRO' advert for non-admin users.

= 2.3.10 =
* Revamped the 'Preview Slider' feature, so that the preview popup container loads the front-end theme's javascript and css style files

= 2.3.9 =
* CSS Style changes for some of the WordPress Dashboard input elements (in response to to the WordPress 5.3 update which changed some default Dashboard styling)

= 2.3.8 =
* Added the 'Use UL and LI Containers' checkbox which when checked, 'UL' is used as the DOM element for 'owl-stage' and 'LI' is used as the DOM elements for 'owl-item'

= 2.3.7 =
* Added the option to bulk delete slides within the 'Re-Order Slides' page

= 2.3.6 =
* Added the 'Show 1 Dot Per Slide' checkbox option which when checked displays 1 pagination dot per slide (instead of 1 pagination dot per page of slides)

= 2.3.5 =
* Added the 'Re-Order Slides' sub-page, which allows one to easily change the order of slides within a Slide Anything slider with a 'drag-and-drop' interface

= 2.3.4 =
* Added a 'Duplicate Slider' facility so that sliders created can be duplicated or backed-up

= 2.3.3 =
* Added Slide Any Post promotional meta box & fixed a couple backend aesthetic issues

= 2.3.2 =
* Bug Fix: Fixed 'undefined index' error that sometimes occurs on the WordPress backend when saving Showcase Carousel fields

= 2.3.1 =
* Bug Fix: Fixed issue with 'Autohide Arrows' not working properly with Showcase Carousels

= 2.3.0 =
* Remove HTML elements (HTML, DOCTYPE & BODY tags) from front-end code generated when the 'Lazy Load Images' or 'Remove JavaScript Content' options are selected for a slider

= 2.2.9 =
* Removed the change added in version 2.2.8 (so reverted back to version 2.2.7)

= 2.2.8 =
* Bug Fix: Omit DOCTYPE from HTML front-end code generated.

= 2.2.7 =
* Added Showcase Carousel support, which is a new Slide Anything PRO feature.

= 2.2.6 =
* Bug Fix - Fixed the PHP Warning "explode() expects parameter 2 to be string, array given in wp-content\plugins\slide-anything\php\slide-anything-admin.php on line 824" some users were experiencing.

= 2.2.5 =
* Bug Fix - Optimise front-end code so that no 'background' CSS rules are displayed if the user does not specify a background image/colour for the slide.

= 2.2.4 =
* Bug Fix - Do not display the PRO upgrade notice within the WordPress Dashboard if you have already upgraded to the PRO version.

= 2.2.3 =
* Bug Fix - Resolved small non-fatal issue to remove "Notice: Undefined index: ../php/slide-anything-frontend.php on line 66" message.

= 2.2.2 =
* Bug Fix - Issue with "Thumbnail Pagination" data being saved on 'Non-PRO' installations - causing a fatal error.

= 2.2.1 =
* Bug Fix - Issue with "Lazy Load Images" feature, and when enabled UTF-8 encoding was broken. Resolved.

= 2.2 =
* Added Hero Slider and Thumbnail Pagination support, which are Slide Anything PRO features.

= 2.1.21 =
* Replace the 'Load JavaScript during window.onload event' option with a 'Load JavaScript during DOMContentLoaded event' option, which is a much better solution.

= 2.1.20 =
* Bug Fix - Fixed an issue where the Slide Anything JavaScript code was not being generated with certain newer themes.

= 2.1.19 =
* Small enhancement - The Slide Anything container is now set to hidden (visibility:hidden) until all the slides have been displayed and owl-carousel JavaScript code executed, then the SA container is set to visible (visibility:visible). This presents a cleaner page loading experience without the individual slide containers (DIVS) sometimes being displayed (even for a fraction of a second) prior to slider initialisation.

= 2.1.18 =
* Bug Fix - There was an issue on mobile phones when autoplay is disabled, and when you swipe to change current slide then autoplay starts up. This has now been fixed.

= 2.1.17 =
* Added a new feature to facilitate owl-carousel 'Lazy Load' images. With this feature enabled, slide images (<img> tags) are only loaded when the relevant slides are displayed (all of the slider's images are NOT loaded up-front).

= 2.1.16 =
* Small bug fix that relates to Slide Anything PRO only: Sliders with 'autoplay' enabled were re-starting autoplay when popups were closed.

= 2.1.15 =
* Upgraded to the latest version of Owl Carousel (version 2.3.4). Set the 'Mouse Drag' option to disabled by default. Mouse dragging when enabled affects vertical touch-drag scrolling on mobile devices.

= 2.1.14 =
* Bug fix - Fixed a small bug with the "Remove JavaScript Content" feature.

= 2.1.13 =
* Bug fix - An array initialisation was causing a crash on hosts using a PHP version prior to 5.4. Changed this array initialisation to now be backwards compatible.

= 2.1.12 =
* Added the new feature (checkbox) 'Remove JavaScript Content'. When checked, JavaScript content (<script> tags) are removed from slide content.

= 2.1.11 =
* Fixed a bug that occurred when migrating a WP site to another domain location (e.g. transferring a staging/test WP site to a Live WP site). The SA slider would not work on the new domain unless it was re-saved in the back-end. This has now been fixed with this release.

= 2.1.10 =
* Minor bug fix for the new 'Use window.onload event' checkbox setting.

= 2.1.9 =
* Added a new 'Use window.onload event' checkbox setting. By default, Slide Anything loads it JavaSctipt/jQuery code during the 'document.ready' event. If this new option is checked, then the JavaSctipt/jQuery code is loaded during the 'window.onload' event, and this event is only executed after all the assets for the page have been loaded - all images, CSS etc. Using this option solves an issue that sometimes occurs when inserting a Slide Anything slider into a Visual Composer full-width section, and these full-width containers are created/calculated dynamically by adding negative left/right margins to the container after the SA JavaScript/jQuery code is executed.

= 2.1.8 =
* Added the Slide By 'page' option, which is set by setting the 'Slide By' slider input to 0.
* For Slide Anything PRO YouTube video popups, added the 'rel=0' paramerter so that related videos are not displayed at the end of a video playback. This has been requested quite a bit, and I have modified the 'Magnific Popup' code so that this parameter is added to the iframe code generated.

= 2.1.7 =
* Minor bug fix with new 'Auto Height' feature

= 2.1.6 =
* Added a new 'Auto Height' feature, which automatically resizes the height of the slider according to the current slide's height.

= 2.1.5 =
* Bug Fix - Issue with using shortcodes within slides. Certain shortcodes can only be displayed on the front-end (i.e. required resources are only loaded on the front-end), so the 'Preview Slider' feature on the Edit Slider page was causing issues for these shortcodes. So I have displayed this 'Preview Slider' feature for sliders where the 'Allow Shortcodes' checkbox is checked.

= 2.1.4 =
* Upgraded Owl Carousel from version 2.3 BETA to version 2.3.3 (production release)

= 2.1.3 =
* Minor bug fix with Slide Anything PRO Software Licensing integration

= 2.1.2 =
* Added a new feature to allow you to set slider minimum height in pixels
* Added a new feature so that each slide within a slider has its own unique CSS ID

= 2.1.1 =
* Bug Fix - Owl Carousel changed the CSS Style used for slide images in version 2.3. Changed the CSS style for images back to what was used in version 2.2.1 of Owl Carousel, so that sliders already created on sites continue to look the same.

= 2.1.0 =
* Replaced 'Owl Carousel 2.2.1' with 'Owl Carousel 2.3 BETA'.
* Upgrading Owl Carousel fixes an issue with Slide Anything that has been reported to me on numerous occasions - namely if you switch TABS within your browser, switch to another application, or minimise your browser window, then the Slider/Carousel stops (i.e. no more transitions), and the page needs to be reloaded to 'restart' the slider.
* Although a BETA, version 2.3 seems pretty stable, and OC has been sitting at version 2.1.1 for over a year now.

= 2.0.18 =
* Minor Bug Fix

= 2.0.17 =
* Added a new 'Slide By' setting to set the number of slides to slide per transition

= 2.0.16 =
* Bug Fix: Modified WP Dashboard PHP code so that only a Slider 'CSS ID' containing letters (upper/lowercase) or Underscore '_' characters will be accepted. Using Dashes '-' within the CSS ID would cause a Javascript error.

= 2.0.15 =
* Modified plugin so that WordPress users with an 'Editor' role can save/update sliders

= 2.0.14 =
* Fix for using shortcodes inside of anything that already hooks into 'the_content'

= 2.0.13 =
* Bug Fix - Fixed a clash with the 'Envira Gallery' plugin

= 2.0.12 =
* Bug Fix - Changed the location where the jQuery script is enqueued

= 2.0.11 =
* Bug Fix - Before generating Slide Anything JavaScript code, check if jQuery has been loaded loaded. If not, then 'Enqueue' jQuery script

= 2.0.10 =
* Minor Bug Fix

= 2.0.9 =
* Added new 'Reverse Order' Checkbox to backend editor, which reverses the order of the slides created
* Added a 'Preview Slider' button to the backend editor - when clicked a popup modal is displayed containing a preview of the Slide Anything Slider

= 2.0.8 =
* Minor bug fix

= 2.0.7 =
* Removed Owl Carousel 2.0 URL Hash Navigation feature

= 2.0.6 =
* Increase number of slides allowed from 50 to 99.
* Added Owl Carousel 2.0 URL Hash Navigation feature
* Minor bug fixes

= 2.0.5 =
* Fixed bug with slide 'min-height' percentage calculation.
* Changed Slide Anything Javascript loading to now load using '$(document).ready' instead of '$(window).load'.

= 2.0.4 =
* Fixed CSS bug with slide images (IMG tags) being resized to 100% of slide width.

= 2.0.3 =
* Removed array dereferencing from PHP code, which causes a fatal error on web hosts using a PHP version prior to version 5.4.

= 2.0.2 =
* Some small 'post version 2' bug fixes.

= 2.0.1 =
* Some required CSS files were missing from the WordPress repository and therefore ZIP download. Quick patch to rectify this.

= 2.0 =
* Rebuilt Slide Anything using Owl Carousel version 2.

= 1.6.2 =
* Bug Fix: Fixed minor issue with IE 10 and IE 11 - the 'fade' and 'fade up' transition effects were not working.

= 1.6.1 =
* Bug Fix: Fixed minor issue when editing slide content within the WordPress Dashboard using the Text Editor. If HTML tags are not properly closed, then this was causing an issue - added the WordPress 'balanceTags()' function to correct this issue.

= 1.6 =
* Added `Slide Transition` setting to set the transition of 1-Items Sliders to a 'fade', 'backSlide', 'goDown' or 'fadeUp' transition effect
* Added checkboxes to enable/disable `mouseDrag` and `touchDrag` carousel settings
* Some small bug fixes

= 1.5 =
* Bug Fix: Fixed issue with some HTML elements/attributes being stripped out when certain shortcodes are used within slide content - found an alternative to KSES sanitization for slide content.
* Added a new dropdown option 'Background Position' for the slide background of each slide

= 1.4 =
* Bug Fix: Added `Allow Shortcodes` setting. Running shortcodes within `Slide Anything` may cause issues with some Wordpress Page Builders, and disable this setting will resolve this issue if it occurs.
* Added a new `Items Displayed` setting to set the number of slides to be displayed on screen resolutions over 1400 pixels
* Added a new `Autohide Arrows` setting to enable/displayed the autohide feature for slider navigation arrows

= 1.3 =
* Added setting to add a margin left and right of each slide

= 1.2 =
* Added a button to the visual editor on pages and posts which displays a list of all sliders you have created, allow you to select a slider and the corresponding shortcode is automatically inserted into your page or post.
* Added the 'Random Order' checkbox to the edit slider page, and when checked slides will be randomly re-ordered whenever the slider is displayed
* Fixed issue with the 'delete plugin' function, which was crashing

= 1.1 =
* Added a slider preview feature to the slider edit page - pressing the 'Preview' button displays the slider within a popup window.

= 1.0 =
* Initial release of this plugin.

== Upgrade Notice ==

= 1.0 =
* Initial release of this plugin.

= 1.1 =
* Preview sliders created within the WordPress Dashboard.

= 1.2 =
* Added button to visual editor in pages/popsts to automatically insert slider shortcode
* Added 'Random Order' option to randomly display slides for sliders

= 1.3 =
* Added setting to add a margin left and right of each slide

= 1.4 =
* Bug Fix: Added `Allow Shortcodes` setting. Running shortcodes within `Slide Anything` may cause issues with some Wordpress Page Builders, and disable this setting will resolve this issue if it occurs.
* Added a new `Items Displayed` setting to set the number of slides to be displayed on screen resolutions over 1400 pixels
* Added a new `Autohide Arrows` setting to enable/displayed the autohide feature for slider navigation arrows

= 1.5 =
* Bug Fix: Fixed issue with some HTML elements/attributes being stripped out when certain shortcodes are used within slide content - found an alternative to KSES sanitization for slide content.
* Added a new dropdown option 'Background Position' for the slide background of each slide

= 1.6 =
* Added `Slide Transition` setting to set the transition of 1-Items Sliders to a 'fade', 'backSlide', 'goDown' or 'fadeUp' transition effect
* Added checkboxes to enable/disable `mouseDrag` and `touchDrag` carousel settings
* Some small bug fixes

= 1.6.1 =
* Bug Fix: Fixed minor issue when editing slide content within the WordPress Dashboard using the Text Editor. If HTML tags are not properly closed, then this was causing an issue - added the WordPress 'balanceTags()' function to correct this issue.

= 1.6.2 =
* Bug Fix: Fixed minor issue with IE 10 and IE 11 - the 'fade' and 'fade up' transition effects were not working.

= 2.0 =
* Rebuilt Slide Anything using Owl Carousel version 2.

= 2.0.1 =
* Some required CSS files were missing from the WordPress repository and therefore ZIP download. Quick patch to rectify this.

= 2.0.2 =
* Some small 'post version 2' bug fixes.

= 2.0.3 =
* Removed array dereferencing from PHP code, which causes a fatal error on web hosts using a PHP version prior to version 5.4.

= 2.0.4 =
* Fixed CSS bug with slide images (IMG tags) being resized to 100% of slide width.

= 2.0.5 =
* Fixed bug with slide 'min-height' percentage calculation.
* Changed Slide Anything Javascript loading to now load using '$(document).ready' instead of '$(window).load'.

= 2.0.6 =
* Increase number of slides allowed from 50 to 99.
* Added Owl Carousel 2.0 URL Hash Navigation feature
* Minor bug fixes

= 2.0.7 =
* Removed Owl Carousel 2.0 URL Hash Navigation feature

= 2.0.8 =
* Minor bug fix

= 2.0.9 =
* Added new 'Reverse Order' Checkbox to backend editor, which reverses the order of the slides created
* Added a 'Preview Slider' button to the backend editor - when clicked a popup modal is displayed containing a preview of the Slide Anything Slider

= 2.0.10 =
* Minor Bug Fix

= 2.0.11 =
* Bug Fix - Before generating Slide Anything JavaScript code, check if jQuery has been loaded loaded. If not, then 'Enqueue' jQuery script

= 2.0.12 =
* Bug Fix - Changed the location where the jQuery script is enqueued

= 2.0.13 =
* Bug Fix - Fixed a clash with the 'Envira Gallery' plugin

= 2.0.14 =
* Fix for using shortcodes inside of anything that already hooks into 'the_content'

= 2.0.15 =
* Modified plugin so that WordPress users with an 'Editor' role can save/update sliders

= 2.0.16 =
* Bug Fix: Modified WP Dashboard PHP code so that only a Slider 'CSS ID' containing letters (upper/lowercase) or Underscore '_' characters will be accepted. Using Dashes '-' within the CSS ID would cause a Javascript error.

= 2.0.17 =
* Added a new 'Slide By' setting to set the number of slides to slide per transition

= 2.0.18 =
* Minor Bug Fix

= 2.1.0 =
* Replaced 'Owl Carousel 2.2.1' with 'Owl Carousel 2.3 BETA'.
* Upgrading Owl Carousel fixes an issue with Slide Anything that has been reported to me on numerous occasions - namely if you switch TABS within your browser, switch to another application, or minimise your browser window, then the Slider/Carousel stops (i.e. no more transitions), and the page needs to be reloaded to 'restart' the slider.
* Although a BETA, version 2.3 seems pretty stable, and OC has been sitting at version 2.1.1 for over a year now.

= 2.1.1 =
* Bug Fix - Owl Carousel changed the CSS Style used for slide images in version 2.3. Changed the CSS style for images back to what was used in version 2.2.1 of Owl Carousel, so that sliders already created on sites continue to look the same.

= 2.1.2 =
* Added a new feature to allow you to set slider minimum height in pixels
* Added a new feature so that each slide within a slider has its own unique CSS ID

= 2.1.3 =
* Minor bug fix with Slide Anything PRO Software Licensing integration

= 2.1.4 =
* Upgraded Owl Carousel from version 2.3 BETA to version 2.3.3 (production release)

= 2.1.5 =
* Bug Fix - Issue with using shortcodes within slides. Certain shortcodes can only be displayed on the front-end (i.e. required resources are only loaded on the front-end), so the 'Preview Slider' feature on the Edit Slider page was causing issues for these shortcodes. So I have displayed this 'Preview Slider' feature for sliders where the 'Allow Shortcodes' checkbox is checked.

= 2.1.6 =
* Added a new 'Auto Height' feature, which automatically resizes the height of the slider according to the current slide's height.

= 2.1.7 =
* Minor bug fix with new 'Auto Height' feature

= 2.1.8 =
* Added the Slide By 'page' option, which is set by setting the 'Slide By' slider input to 0.
* For Slide Anything PRO YouTube video popups, added the 'rel=0' paramerter so that related videos are not displayed at the end of a video playback. This has been requested quite a bit, and I have modified the 'Magnific Popup' code so that this parameter is added to the iframe code generated.

= 2.1.9 =
* Added a new 'Use window.onload event' checkbox setting. By default, Slide Anything loads it JavaSctipt/jQuery code during the 'document.ready' event. If this new option is checked, then the JavaSctipt/jQuery code is loaded during the 'window.onload' event, and this event is only executed after all the assets for the page have been loaded - all images, CSS etc. Using this option solves an issue that sometimes occurs when inserting a Slide Anything slider into a Visual Composer full-width section, and these full-width containers are created/calculated dynamically by adding negative left/right margins to the container after the SA JavaScript/jQuery code is executed.

= 2.1.10 =
* Minor bug fix for the new 'Use window.onload event' checkbox setting.

= 2.1.11 =
* Fixed a bug that occurred when migrating a WP site to another domain location (e.g. transferring a staging/test WP site to a Live WP site). The SA slider would not work on the new domain unless it was re-saved in the back-end. This has now been fixed with this release. 

= 2.1.12 =
* Added the new feature (checkbox) 'Remove JavaScript Content'. When checked, JavaScript content (<script> tags) are removed from slide content.

= 2.1.13 =
* Bug fix - An array initialisation was causing a crash on hosts using a PHP version prior to 5.4. Changed this array initialisation to now be backwards compatible.

= 2.1.14 =
* Bug fix - Fixed a small bug with the "Remove JavaScript Content" feature.

= 2.1.15 =
* Upgraded to the latest version of Owl Carousel (version 2.3.4). Set the 'Mouse Drag' option to disabled by default. Mouse dragging when enabled affects vertical touch-drag scrolling on mobile devices.

= 2.1.16 =
* Small bug fix that relates to Slide Anything PRO only: Sliders with 'autoplay' enabled were re-starting autoplay when popups were closed.

= 2.1.17 =
* Added a new feature to facilitate owl-carousel 'Lazy Load' images. With this feature enabled, slide images (<img> tags) are only loaded when the relevant slides are displayed (all of the slider's images are NOT loaded up-front).

= 2.1.18 =
* Bug Fix - There was an issue on mobile phones when autoplay is disabled, and when you swipe to change current slide then autoplay starts up. This has now been fixed.

= 2.1.19 =
* Small enhancement - The Slide Anything container is now set to hidden (visibility:hidden) until all the slides have been displayed and owl-carousel JavaScript code executed, then the SA container is set to visible (visibility:visible). This presents a cleaner page loading experience without the individual slide containers (DIVS) sometimes being displayed (even for a fraction of a second) prior to slider initialisation.

= 2.1.20 =
* Bug Fix - Fixed an issue where the Slide Anything JavaScript code was not being generated with certain newer themes.

= 2.1.21 =
* Replace the 'Load JavaScript during window.onload event' option with a 'Load JavaScript during DOMContentLoaded event' option, which is a much better solution.

= 2.2 =
* Added Hero Slider and Thumbnail Pagination support, which are Slide Anything PRO features.

= 2.2.1 =
* Bug Fix - Issue with "Lazy Load Images" feature, and when enabled UTF-8 encoding was broken. Resolved.

= 2.2.2 =
* Bug Fix - Issue with "Thumbnail Pagination" data being saved on 'Non-PRO' installations - causing a fatal error.

= 2.2.3 =
* Bug Fix - Resolved small non-fatal issue to remove "Notice: Undefined index: ../php/slide-anything-frontend.php on line 66" message.

= 2.2.4 =
* Bug Fix - Do not display the PRO upgrade notice within the WordPress Dashboard if you have already upgraded to the PRO version.

= 2.2.5 =
* Bug Fix - Optimise front-end code so that no 'background' CSS rules are displayed if the user does not specify a background image/colour for the slide.

= 2.2.6 =
* Bug Fix - Fixed the PHP Warning "explode() expects parameter 2 to be string, array given in wp-content\plugins\slide-anything\php\slide-anything-admin.php on line 824" some users were experiencing.

= 2.2.7 =
* Added Showcase Carousel support, which is a new Slide Anything PRO feature.

= 2.2.8 =
* Bug Fix: Omit DOCTYPE from HTML front-end code generated.

= 2.2.9 =
* Removed the change added in version 2.2.8 (so reverted back to version 2.2.7) 

= 2.3.0 =
* Remove HTML elements (HTML, DOCTYPE & BODY tags) from front-end code generated when the 'Lazy Load Images' or 'Remove JavaScript Content' options are selected for a slider

= 2.3.1 =
* Bug Fix: Fixed issue with 'Autohide Arrows' not working properly with Showcase Carousels

= 2.3.2 =
* Bug Fix: Fixed 'undefined index' error that sometimes occurs on the WordPress backend when saving Showcase Carousel fields

= 2.3.3 =
* Added Slide Any Post promotional meta box & fixed a couple backend aesthetic issues

= 2.3.4 =
* Added a 'Duplicate Slider' facility so that sliders created can be duplicated or backed-up

= 2.3.5 =
* Added the 'Re-Order Slides' sub-page, which allows one to easily change the order of slides within a Slide Anything slider with a 'drag-and-drop' interface

= 2.3.6 =
* Added the 'Show 1 Dot Per Slide' checkbox option which when checked displays 1 pagination dot per slide (instead of 1 pagination dot per page of slides)

= 2.3.7 =
* Added the option to bulk delete slides within the 'Re-Order Slides' page

= 2.3.8 =
* Added the 'Use UL and LI Containers' checkbox which when checked, 'UL' is used as the DOM element for 'owl-stage' and 'LI' is used as the DOM elements for 'owl-item'

= 2.3.9 =
* CSS Style changes for some of the WordPress Dashboard input elements (in response to to the WordPress 5.3 update which changed some default Dashboard styling)

= 2.3.10 =
* Revamped the 'Preview Slider' feature, so that the preview popup container loads the front-end theme's javascript and css style files

= 2.3.11 =
* Couple of small bug fixes: Undefined index error for 'popup_shortcode' vairables and hide "SA PRO' advert for non-admin users.

= 2.3.12 =
* Added a new feature (checkbox) to vertically center content within slides.

= 2.3.13 =
* Minor bug fix: PHP 'Undefined Index' warnings were sometimes displayed after upgrading to Slide Anything PRO (and the slider was created using the Slide Anything FREE plugin)

= 2.3.14 =
* YouTube popups now set the slide background to the YouTube thumbnail by default

= 2.3.15 =
* Added 'Click to Advance' feature which when enabled allows users to click on the slider to advance it one slide

= 2.3.16 =
* Small Bug Fix: Using the Slide Anything shortcode with an incorrect ID sometimes did not display an error message - this has been resolved

= 2.3.17 =
* Small Bug Fix: Click to Advance feature was not working properly with multiple sliders on the page

= 2.3.18 =
* Call the JavaScript 'window resize' event when the Owl Carousel 'initialized' event is executed - this resolves an issue some uses have been experiencing with slides not being sized correctly after page load

= 2.3.19 =
* Fixed an issue with the slider arrows that occurs when multiple Showcase Carousels (SA PRO) are displayed on a page.

= 2.3.20 =
* Added a new feature 'Slide Goto Links', which allows the creation of links (or buttons) that when clicked will go to a specific slide within your slider.

= 2.3.21 =
* Small Bug Fix to remove PHP Notice (warnings) within 'slide-anything-admin.php' for possible undefined indexs for 'popup_type', 'popup_video_type' and 'popup_video_id'

= 2.3.22 =
* Small Bug Fix to fix a clash with the 'Woody Snippets' plugin within the WordPress Dashboard

= 2.3.23 =
* Small Bug Fix: The Re-Order slides page was displaying a PHP warning notice on sites with PHP 7.4.

= 2.3.24 =
* Small Bug Fix to fix a conflict with the 'Photonic Gallery & Lightbox' plugin. The slide 'Add Media' button was not working when this plugin is installed.

= 2.3.25 =
* Small Bug Fix: If the 'lazy load images' option was enabled and a slide content was blank then a PHP warning message was being displayed.

= 2.3.26 =
* When thumbnail pagination and popup options are used together (PRO version only) there was an issue - the popup images or popup YouTube video thumbs were not be used to set the thumbnail images.

= 2.3.27 =
* Adding a new Slide Anything global setting which appears under 'Settings->Writing' within the WordPress Dashbaord. This is a checkbox setting called 'Disable TinyMCE Button', and when checked the 'Slide Anything Sliders' button within the toolbar of the WordPress Classic Editor when editing pages and posts will be disabled. This TinyMCE button is causing issues on some sites, and adding the facility to turn off this button resolves this issue.

= 2.3.28 =
* 2 small fixes. Added transparent (invisible) 'Previous' and 'Next' text to the Previous & Next arrow buttons so that accessibility errors are no longer generated with accessibility evaluation tools. Do not use the 'window.dispatchEvent' function call on IE11 browsers when executing a 'resize' event.

= 2.3.29 =
* Added 2 new features. The 'Right to Left Slider' feature changes the direction of the slider to be right to left. The 'Disable Preview Feature' disables the 'Preview Slider' button within the SA slider settings page and also disables the auto-generation of the 'Slide Anything Popup Preview' WordPress page.

= 2.3.30 =
* Added a new feture to set the 'Starting Slide Number' for a slider. This sets the Owl Carousel 'startPosition' option to set the slide number to display first within the list of slides created for a slider.

= 2.3.31 =
* Added a new feture to allow you to specify the WordPress image size to use for slide background images. Previously slide background images were all set the the "full" WordPress image size.

= 2.3.32 =
* Changed the order of the items displayed within the 'Changelog' so that the most recent changes are displayed at the top of the list.

= 2.3.33 =
* An issue exists with Slide Anything within the WP Dashboard when the Yoast SEO plugin is installed, and when previously created created sliders are edited the slide content previously created dissapears. After some investigation I discovered that Yoast SEO is clashing somehow with the 'Preview Slider' feature which opens a Popup Preview of the slider within the WP Dashboard Edit Slider page. So as a workaround/solution I detect whether Yoast SEO is installed and then disable the 'Preview Slider' functionality if Yoast SEO is installed on the site.
