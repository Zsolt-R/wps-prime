=== WPS Prime ===
Contributors: (@zsoltrevay)
Tags: theme-framework, customizer, right-sidebar, full-width, custom-background
Requires at least: 5.4
Tested up to: 5.5.0
Stable tag: 1.7.25
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WPS Prime wordpress theme framework allow for fast and clean wordpress website creation.

== Description ==

A lightweight WordPress master theme based on _s and extended with simple and useful add ons that speeds up child theme development.

== Changelog ==
1.7.25
* Update - Add webp allow file type webp
* Update - Add image title and alt to Media box | image shortcodes generated images

1.7.24
* Update - Add after header content area | Add before main content area section

1.7.23
* Update - Extend font list Poppins | Work Sans | Inter

1.7.22
* Fix - Divider self closing div
* Fix - Cleanup phone number

1.7.21
* UPDATE - Extend font list with variable fonts
* UPDATE - Improve font family information in customizer (add font type info)

1.7.20
* FIX - Rename Google Plus to My Business
* FIX - Custom style font family add '' arround font

1.7.19
* FIX - Button aspect pill

1.7.18
* UPDATE - Change mobile nav toggler action hook priority to 99

1.7.17
* UPDATE - Add shortcode [wps_list_custom_menu] 
  ex: [wps_list_custom_menu menu="Small nav"]
  args: container_class/container_id/menu_class/menu_id/echo/fallback_cb/before/after/link_before/link_after/depth/walker/theme_location/level 
  ref: https://developer.wordpress.org/reference/functions/wp_nav_menu/

1.7.16
* UPDATE - Add class to email and phone shortcodes to allow JS targetting

1.7.15
* UPDATE - Add shortcode [wps_get_site_info] args: field='name' ( field arg from get_bloginfo() default 'name' )) | return=true (return or echo)

1.7.14
* UPDATE - Update image component | Add outer class

1.7.13
* UPDATE - Add shortcode [wps_get_the_date] args: format='Y' (php date()) | return=true (return or echo)

1.7.12
* UPDATE - Simplify Ppage settings meta filed by combining the margin and title settigns under one meta box
* UPDATE - Remove google plus and add a google logo (used for google my business)

1.7.11
* UPDATE - Add Grid intermediate column sizes 20% 40% 60% 80% (Update child themes gridlex sass to make it work)

1.7.10
* UPDATE - Add shadow class to button
* UPDATE - Add center-left center-right background options
* FIX - VC row wrapper size typo

1.7.9
* FIX - Mediabox svg bug
* FIX - Row svg bg bug

1.7.08
* UPDATE - Reorganize VC layout on: Accordion | Sliders | Tabs | Styled List | Mediabox 
* UPDATE - Styled List. Add option to colorize the text
* UPDATE - Mediabox. Add settings to make full height image (prepare markup for migration to flexbox based layout) 
* FIX - fix double do shortcode in col  

1.7.07
* FIX - WPML link conversion logic

1.7.6
* FEATURE - Add wrapper width selector to row component
* FEATURE - Add list spacing option to styled list component

== Changelog ==
1.7.05
* FIX - Remove leftover button link target

== Changelog ==
1.7.05
* FIX - Remove leftover button link target

== Changelog ==
1.7.04
* FIX - Bulk update of pages is resetting the margin and title visibility settings
* UPDATE - Add page margin and title visibility settings to quick edit screen

== Changelog ==
1.7.03
* UPDATE - Separate Shwortcodes in own file to allow easier Update
* UPDATE - Migrate url fields to WP link modal (Button, Heading, Image)  Notice this will keep backward compatibility but will hide old fields from VC UI

== Changelog ==
1.7.02
* UPDATE - make wps_site_branding_logo function pluggable 

== Changelog ==
1.7.01
* FIX - change helper function wps_get_image_id to use wordpress native functionality to retrieve image id by URL (attachment_url_to_postid)

== Changelog ==
1.7.00
* FIX - Styled list - item spacing option

== Changelog ==
1.7.0.RC1
* Update - Remove all font icon files
* Update - Acordion | Tabs | Buttons | Icon | Mediabox | Styled list components to use new icon shortcode
* Update - Add backward compatibility layer after icon functionality change

== Changelog ==
= 1.6.0 =
* FIX - Fix padding-left VC selector

== Changelog ==
= 1.5.9 =
* FIX - Fix social list icon size when FA is loading slow
* FIX - Font family is applied corectly to form data
* Update - Load swiper slider | scroll magic from CDN
* Update - Cleanup SCSS folder, include all imports to a single project.

== Changelog ==
= 1.5.8 =
* Update - Fix social list icon size remove (fa-lg)

== Changelog ==
= 1.5.7 =
* Update - Make default menu walkers pluggable

== Changelog ==
= 1.5.6 =
* Update - Add "Medium" to social list

== Changelog ==
= 1.5.5 =
* Update - Add option to remove jQuery migrate


== Changelog ==
= 1.5.4 =
* Update - Simplify social media list code. Remove customm icon option return pure svg (eliminate FA5 brand library call for performance enhance)

= 1.5.3 =
* FIX - Fix button default regular icon load

= 1.5.2 =
* FIX - Fix font inline style logix
* FIX - Fix description on VC component
* FIX - Remove non existent shortcode settings from VC

= 1.5.1 =
* FIX - Fix duplicate Spacing settings on Heading VS component

= 1.5.0 =
* UPDATE - Update Swiper 4.4.6 to 4.5.0
* FEATURE - Remove VC-row param RTL
* FEATURE - Move swiper slider style to it's own place | remove from main stylesheed and load it conditionally
* FEATURE - Add customizer setting to disable animation library
* UPDATE - Migrate workflow to node-sass (ruby sass is deprecated)

= 1.4.5 =
* FIX - Wrong property description for VS heading Link field
* FEATURE - Add margin and padding to styled list component
* UPDATE - Update animation library
* UPDATE - Heading component -> add link by post_id | link title (description)