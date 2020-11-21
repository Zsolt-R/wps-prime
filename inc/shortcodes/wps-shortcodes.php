<?php
/**
 *  WPS SHORTCODES.
 *
 * 1  Row Wrapper Markup - [wps_row class="lap-and-up..." wrapper="false" wrapper_class="custom-class"]
 * 2  Row Item Markup - [wps_col class="lap-and-up..."] ...content... [/wps_col]
 * 3  Full Width Slider - [wps_slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"]
 * 4  Custom Buttons - [wps_button class="c-button--small,c-button--large,c-button--primary,c-button--secondary,c-button--tertiary" link="http://www...." label="button label"]
 * 5  Image [wps_image]
 * 6  Heading
 * 7  Icons - [wps_ico]fa fa-home[/wps_ico]
 * 8  Main Phone number - [wps_main_phone_nr class="" link="true"]
 * 9  Main Email address - [wps_main_email class="" link="true"]
 * 10 List styles [wps_list class="c-list--style-one custom--class"]<ul><li>List item</li> .... </ul>[/wps_list]
 * 11 Media Box [wps_mediabox]...content...[/wps_mediabox]
 * 12 Highlight [wps_hglt class="" html_tag=""]...content...[/wps_hglt]
 * 13 Divider [wps_divider]
 * 14 Accordion [wps_accordion]
 * 15 Accordion item [wps_accordion_item]
 * 16 WPS Anything slider [wps_all_slider]
 * 17 WPS Anything slider slide [wps_all_slider_item]
 * 18 WPS Tabby [wps_tab_shortcode]
 * 19 WPS Tabby Item [wps_tab_item_shortcode]
 * 20 WPS social links [wps_social_links]
 */

/* 1 Row Wrapper Markup */
add_shortcode( 'wps_row', 'wps_row_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-row.php';

/* 2 Row Item Markup */
add_shortcode( 'wps_col', 'wps_col_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-col.php';

/* 3 Full Width Slider */
add_shortcode( 'wps_slider', 'wps_fw_slider_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-fw-slider.php';

/* 4 Custom Buttons */
add_shortcode( 'wps_button', 'wps_buttons_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-button.php';

/* 5 Heading */
add_shortcode( 'wps_heading', 'wps_heading_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-heading.php';

/* 6 Image */
add_shortcode( 'wps_image', 'wps_image_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-image.php';

/* 7 Shortcode for icons - DEPRECATED*/
add_shortcode( 'wps_ico', 'wps_ico_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-ico-deprecated.php';

/* 8 Get theme option phone nr */
add_shortcode( 'wps_main_phone_nr', 'wps_main_phone_nr_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-phone-nr.php';

/* 9 Get theme option email */
add_shortcode( 'wps_main_email', 'wps_main_email_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-email.php';

/* 10 Creates a custom bulleted list */
add_shortcode( 'wps_list', 'wps_styled_list_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-styled-list.php';

/* 11 Generate a complex Media Box */
add_shortcode( 'wps_mediabox', 'wps_media_box_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-media-box.php';

/* 12 Content highlight Markup */
add_shortcode( 'wps_hglt', 'wps_content_highlight_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-content-highlight.php';

/* 13 Content divider */
add_shortcode( 'wps_divider', 'wps_content_divider_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-content-divider.php';

/*
 14 Accordion */
/* 15 Accordion item */
require_once WPS_ENGINE_DIR . '/shortcodes/shortcode_classes/wps_acc_shortcode.php';

/*
 16 WPS Anything slider */
/* 17 WPS Anything slider slide */
add_shortcode( 'wps_all_slider', 'wps_slider_shortcode' );
add_shortcode( 'wps_all_slider_item', 'wps_slider_item_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-anything-slider.php';

/*
 18 WPS Tabby */
/* 19 WPS Tabby Item */
add_shortcode( 'wps_tab', 'wps_tab_shortcode' );
add_shortcode( 'wps_tab_item', 'wps_tab_item_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-tabby-tabs.php';

/* 20 WPS social links */
add_shortcode( 'wps_social_links', 'wps_social_links_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-social-links.php';

/* 21 WPS get the date */
add_shortcode( 'wps_get_the_date', 'wps_get_the_date_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-get-the-date.php';

/* 22 WPS getsite info */
add_shortcode( 'wps_get_site_info', 'wps_get_site_info_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-get-site-info.php';

/* 23 WPS getsite info */
add_shortcode( 'wps_list_custom_menu', 'wps_list_custom_menu_shortcode' );
require_once WPS_ENGINE_DIR . '/shortcodes/items/wps-list-custom-menu.php';

