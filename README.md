## [WPS Prime Framework 1.2]
==============================

#### Changelog
**1.2.0.3**
- Changed recomended online backup plugin (old plugin was deleted from wp-repo)

#### Changelog
**1.2.0.2**
- Remove unused plugins

#### Changelog
**1.2.0.1**
- Update Swiper core from 3.0.8 to 3.1.2
- Update Font Awesome from 4.3.0 to 4.4.0


#### Changelog
**1.2.0**
- Updated / Extended startup plugins on theme install
- Added Developer WP Migrate DB Pro 1.5.1
- Added Developer WP Migrate DB Pro media files 1.3.3
- Updated Leadin Pro 4.2.3

#### Changelog
**1.1.0.2**
- Updated "wps_prime_paging_nav" to change from page links to numbered pagination using simple argument 

**1.1.0.1**
- Smallfix code

#### Changelog
**1.1**
- Changed swiper slider (js/css/html markup) from v2.6.0 to v3.0.8

#### Changelog
**1.0.9.2.1**
- Updated picturefill from v2.0.1 to v2.3.1

#### Changelog
**1.0.9.2**
- Smallfix title tag in head

**1.0.9.1**
- Add allow shortcode in widget title
- Various conditional check's on theme settings
- Theme Settings now in top level admin sidebar
- Fontawsome Update to version 4.3.0

**1.0.9**
- Add TGM Plugin Activation. Plugins inlcuded: PIKLIST /  Contact Form 7 / Contact Form DB / Leadin Pro v-3.1.3 / Simple Image Sizes / Online Backup for WordPress / WordPress Backup to Dropbox / WP Migrate DB
- InuitUI update

**1.0.8.3**
- Code leftover cleanup
- Moved theme/site options to top level in admin sidebar


**1.0.8.2**
- Theme Hook init small bug fix (conditional remove nav wrap in check for 404 condition)
 
**1.0.8.1**
- Clean Page template main nav remove function corected

**1.0.8**
- Moved theme shortcodes to Theme Support Plugin. Follow WP recomandation ref: https://make.wordpress.org/themes/handbook/guidelines/plugin-territory/
- Moved Remove Empty Paragraph Tags Around Shortcodes to Theme Suport Plugin

**1.0.7.1**
- Fix layout controller logic / template main class generator
- Change default value of phone nr branding setting (072 xxx to 07x xxx)
- Conditional html markup in header layout (if no action is registered to a hook the Markup will not be displayed)
- Added function to Remove Empty Paragraph Tags Around Shortcodes

**1.0.7**
- Added favico support (drop favicon.ico in main childtheme root)

**1.0.6.1**
- Fix main nav "site-nav--solid" css modifier target from "nav-menu" to "site-nav__list" (nav-menu class is JS generated and it might not be avaliable on first pageload)
 
**1.0.6**
- Extended layout shortcode args
 
**1.0.5**
- Various style fixes and additions
- Update contact form 7 styles (remove) function

**1.0.4**
- Merged navigation.js,skip-link-focus-fix.js with main site.js
- Css adjustment on full width slider (Hide control arrows and pagination on mobile devices)

**1.0.3**
- Updated action priority of footer micro
- Change main slider classes to ease slider maintenance
- Routine php markup clean - layout_controller.php
- Make main site navigation function pluggable
- Move (allow shortcode in text widget) filter from functions to extras
- Optimize require order in functions

**1.0.2**
- reverse layout controller whitelist logic

**1.0.0**
- Initial release
