<?php

/**
 *    20 Social Links.
 */
function wps_social_links_shortcode( $atts ) {
	$options = shortcode_atts(
		array(
			'list'        => false,
			'ico_class'   => '',
			'link_class'  => '',
			'label_class' => '',
			'target'      => '',
			'list_class'  => '',
		),
		$atts
	);

	$output = $listStart = $listEnd = $listItemStart = $listItemEnd = '';

	$hidelabel = $options['list'] ? '' : 'u-hide';

	$classLink  = wps_getExtraClass( array( 'c-social-list__link', $options['link_class'] ) );
	$classIco   = wps_getExtraClass( array( 'c-social-list__ico', $options['ico_class'], 'svg-inline--fa' ) );
	$classList  = wps_getExtraClass( array( 'c-social-list', $options['list_class'] ) );
	$classLabel = wps_getExtraClass( array( 'c-social-list__label', $options['label_class'], $hidelabel ) );

	$target = $options['target'] ? ' target="_blank"' : '';

	$facebook    = get_option( 'wps_social_link_facebook' );
	$instagram   = get_option( 'wps_social_link_instagram' );
	$twitter     = get_option( 'wps_social_link_twitter' );
	$linkedIn    = get_option( 'wps_social_link_linkedin' );
	$gmybusiness = get_option( 'wps_social_link_gbusiness' );
	$youtube     = get_option( 'wps_social_link_youtube' );
	$flickr      = get_option( 'wps_social_link_flickr' );
	$vimeo       = get_option( 'wps_social_link_vimeo' );
	$pinterest   = get_option( 'wps_social_link_pinterest' );
	$medium      = get_option( 'wps_social_link_medium' );

	if ( $options['list'] ) {
		$listStart     = '<ul class="' . $classList . '">';
		$listEnd       = '</ul>';
		$listItemStart = '<li class="c-social-list__item">';
		$listItemEnd   = '</li>';
	}

	$social_icon = '';
	if ( $facebook ) {
		$social_icon = '<svg class="fa-facebook-f fa-w-9' . $classIco . '" aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg=""><path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $facebook . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Facebook</span></a>' . $listItemEnd;
	}

	if ( $instagram ) {
		$social_icon = '<svg class="fa-instagram fa-w-14' . $classIco . '" aria-hidden="true" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $instagram . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Instagram</span></a>' . $listItemEnd;
	}

	if ( $twitter ) {
		$social_icon = '<svg class="fa-twitter fa-w-16' . $classIco . '" aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $twitter . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Twitter</span></a>' . $listItemEnd;
	}

	if ( $linkedIn ) {
		$social_icon = '<svg class="fa-linkedin-in fa-w-14' . $classIco . '" aria-hidden="true" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M100.3 448H7.4V148.9h92.9V448zM53.8 108.1C24.1 108.1 0 83.5 0 53.8S24.1 0 53.8 0s53.8 24.1 53.8 53.8-24.1 54.3-53.8 54.3zM448 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448h-.1z"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $linkedIn . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">LinkedIn</span></a>' . $listItemEnd;
	}

	if ( $gmybusiness ) {
		$social_icon = '<svg class="fa-google fa-w-16' . $classIco . '"aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" class=""></path></svg>';
		$output     .= $listItemStart . '<a href="' . $gmybusiness . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">My Business</span></a>' . $listItemEnd;
	}

	if ( $youtube ) {
		$social_icon = '<svg class="fa-youtube fa-w-18' . $classIco . '" aria-hidden="true" data-prefix="fab" data-icon="youtube" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $youtube . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Youtube</span></a>' . $listItemEnd;
	}

	if ( $vimeo ) {
		$social_icon = '<svg class="fa-vimeo fa-w-14' . $classIco . '" aria-hidden="true" data-prefix="fab" data-icon="vimeo" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M403.2 32H44.8C20.1 32 0 52.1 0 76.8v358.4C0 459.9 20.1 480 44.8 480h358.4c24.7 0 44.8-20.1 44.8-44.8V76.8c0-24.7-20.1-44.8-44.8-44.8zM377 180.8c-1.4 31.5-23.4 74.7-66 129.4-44 57.2-81.3 85.8-111.7 85.8-18.9 0-34.8-17.4-47.9-52.3-25.5-93.3-36.4-148-57.4-148-2.4 0-10.9 5.1-25.4 15.2l-15.2-19.6c37.3-32.8 72.9-69.2 95.2-71.2 25.2-2.4 40.7 14.8 46.5 51.7 20.7 131.2 29.9 151 67.6 91.6 13.5-21.4 20.8-37.7 21.8-48.9 3.5-33.2-25.9-30.9-45.8-22.4 15.9-52.1 46.3-77.4 91.2-76 33.3.9 49 22.5 47.1 64.7z"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $vimeo . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Vimeo</span></a>' . $listItemEnd;
	}

	if ( $flickr ) {
		$social_icon = '<svg class="fa-flickr fa-w-14' . $classIco . '" aria-hidden="true" data-prefix="fab" data-icon="flickr" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM144.5 319c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5zm159 0c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5z"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $flickr . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Flickr</span></a>' . $listItemEnd;
	}

	if ( $pinterest ) {
		$social_icon = '<svg class="fa-pinterest fa-w-16' . $classIco . '" aria-hidden="true" data-prefix="fab" data-icon="pinterest" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $pinterest . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Pinterest</span></a>' . $listItemEnd;
	}

	if ( $medium ) {
		$social_icon = '<svg class="fa-medium-m fa-w-16' . $classIco . '" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="medium-m" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M71.5 142.3c.6-5.9-1.7-11.8-6.1-15.8L20.3 72.1V64h140.2l108.4 237.7L364.2 64h133.7v8.1l-38.6 37c-3.3 2.5-5 6.7-4.3 10.8v272c-.7 4.1 1 8.3 4.3 10.8l37.7 37v8.1H307.3v-8.1l39.1-37.9c3.8-3.8 3.8-5 3.8-10.8V171.2L241.5 447.1h-14.7L100.4 171.2v184.9c-1.1 7.8 1.5 15.6 7 21.2l50.8 61.6v8.1h-144v-8L65 377.3c5.4-5.6 7.9-13.5 6.5-21.2V142.3z"></path></svg>';
		$output     .= $listItemStart . '<a href="' . $medium . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Medium</span></a>' . $listItemEnd;
	}

	$output = $listStart . $output . $listEnd;

	return $output;
}
