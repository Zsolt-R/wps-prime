<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'wps_prime_settings';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'wps-prime'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Check favicon existence.
	$ico_path = get_stylesheet_directory() .'/favicon.ico';	
	$favicon = false !== get_transient('site_favicon') ? get_transient('site_favicon') : '<span class="wp-ui-text-notification dashicons dashicons-warning"></span> No data';
	
	$favicon_status = wps_file_exist( $ico_path ) ? '<span class="dashicons dashicons-yes wp-ui-text-highlight"></span>':'<span class="wp-ui-text-notification dashicons dashicons-warning"></span> Missing';

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	/**
	 * Get typography settings from theme typography.php
	 */
	$fonts = new WpsGetThemeFonts;

	$options = array();

	/**
	*	Branding
	*/

	$options[] = array(
		'name' => __( 'Branding Settings', 'wps-prime' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Company name', 'wps-prime' ),
		'desc' => __( 'If no name is added will fall back to site name', 'wps-prime' ),
		'id' => 'company_name',
		//'std' => 'Default Value',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Company logo', 'wps-prime' ),
		'desc' => __( '', 'wps-prime' ),
		'id' => 'company_logo',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Company launch year', 'wps-prime' ),
		'desc' => __( 'Used in site info, ex. footer micro copy.', 'wps-prime' ),
		'id' => 'company_launch_date',
	//	'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	
	$options[] = array(
		'name' => __( 'Company phone number', 'wps-prime' ),
		'desc' => __( 'Used in a shortcode. Regardles where the phone number will be placed we can update it from here.', 'wps-prime' ),
		'id' => 'phone_nr',
	//	'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Company phone number (second)', 'wps-prime' ),
		'desc' => __( 'Used in a shortcode. Regardles where the phone number will be placed we can update it from here.', 'wps-prime' ),
		'id' => 'phone_nr_second',
	//	'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Company contact email', 'wps-prime' ),
		'desc' => __( 'Used in a shortcode. Regardles where the phone number will be placed we can update it from here.', 'wps-prime' ),
		'id' => 'email_address',
		//'std' => 'Default Value',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Company contact email (second)', 'wps-prime' ),
		'desc' => __( 'Used in a shortcode. Regardles where the phone number will be placed we can update it from here.', 'wps-prime' ),
		'id' => 'email_address_secondary',
		//'std' => 'Default Value',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Site disclaimer', 'wps-prime' ),
		'desc' => __( 'Disclaimer text will appear in the footer.', 'wps-prime' ),
		'id' => 'site_disclaimer',
		//'std' => 'Default Value',
		'type' => 'text'
	);


	/**
	*	Typography
	*/

	$options[] = array(
		'name' => __( 'Typography', 'wps-prime' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Body Font', 'wps-prime' ),
		'desc' => __( 'Choose what font family to use as the main Body font.', 'wps-prime' ),
		'id' => 'main_font_family',
		'type' => 'select',
		'options' => $fonts->get_fonts_name()
	);

	$options[] = array(
		'name' => __( 'Load fonts subset', 'wps-prime' ),
		'desc' => __( 'Will load Latin and Latin-ext font subset (where avaliable). This option has a high loding performance impact.', 'wps-prime' ),
		'id' => 'font_family_subset',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Heading Font', 'wps-prime' ),
		'desc' => __( 'Set different font family for headings.  This option has performance impact.', 'wps-prime' ),
		'id' => 'second_font_family_status',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Heading Font', 'wps-prime' ),
		'desc' => __( 'Choose what font family to use as the main Heading font.', 'wps-prime' ),
		'id' => 'secondary_font_family',
		'type' => 'select',
		'options' => $fonts->get_fonts_name()
	);

	/**
	*	Site Content
	*/

	$options[] = array(
		'name' => __( 'Site Content', 'wps-prime' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Site global content', 'wps-prime' ),
		'desc' => __( 'Area visible on all the site pages. ( default location before the footer )', 'wps-prime' ),
		'id' => 'global_content_end_area',
		'type' => 'editor',
		'settings' => array(
						'wpautop' => true, // Default
						'textarea_rows' => 5,
						'tinymce' => array( 'plugins' => 'wordpress,wplink' )
					)
	);

	$options[] = array(
		'name' => __( 'Widget custom CSS class', 'wps-prime' ),
		'desc' => __( 'Enable custom CSS field option on site widgets', 'wps-prime' ),
		'id' => 'widget_class',
		'std' => '0',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => __( 'Custom 404 page', 'wps-prime' ),
		'desc' => __( 'Use a custom page for 404 error page, defaults to true.', 'wps-prime' ),
		'id' => '404_custom_page_use',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Choose a page to use it as 404', 'wps-prime' ),
		'desc' => __( 'Choose a page to display it\'s content on the 404 error page.', 'wps-prime' ),
		'id' => '404_custom_page',
		'type' => 'select',
		'options' => $options_pages
	);

	/**
	*	Site Content
	*/

	$options[] = array(
		'name' => __( 'Blog Settings', 'wps-prime' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Article meta visibility settings', 'wps-prime' ),
		'desc' => __( 'Set Article meta data visibility (ex. Posted on... / Posted in ...) show/hide. Default \'show\'', 'wps-prime' ),
		'id' => 'article_meta_visibility',
		'std' => '0',
		'type' => 'checkbox'
	);
	
	/**
	*	Custom Scripts & Styles
	*/

	$options[] = array(
		'name' => __( 'Custom Scripts & Styles', 'wps-prime' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Header Scripts', 'wps-prime' ),
		'desc' => __( 'JS scripts that will load in the header. Don\'t wrap in "script" tag!.', 'wps-prime' ),
		'id' => 'header_scripts',
		'std' => '',
		'type' => 'scriptarea'
	);

	$options[] = array(
		'name' => __( 'Footer Scripts', 'wps-prime' ),
		'desc' => __( 'JS scripts that will load in the footer. Don\'t wrap in "script" tag!.', 'wps-prime' ),
		'id' => 'footer_scripts',
		'std' => '',
		'type' => 'scriptarea'
	);

	$options[] = array(
		'name' => __( 'Custom CSS style', 'wps-prime' ),
		'desc' => __( 'Add custom CSS style. Large css settings should be in custom stylesheets. Only used it for limited amount of css, all the declarations will be inlined in the head. Don\'t wrap in "style" tag!', 'wps-prime' ),
		'id' => 'custom_css_style',
		'std' => '',
		'type' => 'scriptarea'
	);

	/**
	*	Performance Tweaks
	*/

	$options[] = array(
		'name' => __( 'Performance Tweaks', 'wps-prime' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'WordPress default emoji', 'wps-prime' ),
		'desc' => __( 'Disable unused empji scripts from loading on front end.', 'wps-prime' ),
		'id' => 'front_emoji_use',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'WordPress default dashicons', 'wps-prime' ),
		'desc' => __( 'Disable unused dashicon scripts from loading on front end.', 'wps-prime' ),
		'id' => 'front_dashicons_use',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Comment form URL field', 'wps-prime' ),
		'desc' => __( 'Disable the url field in the comment form section.', 'wps-prime' ),
		'id' => 'disable_comment_url',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'System Status', 'wps-prime' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Development Info', 'wps-prime' ),
		'type' => 'info',
		'desc' => get_development_data() ."\n". 'Favicon in theme root: '.$favicon_status.' | transient: '. $favicon ."\n". '<hr/> <strong>Available image sizes:</strong> '.get_image_sizes()
	);
	return $options;
}