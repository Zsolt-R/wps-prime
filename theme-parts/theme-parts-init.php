<?php
/**
 * THEME PARTS INIT
 *
 * Theme parts load theme objects.
 * Always load theme objects first and then theme parts
 *
 * @package wps_prime
 */

/* Theme Objects */
require_once( 'theme-objects/theme-site-nav.php' );
require_once( 'theme-objects/theme-site-logo.php' );

/* Theme Parts */
require_once( 'theme-header/theme-header-layout.php' );
require_once( 'theme-footer/theme-footer-parts.php' );
