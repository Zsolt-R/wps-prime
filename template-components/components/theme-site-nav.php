<?php
/**
 * Theme Site Nav.
 *
 * Contains the main site Nav
 *
 * @package wps_prime
 */

if ( ! function_exists( 'main_site_nav' ) ) {
	/**
	 * Main site navigation
	 * mobile navigation toggle button
	 */
	function main_site_nav() {

		echo '<nav id="site-nav"'. main_nav_class() .' role="navigation" data-ui-component="site-main-nav">';

		wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'site-nav__list', 'walker' => new Theme_Menu_Object() ) );
		echo '</nav><!-- #site-nav -->';

	}
}

if ( ! function_exists( 'main_site_nav_mobile' ) ) {
	/**
	 * Main site navigation
	 * mobile navigation toggle button
	 */
	function main_site_nav_mobile() {

		echo '<nav id="site-mobile-nav"'. main_mobile_nav_class() .' role="navigation-mobile" data-ui-component="site-main-nav-mobile">';

		wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'site-mobile-nav__list', 'walker' => new Theme_Menu_Object() ) );
		echo '</nav><!-- #site-mobile-nav -->';

	}
}

if ( ! function_exists( 'main_site_mobile_nav_toggler' ) ) {

function main_site_mobile_nav_toggler() {

		$ico = '<div class="site-mobile-nav-icon"><span></span><span></span><span></span><span></span></div>';

		echo '<button class="site-mobile-nav-toggler"  id="nav-toggler" data-ui-component="menu-toggle-button">';
		echo $ico;
		echo '</button>';

		}

}
