=== Olsen Light ===
Theme Name: Olsen Light
Theme URI: https://www.cssigniter.com/themes/olsen-light/
Author URI: https://www.cssigniter.com/
Author: The CSSIgniter Team
Contributors: cssigniterteam
Stable tag: 1.7.0
Requires PHP: 5.6
Requires at least: 5.2
Tested up to: 5.8.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Olsen Light is a clean, minimal, stylish and elegant WordPress blog theme, perfect for lifestyle, food, cooking, fashion, travel, wedding, health & fitness, photography and beauty blogging. Ideal for personal or multi-author blogs. Well documented and supported, very flexible and easy to use from beginners and experienced users alike. Its responsive design will give your visitors the perfect mobile browsing experience on phones, tablets & retina enabled displays. It is fast and lightweight, coded with best SEO practises in mind, supports RTL languages and is translation ready. It supports single and two column blog layouts, customizable excerpts, custom logos, a homepage slider, social icons and social sharing, a footer Instagram carousel, custom widgets and more. It supports the WordPress block editor and is also compatible with the most popular page builders like Elementor, Divi, Brizy and Beaver Builder.

Theme page: https://www.cssigniter.com/themes/olsen-light/
Demo: https://www.cssigniter.com/preview/olsenlight/

Olsen Light WordPress Theme, Copyright 2015-2021 CSSIgniter LLC
Olsen Light is distributed under the GNU General Public License, version 2

== Installation ==

1. In your dashboard, go to *Appearance > Themes* and click the *Add New* button.
2. Click *Upload Theme* and then click *Browse... / Choose File...*.
3. Select the theme's .zip file. Then click *Install Now*.
3. Click Activate to use your new theme right away.

== Documentation ==

Please visit https://www.cssigniter.com/docs/olsen-light/

== Frequently Asked Questions ==

= I have a problem. Where can I get support? =
We are providing support for this theme, via the WordPress Theme forums at https://wordpress.org/support/theme/olsen-light

== License Information ==

Olsen Light WordPress Theme, Copyright 2015-2019 CSSIgniter LLC
Olsen Light is distributed under the terms of the GNU GPL v2

Olsen Light WordPress Theme incorporates code from Bootstrap, Copyright 2011-2105 Twitter, Inc - http://getbootstrap.com/
Bootstrap is distributed under the terms of The MIT License (MIT) - https://github.com/twbs/bootstrap/blob/master/LICENSE

All theme files (unless otherwise stated) are distributed under the GNU General Public License v2 (GPLv2)

The following assets / components (GPL or GPL compatible) are used:

* simplelightbox v2.7.0 - https://github.com/andreknieriem/simplelightbox
	Copyright 2020 Andre Rinas
	Released under the MIT license - http://opensource.org/licenses/MIT
* Tiny Slider 2 v2.9.3 - https://github.com/ganlanyuan/tiny-slider
	Copyright 2020 William Lin
	Released under the MIT license - http://opensource.org/licenses/MIT
* normalize.css v8.0.1 - https://github.com/necolas/normalize.css/
	Copyright Nicolas Gallagher, Jonathan Neal
	Released under the MIT license - http://opensource.org/licenses/MIT


== Changelog ==

= 1.7.0 =
* Updated headings Typography sizes
* Removed styles for Flicker & Twitter widgets and unnecessary letter spacings.
* Main nav, footer, and top bars now use flex instead of floats.
* Added a link to the theme's documentation explaining the top bar toggle functionality.
* Asset loading performance improvements.
* Fixed an issue where an empty pagination container would be output if the blog had a single post.
* Replaced menu search with pop up version.
* Added rel noopener to social links when they open in a new window
* Replaced Font Awesome with Olsen Icons
* Added TikTok to social icon options
* Improved RTL styles

= 1.6.2 =
* Fixed onboarding link not working due to changes on One Click Demo Import v3.0.0.

= 1.6.1 =
* Fixed an issue where the mobile menu would break in some cases.
* Optimized the delivery of some assets.

= 1.6.0 =
* Replaced Slick Slider with Tiny Slider olsen-light-slick handle has been replaced with tiny-slider.
* Replaced magnific popup with simplelightbox olsen-light-magnific handle has been replaced with simple-lightbox.
* Replaced superfish with CSS solution the olsen-light-superfish handle has been removed.
* Rewrote mobile menu to use vanilla JavaScript.

= 1.5.2 =
* Main page titles are now H1 instead of H2. Widgets' post titles are now H4.

= 1.5.1 =
* Fixed issue where the logo upload options would not appear.

= 1.5.0 =
* Fixed issue where posts would overlap on mobile devices when Two Columns - Sidebar layout was selected.
* Grid is now based on bootstrap 4
* Cleaned up functions.php
* Restructured Customizer folder.
* Replaced mmenu with custom mobile menu solution
* Replaced FitVids.js with CSS based solution for responsive embeds.
* Moved all 3rd party assets to the vendor folder.
* Renamed olsen-customizer script handle to olsen-customizer-scripts

= 1.4 =
* Added Skip link to main content.
* Added onboarding page, accessible via Appearance > About Olsen Light.
* Removed direct links to sample content.

= 1.3.2 =
* Added: Replaced logo h1 with div and single title h2 with h1.
* Removed backward compatibility for wp_body_open().

= 1.3.1 =
* Added: Call to wp_body_open() (since WP v5.2) with backward compatibility for earlier versions.
* Removed: Google+ Social Icon.
* Added: Telegram and Trip Advisor Social Icons.
* Removed: One Click Demo Import no longer supports automatic loading of sample content files, as required by the Theme Review Team. https://themes.trac.wordpress.org/ticket/67686

= 1.3.0 =
* Added: Top Bar to display menu and social icons.
* Added: Search bar in main menu bar.
* Replaced: Google Plus sharing button with LinkedIn sharing button.

= 1.2.3 =
* Fixed: Metaboxes bound to specific post formats (if any), wouldn't appear on initial page load inside the new block editor.
* Improved: Styles for Mailchimp Widget Plugin.
* Improved: Front page carousel arrows position.
* Fixed: GDPR Consent checkbox.
* Fixed: Read more button padding.
* Added: .opening class in TinyMCE Format Dropdown.
* Added: First letter style in .opening

= 1.2.2 =
* Added: Styles for Gutenberg.
* Fixed: Page template-bound metaboxes, wouldn't behave correctly in Gutenberg mode (where applicable).
* Fixed: Post format-bound metaboxes (where applicable) now work properly with Gutenberg.
* Fixed: Admin notice regarding the sample content, wouldn't persist its state when dismissed from within the block editor.

= 1.2.1 =
* Added RTL support.

= 1.2 =
* Added site wide social icons.
* Added related posts to classic blog listing.
* Added lang file header so that Poedit will recognise "translators:" comments.
* Fixed olsen_light_lightbox_rel() would throw a warning when creating a new post.

= 1.1 =
* Updated Font Awesome to v4.7.0
* Fixed an issue where the logo padding bottom wouldn’t get applied if a respective top padding wasn’t defined.
* Proper escaping of search for attributes.
* Added second blog layout.
* Added home slider.
* Moved olsen_light_get_social_networks() into /functions.php

= 1.0.3 =
* Updated Font Awesome to v4.6.3
* Sample content URL is now filterable through the 'olsen_light_sample_content_url' filter.
* Added page builder template.

= 1.0.2 =
* Fixed "Creating object from empty value" warning on customizer when there are no pages.
* Improved footer message wording and sanitization. It is now entirely translatable/changeable via language files.
* Added option to make social buttons and sharing links open in a new tab.
* Added customizer option to display content or excerpt (default: content).

= 1.0.1 =
* Removed Newsletter widget. Same effect can be achieved by wrapping your newsletter form in a <div class="widget_ci_newsletter">Your code here</div> element.

= 1.0 =
* Initial release
