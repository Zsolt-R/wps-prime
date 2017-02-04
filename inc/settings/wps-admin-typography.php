<?php
/**
 *  Typography settings
 *
 * @package wps_prime
 */

/* Add fonts */
$myfont = WpsGenerateThemeFonts::get_instance();

$myfont->add_font('Open Sans',
	'sans-serif',
	'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800',
	'font-weight: 300',
	'font-weight: 600'
);

$myfont->add_font('Merriweather',
	'serif',
	'https://fonts.googleapis.com/css?family=Merriweather:300,400,700,900',
	'font-weight: 300',
	'font-weight: 900'
);

$myfont->add_font('Raleway',
	'sans-serif',
	'https://fonts.googleapis.com/css?family=Raleway:200,300,400,600,900',
	'font-weight: 300',
	'font-weight: 600'
);

$myfont->add_font('Lato',
	'sans-serif',
	'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900',
	'font-weight: 300',
	'font-weight: 600'
);

$myfont->add_font('Roboto',
	'sans-serif',
	'https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900',
	'font-weight: 300',
	'font-weight: 600'
);

$myfont->add_font('Source Sans Pro',
	'sans-serif',
	'https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900',
	'font-weight: 300',
	'font-weight: 900'
);

$myfont->add_font('PT Sans',
	'sans-serif',
	'https://fonts.googleapis.com/css?family=PT+Sans:400,700',
	'font-weight: 400',
	'font-weight: 700'
);
