## [WPS Prime Framework 1.3]
==============================
**1.3.3**
- Added Widget CSS option
- Bugfix (rename option "wps_disable_comment_url")
- Update Swiper Slider core .js from 3.3.0 to 3.3.1
- Added WPS Anything slider shortcode [wps-slider][wps-slider-item]

**1.3.2**
- Extended typography options
- Added 4 new shortcodes Content Highlight | Content Divider | List styler | Mediabox
- Added class filters: site_footer_class();(id="colophon") site_content_class();(id="content")
- Extanded/Normalized CSS classes Buttons | Layout Alignment | Mixins | Typography highlights | Show Hide | Shadows | Normalize color settings
- SCSS cleanup
- Added Setting to disable URL in comment form
- Added system status to theme settings panel
- Added accordion shortcode

**1.3.1.2**
- Added hooks after_content();
- Renamed hook old-> footer_start/footer_end | new-> before_footer/after_footer
- Added class filters: site_footer_class();(id="colophon") site_content_class();(id="content")
- Extended Layout shortcode options

**1.3.1.1**
- Added list style shortcode

**1.3.1**
- Integrated theme shortcode admin helper buttons
- Enhanced theme typography options ( added heading font option )
- Added editor style generation from scss /assets/editor-style.scss

**1.3.0**
- Create a better theme file hierarchy
- Streamline functions.php
- Remove never unused custom header functionality
- Added performance settings to theme options
- Added theme option to disable WP dashicons (for logged out users)
- Added theme option to disable WP emoji and all sripts related
- Update swiper Slider Core from 3.1.2 to 3.3.0
- Cleaup unused .js libraries

**1.2.0**
- Updated [layout] shortcode
- Created 2 new template
  - No sidebar content without sidebar
  - Full-width content is screen fullwidth
- Changed site logo wrapper to <div>
- Changed custom navigation Walker menu items ID from menu-item- to custom-menu-item-
- Cleaned up Finetunes file, added extra comments
- Updated frontend layout class funtions to adapt wrappers to the new templates
- Changed version number
- Streamlined theme filter function creation
- Added layout header filters to ease definitions of css classes
- Rewrite theme typography engine to simplify adding and removing main font
- Move developer helper functions to standalone plugin
- Fix main nav class filter.

**1.1.1**
- Changed shortcode from [email] to [main_email], [phone_nr] to [main_phone_nr]
- Fix main nav class filter.

**1.1.0**
- Theme files/functions update according to latest _s changes
- Extend Code documentation
- Implemented Wordpress coding standards
- Update picturefill from 2.1.0 to 3.0.1

**1.0.0**
- Initial release
