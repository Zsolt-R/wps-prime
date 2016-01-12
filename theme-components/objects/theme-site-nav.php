<?php
/**
 * Theme Site Nav.
 *
 * Contains the main site Nav
 *
 * @package wps_prime
 */

if ( ! function_exists( 'theme_site_navigation' ) ) {
	/**
	 * Main site navigation
	 * mobile navigation toggle button
	 */
	function theme_site_navigation() {

		echo '<nav id="site-navigation"';
		main_nav_class();
		echo ' role="navigation" data-ui-component="site-main-navigation">';

		echo '<button class="site-nav__toggler" data-ui-component="menu-toggle-button">';
		echo esc_html( 'Menu', 'wps-prime' );
		echo '</button>';

		wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'site-nav__list', 'walker' => new Theme_Menu_Object() ) );
		echo '</nav><!-- #site-navigation -->';

	}
}
