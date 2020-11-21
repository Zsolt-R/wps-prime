<?php
/**
 * Contains methods for customizing the theme customization screen.
 * WPS Prime 2 Theme Customizer.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @package WPS_Prime_2
 */
if ( ! function_exists( 'wps_colors_defaults' ) ) {
	function wps_colors_defaults() {
		$defaults_list = array(
			'text-color-body'        => '#000000',
			'text-color-link'        => '#2980b9',
			'text-color-light'       => '#dddddd',
			'text-color-heading'     => '#000000',
			'text-color-primary'     => '#309bd4',
			'text-color-secondary'   => '#e74c3c',
			'text-color-tertiary'    => '#FAFA26',
			'background-color-one'   => '#2c3e50',
			'background-color-two'   => '#e74c3c',
			'background-color-three' => '#FAFA26',
			'background-color-four'  => '#3498db',
			'background-color-five'  => '#9b59b6',
			'background-color-six'   => '#27ae60',
			'background-color-dark'  => '#0C1516',
			'background-color-body'  => '#ffffff',
			'background-color-light' => '#F7F5ED',
			'button-color-default'   => '#1E1E1C',
			'button-color-primary'   => '#20638f',
			'button-color-secondary' => '#e67e22',
			'button-color-tertiary'  => '#00B0D0',
			'button-color-negative'  => '#e74c3c',
			'button-color-positive'  => '#2ecc71',
			'button-color-neutral'   => '#505050',
			'button-color-light'     => '#999999',
			'button-color-white'     => '#ffffff',
		);

		return $defaults_list;
	}
}

// Pharse the defaults
function wps_pharse_defaults( $color ) {

	$colorList = wps_colors_defaults();

	$defaults = array();

	// Default values are copied from css
	// Transform lines to dashto allow usage in customizer
	// Change line to dash
	foreach ( $colorList as $key => $value ) {
		$def_key              = str_replace( '-', '_', $key );
		$defaults[ $def_key ] = $value;
	}
	// Change argument lines to dash
	$color = str_replace( '-', '_', $color );

	return $defaults[ $color ];
}

function themeslug_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function wps_get_pages() {
	// Pull all the pages into an array
	$options_pages     = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ( $options_pages_obj as $page ) {
		$options_pages[ $page->ID ] = $page->post_title;
	}
	return $options_pages;
}

class WPS_Prime_Customize {
	/**
	 * This hooks into 'customize_register' (available as of WP 3.4) and allows
	 * you to add new sections and controls to the Theme Customize screen.
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * @see add_action('customize_register',$func)
	 * @param \WP_Customize_Manager $wp_customize
	 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since WPS-PRIME 2.0
	 */
	public static function register( $wp_customize ) {

		/**
		   * Get typography settings from theme typography.php
		   */
		$fonts = new WpsGetThemeFonts();

		$dev_info  = '<p>';
		$dev_info .= get_development_data() . '<br>';
		$dev_info .= '<span style="font-size:22px;font-weight:300;">Available image sizes:</span><br><br>';
		$dev_info .= get_image_sizes();
		$dev_info .= '</p>';

		/******************************
		 * PANELS
		 * 0. Define a new panel (if desired) to the Theme Customizer
		*/
		$wp_customize->add_panel(
			'theme_colors_panel',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Theme Colors',
				'description'    => '',
			)
		);

		$wp_customize->add_panel(
			'theme_branding_panel',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Branding',
				'description'    => '',
			)
		);

		$wp_customize->add_panel(
			'theme_site_content_panel',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Site content',
				'description'    => '',
			)
		);

		$wp_customize->add_panel(
			'developer_tweaks_section',
			array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Developer Tweaks',
			)
		);

		/******************************
		 * SECTIONS
		 * 1. Define a new section (if desired) to the Theme Customizer
		*/
		$wp_customize->add_section(
			'typography_section',
			array(
				'title'       => __( 'Typography', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Customize theme fonts', 'wps-prime' ), // Descriptive tooltip
			)
		);

		$wp_customize->add_section(
			'text_colors_section',
			array(
				'title'       => __( 'Text Colors', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Customize theme text colors', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_colors_panel',
			)
		);

		$wp_customize->add_section(
			'background_colors_section',
			array(
				'title'       => __( 'Background Colors', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Customize theme background colors', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_colors_panel',
			)
		);

		$wp_customize->add_section(
			'button_colors_section',
			array(
				'title'       => __( 'Button Colors', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Customize theme button colors', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_colors_panel',
			)
		);

		$wp_customize->add_section(
			'company_details_section',
			array(
				'title'       => __( 'Company details', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Details here are used all over the website', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_branding_panel',
			)
		);

		$wp_customize->add_section(
			'company_social_media_section',
			array(
				'title'       => __( 'Social Media', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_branding_panel',
			)
		);
		$wp_customize->add_section(
			'site_content_section',
			array(
				'title'       => __( 'Site content', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_site_content_panel',
			)
		);
		$wp_customize->add_section(
			'site_blog_section',
			array(
				'title'       => __( 'Blog', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_site_content_panel',
			)
		);
		$wp_customize->add_section(
			'additional_js_section',
			array(
				'title'       => __( 'Additional JS', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip

			)
		);
		$wp_customize->add_section(
			'performance_tweaks_section',
			array(
				'title'      => __( 'Performance Tweaks', 'wps-prime' ), // Visible title of section
				'priority'   => 35, // Determines what order this appears in
				'capability' => 'edit_theme_options', // Capability needed to tweak
				'panel'      => 'developer_tweaks_section',

			)
		);

		$wp_customize->add_section(
			'developer_info_section',
			array(
				'title'              => __( 'System Status / Dev. options', 'wps-prime' ), // Visible title of section
				'priority'           => 200, // Determines what order this appears in
				'capability'         => 'edit_theme_options', // Capability needed to tweak
				'panel'              => 'developer_tweaks_section',
				'description_hidden' => false,
				'description'        => $dev_info,
			)
		);
		/******************************
		 * SETTING|CONTROL PAIRS TEXT COLORS
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_text_color_body', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'text_color_body' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_color_text', // Set a unique ID for the control
				array(
					'label'    => __( 'Body text color', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_text_color_body', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'text_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_text_color_link', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'text_color_link' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_color_link', // Set a unique ID for the control
				array(
					'label'    => __( 'Link color', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_text_color_link', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'text_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		 // SETTING
		$wp_customize->add_setting(
			'wps_text_color_heading', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'text_color_heading' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_color_heading', // Set a unique ID for the control
				array(
					'label'    => __( 'Headings color', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_text_color_heading', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'text_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_text_color_light', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'text_color_light' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_text_color_light', // Set a unique ID for the control
				array(
					'label'    => __( 'Text color light', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_text_color_light', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'text_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_text_color_primary', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'text_color_primary' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_text_color_primary', // Set a unique ID for the control
				array(
					'label'    => __( 'Primary text color', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_text_color_primary', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'text_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_text_color_secondary', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'text_color_secondary' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);
		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_text_color_secondary', // Set a unique ID for the control
				array(
					'label'    => __( 'Secondary text color', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_text_color_secondary', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'text_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_text_color_tertiary', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'text_color_tertiary' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);
		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_text_color_tertiary', // Set a unique ID for the control
				array(
					'label'    => __( 'Tertiary text color', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_text_color_tertiary', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'text_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		/******************************
		 * SETTING|CONTROL PAIRS BACKGROUND COLORS
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/

		// SETTING
		$wp_customize->add_setting(
			'wps_background_color_one', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_one' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_one', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color one', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_one', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_background_color_two', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_two' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_two', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color two', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_two', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_background_color_three', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_three' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_three', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color three', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_three', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_background_color_four', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_four' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_four', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color four', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_four', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_background_color_five', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_five' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_five', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color five', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_five', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_background_color_six', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_six' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_six', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color six', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_six', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		  // SETTING
		$wp_customize->add_setting(
			'wps_background_color_light', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_light' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_light', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color light', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_light', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		  // SETTING
		$wp_customize->add_setting(
			'wps_background_color_dark', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_dark' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_dark', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color dark', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_dark', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		  // SETTING
		$wp_customize->add_setting(
			'wps_background_color_body', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'background_color_body' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_background_color_body', // Set a unique ID for the control
				array(
					'label'    => __( 'Background color body', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_background_color_body', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'background_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		/******************************
		 * SETTING|CONTROL PAIRS TYPOGRAPY
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_custom_font_family_status', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_custom_font_family_status', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Custom', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Checking this box will disable Google font settings', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'typography_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_font_family', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_main_font_family', // Set a unique ID for the control
			array(
				'type'        => 'select',
				'label'       => __( 'Body Font', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Choose what font family to use as the main Body font.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'typography_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'choices'     => array_merge( array( 'empty' => 'Choose font family' ), ( $fonts->get_fonts_name() ) ),
				'default'     => 'empty',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_font_family_subset', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_font_family_subset', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Load fonts subset', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Will load Latin and Latin-ext font subset (where avaliable). This option has a high loding performance impact.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'typography_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_second_font_family_status', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_second_font_family_status', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Heading Font Status', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Set different font family for headings.  This option has performance impact. You can also use this font by adding "u-font-two" css class on a text.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'typography_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_secondary_font_family', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_secondary_font_family', // Set a unique ID for the control
			array(
				'type'        => 'select',
				'label'       => __( 'Heading Font', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Choose what font family to use as the main Heading font.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'typography_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'choices'     => array_merge( array( 'empty' => 'Choose font family' ), ( $fonts->get_fonts_name() ) ),
				'default'     => 'empty',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_nav_custom_font', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_nav_custom_font', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Navigation Font', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Set heading font family for navigation.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'typography_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		/******************************
		 * SETTING|CONTROL PAIRS BUTTON COLORS
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_default', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_default' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_default', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color default', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_default', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);
		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_primary', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_primary' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_primary', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color primary', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_primary', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_secondary', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_secondary' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_secondary', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color secondary', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_secondary', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_tertiary', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_tertiary' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_tertiary', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color tertiary', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_tertiary', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_negative', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_negative' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_negative', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color negative', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_negative', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_positive', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_positive' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_positive', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color positive', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_positive', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_neutral', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_neutral' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_neutral', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color neutral', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_neutral', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_light', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_light' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_light', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color light', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_light', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_white', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => wps_pharse_defaults( 'button_color_white' ), // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_button_color_white', // Set a unique ID for the control
				array(
					'label'    => __( 'Button color white', 'wps-prime' ), // Admin-visible name of the control
					'settings' => 'wps_button_color_white', // Which setting to load and manipulate (serialized is okay)
					'priority' => 10, // Determines the order this control appears in for the specified section
					'section'  => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_button_color_hover_modifier', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '-0.2', // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_theme_button_color_hover_modifier', // Set a unique ID for the control
			array(
				'type'              => 'range',
				'label'             => __( 'Button hover color modifier', 'wps-prime' ), // Admin-visible name of the control
				'description'       => __( '<b>Default: -0.2.</b><br>Use the slider to set the hover color darken or lighter, between -1,1 values. 0.1 steps (0.1 = 10%)', 'wps-prime' ),
				'settings'          => 'wps_button_color_hover_modifier', // Which setting to load and manipulate (serialized is okay)
				'priority'          => 10, // Determines the order this control appears in for the specified section
				'section'           => 'button_colors_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'input_attrs'       => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.1,
				),
				'sanitize_callback' => 'intval',
			)
		);

		/******************************
		 * SETTING|SITE BRANDING
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_branding_company_logo', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Upload_Control(
				$wp_customize,
				'branding_company_logo',
				array(
					'label'       => __( 'Company logo', 'wps-prime' ), // Admin-visible name of the control
					'description' => __( 'Logo will be rendered at full size. Please adjust your logo size to the correct fit. The logo will replace sitename/company name in the header area', 'wps-prime' ),
					'section'     => 'company_details_section',
					'settings'    => 'wps_branding_company_logo',
				)
			)
		);
		// SETTING
		$wp_customize->add_setting(
			'wps_phone_nr', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_phone_nr', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Company phone number', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Used in a shortcode. Regardles where the phone number will be placed you can update it from here', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_phone_nr_second', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_phone_nr_second', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Company phone number Second', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Used in a shortcode. Regardles where the phone number will be placed you can update it from here', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_email_address', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_email_address', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Company contact email', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Used in a shortcode. Regardles where the email will be placed you can update it from here', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_email_address_second', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_email_address_second', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Company contact email Second', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Used in a shortcode. Regardles where the email will be placed you can update it from here', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_site_disclaimer', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_site_disclaimer', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Site disclaimer', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disclaimer text will appear in the footer.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		/******************************
		 * SETTING|CONTROL PAIRS Social Media
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_facebook', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_facebook', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Facebook link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_instagram', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_instagram', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Instagram link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_twitter', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_twitter', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Twitter link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_linkedin', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_linkedin', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'LinkedIn link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_gbusiness', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		  // CONTROL
		$wp_customize->add_control(
			'wps_social_link_gbusiness', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Google my business link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_youtube', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_youtube', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Youtube link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_vimeo', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_vimeo', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Vimeo link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_flickr', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_flickr', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Flickr link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_pinterest', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_pinterest', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Pinterest link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_medium', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_medium', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Medium link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		/******************************
		 * SETTING|CONTROL PAIRS Site content
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_global_content_start_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_global_content_start_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Global before header content', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Area visible at the start of the site. ( default location before the header )', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		$wp_customize->add_setting(
			'wps_global_after_header_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_global_after_header_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Global after header', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Area visible after header just before the main content.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		$wp_customize->add_setting(
			'wps_global_main_content_start_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_global_main_content_start_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Global before main content', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Area visible at the start of the main content right after the header.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_global_content_end_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_global_content_end_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Global before footer content', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Area visible on all the site pages. ( default location before the footer )', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_theme_widget_class', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_theme_widget_class', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Widget custom CSS class', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Enable custom CSS field option on site widgets', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_404_custom_page', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_404_custom_page', // Set a unique ID for the control
			array(
				'type'        => 'select',
				'label'       => __( 'Choose a page to use it as 404', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Choose a page to display it\'s content on the 404 error page.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'choices'     => wps_get_pages(),
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_article_meta_visibility', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_article_meta_visibility', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Hide article meta', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Set Article meta data visibility (ex. Posted on... / Posted in ...) show/hide. Default \'show\'', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_blog_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

			// SETTING
			$wp_customize->add_setting(
				'wps_meta_u_time_visibility', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
					'default'    => false, // Default setting/value to save
					'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
					'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
			);

			// CONTROL
			$wp_customize->add_control(
				'wps_meta_u_time_visibility', // Set a unique ID for the control
				array(
					'type'        => 'checkbox',
					'label'       => __( 'Article meta time setting', 'wps-prime' ), // Admin-visible name of the control
					'description' => __( 'Show modified time and publish time', 'wps-prime' ),
					'priority'    => 10, // Determines the order this control appears in for the specified section
					'section'     => 'site_blog_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			);

		// SETTING
		$wp_customize->add_setting(
			'wps_header_scripts', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_header_scripts', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Header Scripts', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'JS scripts that will load in the header.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'additional_js_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_body_start_scripts', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_body_start_scripts', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Body Start Scripts', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'JS scripts that will load after the opening <body> tag.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'additional_js_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_footer_scripts', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_footer_scripts', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Footer Scripts', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'JS scripts that will load in the footer.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'additional_js_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_remove_assets_version_numbers', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_remove_assets_version_numbers', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Asset version number', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Remove asset number. Optimize website score by removing version number of scripts and styles. (You will need to hard refresh / clear cache when assets are updated)', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_front_emoji_use', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_front_emoji_use', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'WordPress default emoji', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable unused empji scripts from loading on front end.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_front_dashicons_use', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_front_dashicons_use', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'WordPress default dashicons', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable unused dashicon scripts from loading on front end.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_disable_comment_url', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_disable_comment_url', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Comment form URL field', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable the url field in the comment form section.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_front_jquery_migrate_use', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_front_jquery_migrate_use', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'jQuery migrate', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable jQuery migrate from loading on front end.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_disable_animation_lib', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_disable_animation_lib', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Animation CCS library', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable animation css library', 'wps-prime' ) . ' -> <a href="https://daneden.github.io/animate.css/" target="_blank" title="Open in new window">link</a>',
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_display_wps_hooks', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_display_wps_hooks', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Display WPS hooks on front end', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Show WPS Prime hooks on front end. Usefull for debugging and theme development', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'developer_info_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// 4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
		$wp_customize->get_setting( 'blogname' )->transport                      = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport               = 'postMessage';
		$wp_customize->get_setting( 'wps_branding_company_logo' )->transport     = 'postMessage';
		$wp_customize->get_setting( 'wps_site_disclaimer' )->transport           = 'postMessage';
		$wp_customize->get_setting( 'wps_global_content_end_area' )->transport   = 'postMessage';
		$wp_customize->get_setting( 'wps_global_content_start_area' )->transport = 'postMessage';
		$wp_customize->get_setting( 'wps_article_meta_visibility' )->transport   = 'refresh';
		$wp_customize->get_setting( 'wps_meta_u_time_visibility' )->transport    = 'refresh';
		$wp_customize->get_setting( 'wps_display_wps_hooks' )->transport         = 'refresh';

		$wp_customize->selective_refresh->add_partial(
			'wps_branding_company_logo',
			array(
				'selector'        => '.site-branding-logo',
				'render_callback' => 'wps_site_branding_logo',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_site_disclaimer',
			array(
				'selector'        => '.site-disclaimer',
				'render_callback' => 'wps_site_disclaimer',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_global_content_end_area',
			array(
				'selector'        => '.site-global-content-end',
				'render_callback' => 'wps_theme_global_content_end_area',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_global_content_end_area',
			array(
				'selector'        => '.site-global-content-start',
				'render_callback' => 'wps_theme_global_content_start_area',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_article_meta_visibility',
			array(
				'selector'        => '.entry-meta-content',
				'render_callback' => 'wps_prime_posted_on',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'wps_meta_u_time_visibility',
			array(
				'selector'        => '.entry-date',
				'render_callback' => 'wps_prime_posted_on_time',
			)
		);
	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @see add_action('wp_head',$func)
	 * @since WPS-PRIME 2.0
	 */
	public static function customizer_style() {
		$style  = ':root {';
		$style .= self::generate_css_var( '--text-color-primary', 'wps_text_color_primary' );
		$style .= self::generate_css_var( '--text-color-secondary', 'wps_text_color_secondary' );
		$style .= self::generate_css_var( '--text-color-tertiary', 'wps_text_color_tertiary' );
		$style .= self::generate_css_var( '--text-color-heading', 'wps_text_color_heading' );
		$style .= self::generate_css_var( '--text-color-light', 'wps_text_color_light' );
		$style .= self::generate_css_var( '--text-color-body', 'wps_text_color_body' );
		$style .= self::generate_css_var( '--text-color-link', 'wps_text_color_link' );
		$style .= self::generate_css_var( '--background-color-one', 'wps_background_color_one' );
		$style .= self::generate_css_var( '--background-color-two', 'wps_background_color_two' );
		$style .= self::generate_css_var( '--background-color-three', 'wps_background_color_three' );
		$style .= self::generate_css_var( '--background-color-four', 'wps_background_color_four' );
		$style .= self::generate_css_var( '--background-color-five', 'wps_background_color_five' );
		$style .= self::generate_css_var( '--background-color-six', 'wps_background_color_six' );
		$style .= self::generate_css_var( '--background-color-light', 'wps_background_color_light' );
		$style .= self::generate_css_var( '--background-color-dark', 'wps_background_color_dark' );
		$style .= self::generate_css_var( '--background-color-body', 'wps_background_color_body' );
		$style .= self::generate_css_var( '--button-color-default', 'wps_button_color_default' );
		$style .= self::generate_css_var_hex( '--button-color-default-h', 'wps_button_color_default', false, wps_pharse_defaults( 'button-color-default' ) );
		$style .= self::generate_css_var( '--button-color-primary', 'wps_button_color_primary' );
		$style .= self::generate_css_var_hex( '--button-color-primary-h', 'wps_button_color_primary', false, wps_pharse_defaults( 'button-color-primary' ) );
		$style .= self::generate_css_var( '--button-color-secondary', 'wps_button_color_secondary' );
		$style .= self::generate_css_var_hex( '--button-color-secondary-h', 'wps_button_color_secondary', false, wps_pharse_defaults( 'button-color-secondary' ) );
		$style .= self::generate_css_var( '--button-color-tertiary', 'wps_button_color_tertiary' );
		$style .= self::generate_css_var_hex( '--button-color-tertiary-h', 'wps_button_color_tertiary', false, wps_pharse_defaults( 'button-color-tertiary' ) );
		$style .= self::generate_css_var( '--button-color-negative', 'wps_button_color_negative' );
		$style .= self::generate_css_var_hex( '--button-color-negative-h', 'wps_button_color_negative', false, wps_pharse_defaults( 'button-color-negative' ) );
		$style .= self::generate_css_var( '--button-color-positive', 'wps_button_color_positive' );
		$style .= self::generate_css_var_hex( '--button-color-positive-h', 'wps_button_color_positive', false, wps_pharse_defaults( 'button-color-positive' ) );
		$style .= self::generate_css_var( '--button-color-neutral', 'wps_button_color_neutral' );
		$style .= self::generate_css_var_hex( '--button-color-neutral-h', 'wps_button_color_neutral', false, wps_pharse_defaults( 'button-color-neutral' ) );
		$style .= self::generate_css_var( '--button-color-light', 'wps_button_color_light' );
		$style .= self::generate_css_var_hex( '--button-color-light-h', 'wps_button_color_light', false, wps_pharse_defaults( 'button-color-light' ) );
		$style .= self::generate_css_var( '--button-color-white', 'wps_button_color_white' );
		$style .= self::generate_css_var_hex( '--button-color-white-h', 'wps_button_color_white', false, wps_pharse_defaults( 'button-color-white' ) );
		$style .= '}';
		return $style;
	}

	public static function customizer_output() {
		$output  = '<!--Customizer CSS-->';
		$output .= '<style type="text/css">';
		$output .= self::customizer_style();
		$output .= '</style>';
		$output .= '<!--/Customizer CSS-->';
		echo $output;
	}
	/**
	 * This outputs the javascript needed to automate the live settings preview.
	 * Also keep in mind that this function isn't necessary unless your settings
	 * are using 'transport'=>'postMessage' instead of the default 'transport'
	 * => 'refresh'
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @see add_action('customize_preview_init',$func)
	 * @since WPS-PRIME 2.0
	 */
	public static function live_preview() {
		wp_enqueue_script(
			'wps-prime-themecustomizer', // Give the script a unique ID
			get_template_directory_uri() . '/js/customizer.js', // Define the path to the JS file
			array( 'jquery', 'customize-preview' ), // Define dependencies
			'', // Define a version (optional)
			true // Specify whether to put in footer (leave this true)
		);
	}

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 * @param string $selector CSS selector
	 * @param string $style The name of the CSS *property* to modify
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param string $prefix Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix Optional. Anything that needs to be output after the CSS property
	 * @param bool   $echo Optional. Whether to print directly to the page (default: true).
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since WPS-PRIME 2.0
	 */
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = false ) {
		$return = '';
		$mod    = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf(
				'%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
	public static function generate_css_var( $var_name, $mod_name, $echo = false ) {
		$return = '';
		$mod    = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf(
				'%s:%s;',
				$var_name,
				$mod
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}

	public static function generate_css_var_hex( $var_name, $mod_name, $echo = false, $default = false ) {
		$return     = '';
		$mod        = get_theme_mod( $mod_name );
		$luminosity = get_theme_mod( 'wps_button_color_hover_modifier', '-0.2' );

		// If mod or luminosity is set
		if ( ! empty( $mod ) || $luminosity ) {

			// If mod is empty set it to default
			if ( empty( $mod ) ) {

				// If default is empty value just return otherwhise will cause error by not delivering HEX to luminance function
				// This will cause:
				// In backend customizer the effect will be visiable because it is using customizer.js to update the setting
				// On front end the update will not happen because it will not be pharsed / storred
				if ( ! empty( $default ) ) {
					$mod = $default;
				} else {
					return $return;
				}
			}

			$return = sprintf(
				'%s:%s;',
				$var_name,
				( new self() )->luminance( $mod, $luminosity )
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}

	private function luminance( $hex, $percent ) {
			// validate hex string
			$hex     = preg_replace( '/[^0-9a-f]/i', '', $hex );
			$new_hex = '#';

		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}

			// convert to decimal and change luminosity
		for ( $i = 0; $i < 3; $i++ ) {
			$dec      = hexdec( substr( $hex, $i * 2, 2 ) );
			$dec      = min( max( 0, $dec + $dec * $percent ), 255 );
			$new_hex .= str_pad( dechex( $dec ), 2, 0, STR_PAD_LEFT );
		}
			return $new_hex;
	}
}


// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', array( 'WPS_Prime_Customize', 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head', array( 'WPS_Prime_Customize', 'customizer_output' ) );
add_action( 'admin_head', array( 'WPS_Prime_Customize', 'customizer_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', array( 'WPS_Prime_Customize', 'live_preview' ) );
