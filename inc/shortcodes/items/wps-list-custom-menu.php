<?php

function wps_list_custom_menu_shortcode( $atts ) {
	$options = shortcode_atts(
		array(
			'menu'            => '',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'wps-custom-menu-list',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 0,
			'walker'          => '',
			'theme_location'  => '',
			'level'           => 0,
		),
		$atts,
		'wps_list_custom_menu'
	);

	$menu = wp_nav_menu(
		array(
			'menu'            => $options['menu'],
			'container'       => $options['container'],
			'container_class' => $options['container_class'],
			'container_id'    => $options['container_id'],
			'menu_class'      => $options['menu_class'],
			'menu_id'         => $options['menu_id'],
			'echo'            => false,
			'fallback_cb'     => $options['fallback_cb'],
			'before'          => $options['before'],
			'after'           => $options['after'],
			'link_before'     => $options['link_before'],
			'link_after'      => $options['link_after'],
			'depth'           => $options['depth'],
			'walker'          => $options['walker'],
			'theme_location'  => $options['theme_location'],
			'level'           => $options['level'],
		)
	);

	return $menu;
}
