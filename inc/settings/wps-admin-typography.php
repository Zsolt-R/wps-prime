<?php
/**
 *  Typography settings
 *
 * @package wps_prime
 */

/* Add fonts */
$myfont = WpsGenerateThemeFonts::get_instance();

$myfont->add_font('Open Sans',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800'
);

$myfont->add_font('Merriweather',
	'serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Merriweather:300,400,700,900'
);

$myfont->add_font('Raleway',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Raleway:200,300,400,600,900'
);

$myfont->add_font('Lato',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900'
);

$myfont->add_font('Roboto',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'
);

$myfont->add_font('Source Sans Pro',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900'
);

$myfont->add_font('PT Sans',
	'sans-serif;font-weight: 400',
	'http://fonts.googleapis.com/css?family=PT+Sans:400,700'
);
