<?php
/**
 * Theme Site Logo.
 *
 * Contains the main site Logo
 */

/**
 * Website logo function.
 */
if (!function_exists('wps_site_branding_logo')) {
    function wps_site_branding_logo()
    {
        if (!get_option('wps_branding_company_logo')) {
            return false;
        }

        return get_option('wps_branding_company_logo');
    }
}

if (!function_exists('wps_theme_site_logo')) {
    function wps_theme_site_logo()
    {
        $output = '';
        $logo_img = wps_site_branding_logo();

        /*
             * Logo HTML wrapper
             */
        $output .= '<div class="site-branding">';

        if (!$logo_img) {
            if (is_front_page() && is_home()) {
                $html_tag = 'h1';
            } else {
                $html_tag = 'p';
            }

            $output .= '<'.$html_tag.' class="site-title"><a href="'.esc_url(home_url('/')).'" rel="home">'.get_bloginfo('name').'</a></'.$html_tag.'>';

            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) {
                $output .= '<p class="site-description">'.$description.'</p>'; /* WPCS: xss ok. */
            }
        } else {
            $output .= '<a title="'.get_bloginfo('name').'" href="'.esc_url(home_url('/')).'"><span class="site-branding-logo">';

            // Check if svg file
            if (strpos($logo_img, '.svg') !== false) {
                $logo_id = wps_get_image_id($logo_img);
                $get_file_location = get_attached_file($logo_id);
                $output .= file_get_contents($get_file_location);
            } else {
                $output .= '<img src="'.$logo_img.'" alt="'.get_bloginfo('name').'" class="site-branding-logo brand-logo site-logo"/>';
            }

            $output .= '</span></a>';
        }

        $output .= '</div><!-- .site-branding -->';

        echo $output; /* WPCS: xss ok. */
    }
}
