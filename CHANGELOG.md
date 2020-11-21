##WPS-Prime Changelog##
#### v.1.4.3
* Fix loading of default regular Fontawesome if there is no type set to [wps_icon]
#### v.1.4.2
* Update Fontawesome to version 5.6.1
* Update Swiper to version 4.4.6 (from 4.3.0)
* Update Fancybox to version 3.5.6 (from 3.2.10)
* Remove root placed favicon functionality (use WP customizer Favicon manager)

#### v.1.4.1
* Fix button hover opacity settings

#### v.1.4.0
* Migrate Theme options to WP customizer (breaking change must resave all theme settings | migrate child theme options to customizer)
* Extend customizable options
* Add color settings
* Update Fontawesome to version 5.0.13
* Upgrade Accordion Fontawesome option to FA5 
* Cleanup color settings SCSS

#### v.1.3.2
* Added option to disable/eable scripts version number. Allow version numbers to ease view of updated scripts and styles in development phase.
* Add id field to columns

#### v.1.3.1
* Divider component functionality extended

#### v.1.3.0
* Added FA5 fontawesome 5
* Added animation framework / Upgrade components with animation field
* Fix custom 404 page meta field functionality
* Refactor all components that used :after to add icon. Now all components contain coded <i> tag

#### v.1.2.4
* Remove new VC elements (VC - v.5.2)
* Add post id option to heading link

#### v.1.2.3
* Fix default pagination markup
* Change H1 to screen reader text link in page navigation
* Add comment author to comment list
* Fix inner column responsive settings
* Restrict page meta settings to page post type
* Add Fancybox V 3.x.x

#### v.1.2.2
* Show Post/Page id in list view admin column 
* Add CF7 loader svg and extend CF7 Default CSS
* Extend BUTTON component. Add post id field to allow link generation by using a post ID instead of cutom link
* Extend ICON component. Add icon wrap class fiedl to allow adding custom css class to the icon wrapper
* Change post navigation screen reader text html tag from H1 -> a
* Small css fixes
 - extend/finetune default form element css
 - extend/finetune default form utilities css

#### v.1.2.1
* Add instagram to social media list
* Helper getCssClass function update
* Fix VC Column responsive css class output

#### v.1.2.0
* Fix correct js loading / dependency
* Extend Font families
* Add footer disclaimer shortcode support

#### v.1.1.9
* Fix correct icon css loading location
* Extend Font families

#### v.1.1.8
* Add SVG wordpress display fix

#### v.1.1.7
* Fix styled list editor shortcode - normalize css classes
* Fix VC custom style loading. Change VC availability detection and custom style loading
* Extend anything slider slide background image options
* Change site microcopy wrapper html tag to div

#### v.1.1.6
* Change site disclaimer field to textarea (allow html)
* Various bugfixes
* Fix equal height column, inner content flex-column to flex-row
* Add column background behaviour options

#### v.1.1.5
* Add icon option to buttons components
* Add Social Media link options & shortcode [wps_social_links]
* Facilitate option panel extension from child themes
* Fix generated font family (add genenal-family to css string)
* Allow adding scripts with theyr script tag in options script section
* Extend theme hooks

#### v.1.1.4
* Fix textdomain and strings
* PHP lint files
* Remove cf7 deregister script function
* Extend css styling & SASS components
* Move theme options under Appereance admin menu
* Fix hiden css style and VC parameter output
* Extend font family options
* Add font family control to wp editor

#### v.1.1.3
* Make Modify Comment form text area function pluggable
* Make Modify Comment form input fields function pluggable
* Fix email main | secondary check logic
* Add single post template part
* Fix widget title allow shortcode with parameters (decode specialchar encode)
* Allow WPS editor helper buttons everywhere
* Update comment form markup
* Fix WP editor generated icon shortcode output (added class="")
* Extend Icon Shortcode /Component functionality. Add link and link target
* Add Extra class to navigation container element (aid styling)

#### v.1.1.2
* Show media id in media library admin column 
* Fix divider shortcode margin padding arguments
* Update shortcode docs

#### v.1.1.1
* Set checkbox output value to (yes) 
* Fix mediabox default icon font family (fontawesome)

#### v.1.1.0
* Organize Row | Inner Row VC options UI
* Added row/inner_row background image positioning ( top left | top center ...)
* Added row/inner_row background image behaviour (no-repeat | cover | contain)
* Allow shortcode execution in widget title
* Allow shortcode execution in widget title