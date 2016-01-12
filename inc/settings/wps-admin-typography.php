<?php
/**
 *  Typography settings
 *
 * @package wps_prime
 */

/* Add fonts */
$myfont = wps_generateThemeFonts::getInstance();

$myfont->addFont('Open Sans',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800&subset=latin,latin-ext'
);

$myfont->addFont('Merriweather',
	'serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Merriweather:300,400,700,900&subset=latin,latin-ext'
);

$myfont->addFont('Raleway',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Raleway:200,300,400,600,900&subset=latin,latin-ext'
);

$myfont->addFont('Lato',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&subset=latin,latin-ext'
);

$myfont->addFont('Roboto',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext'
);

$myfont->addFont('Source Sans Pro',
	'sans-serif;font-weight: 300',
	'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&subset=latin,latin-ext'
);

$myfont->addFont('PT Sans',
	'sans-serif;font-weight: 400',
	'http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,latin-ext'
);
