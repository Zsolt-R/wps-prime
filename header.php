<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPS_Prime_2
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,height=device-height,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wps-prime' ); ?></a>
	<?php before_header(); ?>

	<header id="masthead"<?php echo site_header_class(); ?> role="banner">
	<?php mast_head_start(); ?>
	<div class="o-wrapper"><div class="grid-1 grid-middle"><?php theme_header(); ?></div><!--grid--></div><!--o-wrapper-->
	<?php mast_head_end(); ?>
	</header><!-- #masthead -->
	<?php after_header(); ?>
	<?php before_content(); ?>
	<div id="content"<?php echo site_content_class(); ?>>
	<?php content_start(); ?>