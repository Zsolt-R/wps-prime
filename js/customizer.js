/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	function pSBC(p, from, to) {
		if(typeof(p)!="number"||p<-1||p>1||typeof(from)!="string"||(from[0]!='r'&&from[0]!='#')||(to&&typeof(to)!="string"))return null; //ErrorCheck
		if(!this.pSBCr)this.pSBCr=(d)=>{
			let l=d.length,RGB={};
			if(l>9){
				d=d.split(",");
				if(d.length<3||d.length>4)return null;//ErrorCheck
				RGB[0]=i(d[0].split("(")[1]),RGB[1]=i(d[1]),RGB[2]=i(d[2]),RGB[3]=d[3]?parseFloat(d[3]):-1;
			}else{
				if(l==8||l==6||l<4)return null; //ErrorCheck
				if(l<6)d="#"+d[1]+d[1]+d[2]+d[2]+d[3]+d[3]+(l>4?d[4]+""+d[4]:""); //3 or 4 digit
				d=i(d.slice(1),16),RGB[0]=d>>16&255,RGB[1]=d>>8&255,RGB[2]=d&255,RGB[3]=-1;
				if(l==9||l==5)RGB[3]=r((RGB[2]/255)*10000)/10000,RGB[2]=RGB[1],RGB[1]=RGB[0],RGB[0]=d>>24&255;
			}
			return RGB;}
		var i=parseInt,r=Math.round,h=from.length>9,h=typeof(to)=="string"?to.length>9?true:to=="c"?!h:false:h,b=p<0,p=b?p*-1:p,to=to&&to!="c"?to:b?"#000000":"#FFFFFF",f=this.pSBCr(from),t=this.pSBCr(to);
		if(!f||!t)return null; //ErrorCheck
		if(h)return "rgb"+(f[3]>-1||t[3]>-1?"a(":"(")+r((t[0]-f[0])*p+f[0])+","+r((t[1]-f[1])*p+f[1])+","+r((t[2]-f[2])*p+f[2])+(f[3]<0&&t[3]<0?")":","+(f[3]>-1&&t[3]>-1?r(((t[3]-f[3])*p+f[3])*10000)/10000:t[3]<0?f[3]:t[3])+")");
		else return "#"+(0x100000000+r((t[0]-f[0])*p+f[0])*0x1000000+r((t[1]-f[1])*p+f[1])*0x10000+r((t[2]-f[2])*p+f[2])*0x100+(f[3]>-1&&t[3]>-1?r(((t[3]-f[3])*p+f[3])*255):t[3]>-1?r(t[3]*255):f[3]>-1?r(f[3]*255):255)).toString(16).slice(1,f[3]>-1||t[3]>-1?undefined:-2);
	}

	///////////////////////////////////
	//	Text colors
	//////////////////////////////////

	wp.customize( 'wps_text_color_body', function( value ) {		
		value.bind( function( newval ) {						
			document.documentElement.style.setProperty(
					'--text-color-body',newval,
				);			
			} );
	} );

	wp.customize( 'wps_text_color_link', function( value ) {		
		value.bind( function( newval ) {					
			document.documentElement.style.setProperty(
					'--text-color-link',newval,
				);			
			} );
	} );

	wp.customize( 'wps_text_color_heading', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
				'--text-color-heading',newval,
			);		
		} );
	} );

	wp.customize( 'wps_text_color_light', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
				'--text-color-light',newval,
			);		
		} );
	} );
	wp.customize( 'wps_text_color_primary', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--text-color-primary',newval,
			);			
		} );
	} );

	wp.customize( 'wps_text_color_secondary', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--text-color-secondary',newval,
			);			
		} );
	} );
	
	wp.customize( 'wps_text_color_tertiary', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--text-color-tertiary',newval,
			);			
		} );
	} );

	///////////////////////////////////
	//	Background colors
	//////////////////////////////////
	wp.customize( 'wps_background_color_one', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--background-color-one',newval,
			);			
		} );
	} );

	wp.customize( 'wps_background_color_two', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--background-color-two',newval,
			);			
		} );
	} );

	wp.customize( 'wps_background_color_three', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--background-color-three',newval,
			);			
		} );
	} );

	wp.customize( 'wps_background_color_four', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--background-color-four',newval,
			);			
		} );
	} );

	wp.customize( 'wps_background_color_five', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--background-color-five',newval,
			);			
		} );
	} );

	wp.customize( 'wps_background_color_six', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--background-color-six',newval,
			);			
		} );
	} );

	wp.customize( 'wps_background_color_light', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--background-color-light',newval,
			);			
		} );
	} );

	wp.customize( 'wps_background_color_dark', function( value ) {
		value.bind( function( newval ) {			
		document.documentElement.style.setProperty(
				'--background-color-dark',newval,
			);			
		} );
	} );

	wp.customize( 'wps_background_color_body', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--background-color-body',newval,
				);			
			} );
	} );

	///////////////////////////////////
	//	Button colors
	//////////////////////////////////

	wp.customize( 'wps_button_color_default', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-default',newval,
				);	
			document.documentElement.style.setProperty(
					'--button-color-default-h',pSBC ( -0.3, newval ),
				);									
			} );
	} );

	wp.customize( 'wps_button_color_primary', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-primary',newval,
				);
			document.documentElement.style.setProperty(
					'--button-color-primary-h',pSBC ( -0.3, newval ),
				);			
			} );
	} );

	wp.customize( 'wps_button_color_secondary', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-secondary', newval,
				);
			document.documentElement.style.setProperty(
					'--button-color-secondary-h',pSBC ( -0.3, newval ),
				);			
			} );
	} );

	wp.customize( 'wps_button_color_tertiary', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-tertiary', newval,
				);	
			document.documentElement.style.setProperty(
					'--button-color-tertiary-h',pSBC ( -0.3, newval ),
				);			
			} );
	} );

	wp.customize( 'wps_button_color_negative', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-negative',newval,
				);
			document.documentElement.style.setProperty(
					'--button-color-negative-h',pSBC ( -0.3, newval ),
				);				
			} );
	} );

	wp.customize( 'wps_button_color_positive', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-positive',newval,
				);
			document.documentElement.style.setProperty(
					'--button-color-positive-h',pSBC ( -0.3, newval ),
				);			
			} );
	} );

	wp.customize( 'wps_button_color_neutral', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-neutral',newval,
				);			
			document.documentElement.style.setProperty(
					'--button-color-neutral-h',pSBC ( -0.3, newval ),
				);	
			} );
	} );

	wp.customize( 'wps_button_color_light', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-light',newval,
				);			
			document.documentElement.style.setProperty(
					'--button-color-light-h',pSBC ( -0.3, newval ),
				);
			} );
	} );

	wp.customize( 'wps_button_color_white', function( value ) {
		value.bind( function( newval ) {			
			document.documentElement.style.setProperty(
					'--button-color-white',newval,
				);	
			document.documentElement.style.setProperty(
					'--button-color-white-h',pSBC ( -0.3, newval ),
				);		
			} );
	} );

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'wps_site_disclaimer', function( value ) {
		value.bind( function( to ) {
			$( '.site-disclaimer' ).text( to );
		} );
	} );
	wp.customize( 'wps_global_content_end_area', function( value ) {
		value.bind( function( to ) {
			$( '.site-global-content-end' ).text( to );
		} );
	} );	
	wp.customize( 'wps_global_content_start_area', function( value ) {
		value.bind( function( to ) {
			$( '.site-global-content-start' ).text( to );
		} );
	} );
} )( jQuery );
