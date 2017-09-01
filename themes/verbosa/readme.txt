=============
Verbosa WordPress Theme
Copyright 2015-2016 Cryout Creations

Author: Cryout Creations
Requires at least: 4.2
Tested up to: 4.5.3
Stable tag: 0.9.6
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Donate link: http://www.cryoutcreations.eu/donate/

Are you a writer? Or maybe a photographer? An artist? Perhaps you do online reviews? Or are you just casually blogging about music, movies and such? Do you like to ramble on? Are you a creator? Do you generate content of any kind? Are we asking too many questions? Is this too much? Have we crossed the line?

Well then you should give Verbosa a try as she may have all the tools needed to assist you and your creativity. Verbosa is all about elegant typography, efficient use of contrast, spacing and simplicity. We used all the tricks at our disposal to improve legibility, create emphasis and generate a proper design flow that would make your content more inviting to be read.

Verbosa is also truly responsive, with a fluid layout, uses microformats and microdata for best SEO results, takes great advantage of featured images, supports Google fonts, has social menus with over 100 social icons, is translation ready and RTL. And everything's editable via the customizer with over 100 options! And as an extra, we've coded in a fresh and exquisite perfume that will follow you everywhere once you install the theme!


== License ==

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see http://www.gnu.org/copyleft/gpl.html


== Third Party Resources ==

Verbosa WordPress Theme bundles the following third-party resources:

HTML5Shiv, Copyright Alexander Farkas (aFarkas)
Dual licensed under the terms of the GPL v2 and MIT licenses
Source: https://github.com/aFarkas/html5shiv/

FitVids, Copyright Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
Licensed under the terms of the WTFPLlicense
Source: http://fitvidsjs.com/

== Bundled Fonts ==

IcoMoon-Free, Copyright Keyamoon
Licensed under the terms of the GPL license
Source: https://github.com/Keyamoon/IcoMoon-Free

Zocial CSS social buttons, Copyright Sam Collins
Licensed under the terms of the MIT license
Source: https://github.com/smcllns/css-social-buttons

== Bundled Images ==

The following bundled images are released into the public domain under Creative Commons CC0:
https://pixabay.com/en/leave-typewriter-old-mechanically-705747/
https://pixabay.com/en/young-woman-girl-lady-female-work-791849/
https://pixabay.com/en/home-office-workstation-office-336378/

The images used in the screenshot are also released into the public domain under Creative Commons CC0:
https://pixabay.com/en/library-book-reading-computers-488677/
https://pixabay.com/en/typewriter-book-notebook-paper-801921/
https://pixabay.com/en/knowledge-book-library-glasses-1052010/
https://pixabay.com/en/leaves-books-color-coffee-cup-1076307/

The rest of the bundled images are created by Cryout Creations and released with the theme under GPLv3


== Changelog ==

= 0.9.6 =
* Updated Cryout Framework to 0.5.7
* Restored proper order of theme panels/sections in the Customizer
* Renamed 'Graphics' customizer section to 'General'
* Relocated 'Socials' panel under 'General' and 'Custom Footer Text' under 'General' > 'Structure'
* Added load/save settings functionality
* Updated admin URLs
* Added site title as alt text for the WP logo
* Moved microdata function to framework
* Adjusted default content width to 1024px
* Switched to using proper textdomain function for the framework translations
* Added base font name to Google fonts enqueue (when custom weights are used)
* Fixed typo in Amazon social icon URL
* Updated mobile menu background color to use the sidebar background color setting
* Removed input[type="file"] styling
* Updated searchform.php to use labels (accessibility)
* Fixed search aspect on Safari
* Fixed Adsense issues
* Removed unused /resources/patterns folder

= 0.9.5 =
* Updated theme URL in style.css
* Updated feed URL
* Updated theme URL in footer
* Fixed "aside" post format icon layout

= 0.9.4 =
* Removed "Category page with intro" template

= 0.9.3 =
* Made all text in About Verbosa page translatable
* Removed default copyright text
* Removed front-page-post-form and food-and-drink style.css theme tags
* Removed inline CSS from verbosa_master_footer()

= 0.9.2 =
* Removed verbosa_socials_menu_preset() function
* Restored default customizer Colors section
* Removed constant from translation string (Customizer > About Verbosa)
* Added text from verbosa_master_footer() and Verbosa Page links to translation
* Replaced "get_category(get_query_var('cat')" with core "get_queried_ojbect"
* Removed HTML5Shiv from header.php
* Escaped all outputs in custom controls from customizer.php
* Escaped all URLs in theme with esc_url()
* Escaped get_bloginfo( 'name' ) and get_bloginfo( 'description' )
* Escaped all theme options output
* Updated verbosa.pot

= 0.9.1 =
* Fixed widget titles line not spanning all sidebar
* Added auto-detection of RSS link in social icons
* Added margin botton for multi-line socials menu
* Fixed mobile menu out of frame on narrow screen (<400px), horizontal scroll on chrome, removed .noscroll position:fixed
* Improved mobile menu animations
* Fixed colophon flex compatibility with IE9
* Removed template-blog.php page template, license.txt, bundled masonry.js
* Improved arhive.php to handle archives, categories and tags (removed category.php and tag.php)
* Updated Cryout Framework to 0.5.5
* Rearranged customizer section overrides to account for autofocus issue
* Improved plugin/child theme styling override support by changing #main ID to .main class
* Removed social links (and respective scripts) from the admin area
* Removed import/export settings from admin area
* Renamed 'Latest News' section in admin to 'Theme Updates'
* Added unminified resources/js/html5shiv.js
* Fixed cryout_schema_microdata() call in author info page HTML
* Renamed _default.pot to verbosa.pot
* Added WordPress 4.5 site logo support
* Added second textdomain support for WordPress' language packs (also deleted languages folder under cryout and removed redundant loading of text domains in admin area)
* Fixed social menu and turned off social menu locations by default
* Switched to loading JS files as deferred to improve load speed.
* Switched to using core WordPress 'jquery-masonry'
* Removed deprecated style.css tags and added new ones
* Fixed social icons placement options not refreshing in Customizer
* Fixed 'Display Site Title and Tagline' option not affecting the tagline

= 0.9 =
Initial release
