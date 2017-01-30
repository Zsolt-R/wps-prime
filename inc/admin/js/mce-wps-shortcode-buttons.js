// ref: https://www.gavick.com/blog/wordpress-tinymce-custom-buttons
(function() {

    // Predefined widths
    var generateWidths = function(prefix){

        this.prefix = prefix || '';

        var values = [{text: '----',    value: ''},
                      {text: '1/12 - One Column',    value: prefix+'1'},
                      {text: '2/12 - Two Columns',    value: prefix+'2'},
                      {text: '3/12 - Three Columns',    value: prefix+'3'},
                      {text: '4/12 - Four Columns',    value: prefix+'4'},
                      {text: '5/12 - Five Columns',    value: prefix+'5'},
                      {text: '6/12 - Six Columns',    value: prefix+'6'},
                      {text: '7/12 - Seven Columns',    value: prefix+'7'},
                      {text: '8/12 - Eight Columns',    value: prefix+'8'},
                      {text: '9/12 - Nine Columns',    value: prefix+'9'},
                      {text: '10/12 - Ten Columns',    value: prefix+'10'},
                      {text: '11/12 - Eleven Columns',    value: prefix+'11'},
                      {text: '12/12 - Eleven Columns',    value: prefix+'12'},
                      ];

                return values;
            };

    // Predefined button classes
    var predefinedButtonCss = function(){

        var values = { importance: [
                            {text:'Default',value:''},
                            {text:'Primary',value:'c-button--primary'},
                            {text:'Secondary',value:'c-button--secondary'},
                            {text:'Tertiary',value:'c-button--tertiary'}
                        ],
                        sizes: [
                            {text:'Normal',value:''},
                            {text:'Small',value:'c-button--small'},
                            {text:'Large',value:'c-button--large'}
                        ]
                    };
        return values;
    }; 

    // Predefined color classes
    var predefinedHighlightCss = function(){

        var values = { background: [
                            {text:'Default',value:''},
                            {text:'Bg color one',value:'u-background-color-one'},
                            {text:'Bg color two',value:'u-background-color-two'},
                            {text:'Bg color three',value:'u-background-color-three'},
                            {text:'Bg color four',value:'u-background-color-four'},
                            {text:'Bg color five',value:'u-background-color-five'},
                            {text:'Bg color six',value:'u-background-color-six'},
                            {text:'Bg color body',value:'u-background-body'},
                            {text:'Bg color light',value:'u-background-light'},
                            {text:'Bg color dark',value:'u-background-dark'}
                        ],
                        colors: [
                            {text:'None',value:''},
                            {text:'Invert (usually white)',value:'u-text-color-invert'},
                            {text:'Light',value:'u-text-color-light'},
                            {text:'Primary',value:'u-text-color-primary'},
                            {text:'Secondary',value:'u-text-color-secondary'},
                            {text:'Tertiary',value:'u-text-color-tertiary'},
                        ],
                        size: [
                            {text:'Default',value:''},
                            {text:'Small',value:'u-text-small'},
                            {text:'Large',value:'u-text-large'},
                            {text:'Huge',value:'u-text-huge'}
                        ],
                        weight: [
                            {text:'Default',value:''},
                            {text:'Normal',value:'u-text-normal'},
                            {text:'Thinner',value:'u-text-thinner'},
                            {text:'Thin',value:'u-text-thin'},
                            {text:'Bold',value:'u-text-bold'},
                            {text:'Bolder',value:'u-text-bolder'}
                        ]
                    };
        return values;
    }; 

    // Predefined list classes
    var predefinedListStyles = function(){

        var values = { listtypes: [
                            {text:'Style None',value:''},
                            {text:'Style One',value:'u-list--style-one'},
                            {text:'Style two',value:'u-list--style-two'},
                            {text:'Style three',value:'u-list--style-three'},
                            {text:'Style four',value:'u-list--style-four'},
                            {text:'Style five',value:'u-list--style-five'},
                            {text:'Style six',value:'u-list--style-six'},
                            {text:'Style seven',value:'u-list--style-seven'},
                            {text:'Style eight',value:'u-list--style-eight'},
                            {text:'Style nine',value:'u-list--style-nine'},
                            {text:'Style ten',value:'u-list--style-ten'}
                        ]
                    };
        return values;
    }; 

    // Return classes based on options
    var getCssClass = function(options){

        this.options = options || '';

        var result = '';

        if(this.options !== ''){
            var classes = '';
    
                options.forEach(function(entry){
                    if(entry)
                    classes += ' '+ entry;                                 
                });                             
    
            var result = classes !== '' ? ' class="'+ classes.trim() +'"' : '';

        }

        return result;

    }  


    tinymce.PluginManager.add('wps_shortcode_buttons', function( editor, url ) {

        var buttonCss = predefinedButtonCss();
        var highlightCss = predefinedHighlightCss();
                        

        editor.addButton( 'wps_shortcode_buttons', {
            title: editor.getLang('wps_button.button_label'),        
            type: 'menubutton',
            icon: 'icon wps-own-icon',
            menu: [{
                    text: 'Layouts',
                    icon: 'icon dashicons-feedback',
                    menu: [{
                text:'Column',
                icon: 'icon dashicons-editor-contract',
                onclick: function() {

                     editor.windowManager.open( {
                        title: 'Insert row item', 
                        body: [{
                                type: 'textbox',
                                name: 'itemClassOpt',
                                label: 'Optional CSS class'
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth1',
                            label: 'Width: palm (max-width: 44.9375em)',
                            'values': new generateWidths('_palm-')
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth2',
                            label: 'Width: lap ((min-width: 45em) and (max-width: 63.9375em))',
                            'values': new generateWidths('_lap-')
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth3',
                            label: 'Width: _lap-and-up (min-width: 45em)',
                            'values': new generateWidths('_lap-and-up-')
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth4',
                            label: 'Width: portable (max-width: 63.9375em)',
                            'values': new generateWidths('_portable-')
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth5',
                            label: 'Width: desktop (min-width: 64em)',
                            'values': new generateWidths('_desktop-')
                            }],

                            onsubmit: function( e ) {
                                    // Collect all the class selections
                                    var options = [e.data.itemWidth1,e.data.itemWidth2,e.data.itemWidth3,e.data.itemWidth4,e.data.itemWidth5,e.data.itemClassOpt];
                       
                                    // Return the shortcode to editor.
                                    // Check if there is a valid css declaration and trim first and last space using trim
                                    editor.insertContent('[wps_col' + getCssClass(options) +']'+ editor.selection.getContent() +'[/wps_col]');
                            }

                     });                    
                }
            },
            {
                text:'Row',
                icon: 'icon dashicons-editor-expand',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert row wrapper', 
                        body: [{
                                type: 'textbox',
                                name: 'rowWrapperClass',
                                label: 'Optional CSS class'
                            },
                            { 
                            type: 'listbox',                                
                            name: 'rowWrapperState',
                            label: 'Add Wrapper',
                            'values': [
                                {text: 'No', value: 'false'},
                                {text: 'Yes', value: 'true'},
                            ]

                        }],
                        onsubmit: function( e ) {
                            editor.insertContent('[wps_row wrapper="'+ e.data.rowWrapperState +'"'+ (e.data.rowWrapperClass !== '' ? ' class="'+ e.data.rowWrapperClass +'"' : '') + ']' + editor.selection.getContent() +'[/wps_row]');
                        }
                    });
                }              

            }]
                },
                {
                text:'Buttons',
                icon: 'icon dashicons-admin-page',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert button', 
                        body: [{
                                type: 'textbox',
                                name: 'buttonInfotext',
                                label: 'Infotext'
                            },
                            {
                                type: 'textbox',
                                name: 'buttonLink',
                                label: 'Link'
                            },
                            {
                                type: 'listbox',
                                name: 'buttonClassImp',
                                label:'Importance',
                                'values': buttonCss.importance
                            },
                            {
                                type: 'listbox',
                                name: 'buttonClassSize',
                                label:'Size',
                                'values': buttonCss.sizes
                            },
                            {
                                type: 'textbox',
                                name: 'buttonClass',
                                label: 'Optional CSS class'
                            }],

                        onsubmit: function( e ) {

                            if(e.data.buttonInfotext === '' || e.data.buttonLink === '') {
                                var window_id = this._id;
                                var inputs = jQuery('#' + window_id + '-body').find('.mce-formitem input');

                                 editor.windowManager.alert('Please, fill in all fields in a popup.');

                                if(e.data.buttonInfotext === '') {
                                    jQuery(inputs.get(0)).css('border-color', 'red');
                                }
                        
                                if(e.data.buttonLink === '') {
                                    jQuery(inputs.get(1)).css('border-color', 'red');
                                }

                                return false;
                             }

                             var options = [e.data.buttonClassImp,e.data.buttonClassSize,e.data.buttonClass];
                                    
                            editor.insertContent('[wps_button '+ getCssClass(options) + ' link="'+ e.data.buttonLink +'" label="'+ e.data.buttonInfotext +'"]');
                        }
                    });
                }
                },
                {
                text:'Icons',
                icon: 'icon dashicons-nametag',
                onclick: function() {
                        editor.windowManager.open( {
                            title: 'Add icon',                         
                            body: [{
                                type: 'textbox',
                                name: 'iconClass',
                                label: 'Fontawesome Icon CSS ex.fa fa-bluetooth ( http://fontawesome.io/icons/ )',
                            },
                            {
                                type: 'textbox',
                                name: 'iconLink',
                                label: 'Link'
                            },
                            { 
                            type: 'listbox',                                
                            name: 'iconTarget',
                            label: 'link Target',
                            'values': [
                                {text: 'Default', value: 'false'},
                                {text: 'New Window', value: 'true'},
                            ]

                        }],
                            onsubmit: function( e ) {

                                var iLink ='';
                                var iTarget = '';

                                if(e.data.iconClass === ''){

                                    var window_id = this._id;
                                    var inputs = jQuery('#' + window_id + '-body').find('.mce-formitem input');

                                    editor.windowManager.alert('Please, fill in all fields in a popup.');

                                    if(e.data.iconClass === '') {
                                        jQuery(inputs.get(0)).css('border-color', 'red');
                                    }                                   

                                    return false;
                                }

                                if(e.data.iconLink !== '') {
                                        iLink = ' link="'+e.data.iconLink+'"';
                                    }

                                if(e.data.iconTarget !== 'false') {
                                        iTarget = ' target="_blank"';
                                }

                                editor.insertContent('[wps_ico class="'+ e.data.iconClass +'"'+iLink+iTarget+' html_tag="span"]');
                            }
                        });
                    }
                },
                {
                text:'Highlight',
                icon: 'icon dashicons-edit',
                onclick: function() {
                        editor.windowManager.open( {
                            title: 'Highlight Content',                         
                             body: [{
                                type: 'listbox',
                                name: 'contentBackground',
                                label:'Background',
                                'values': highlightCss.background
                            },
                            {
                                type: 'listbox',
                                name: 'contentColors',
                                label:'Color',
                                'values': highlightCss.colors
                            },
                            {
                                type: 'listbox',
                                name: 'contentSize',
                                label:'Size',
                                'values': highlightCss.size
                            },
                            {
                                type: 'listbox',
                                name: 'contentWeight',
                                label:'Weight',
                                'values': highlightCss.weight
                            },
                            {
                                type: 'textbox',
                                name: 'extraClass',
                                label: 'Optional CSS class'
                            }],
                            onsubmit: function( e ) {



                                var options = [e.data.contentBackground,e.data.contentColors,e.data.contentSize,e.data.contentWeight,e.data.extraClass];
                              
                                editor.insertContent('[wps_hglt'+ getCssClass(options) + ']'+ editor.selection.getContent() +'[/wps_hglt]');
                            }
                        });
                    }
                },
                {
                text:'Styled list',
                icon: 'icon dashicons-editor-ul',
                onclick: function() {
                        editor.windowManager.open( {
                            title: 'Add style to lists',                         
                            body: [{
                                type: 'listbox',
                                name: 'listType',
                                label: 'List Type',
                                values: predefinedListStyles().listtypes,
                                },
                                { type: 'textbox',
                                  name: 'listClass',
                                  label: 'Custom list class',
                                }],
                            onsubmit: function( e ) {

                                var options = [e.data.listType,e.data.listClass];
                                
                                editor.insertContent('[wps_list'+ getCssClass(options) + ']' + editor.selection.getContent() +'[/wps_list]');
                            }
                        });
                    }
                },
                {
                text:'Image Slider',
                icon:'icon dashicons-images-alt2',
                onclick: function() {
                        editor.windowManager.open( {
                            title: 'Add image slider',                         
                            body: [{
                                type:  'textbox',
                                name:  'imageIdList',
                                label: 'Add image id\'s separated by comma ex. 1,2,3 (see image id in media library)',
                              },
                              {   
                                type:  'textbox',
                                name:  'linkIdList',
                                label: 'Add link id\'s separated by comma ex. 56,78,99 (hover on edit link see the id in the bottom left after ?post= "number")',
                              },
                              {   
                                type:  'textbox',
                                name:  'imageSize',
                                label: 'ex. thumbnail | medium | medium-large | large | wps-prime-medium | wps_prime_full (Default: wps_prime_full)',
                              }],

                        onsubmit: function( e ) {

                            var slideImageLinks = ''

                            if(e.data.imageIdList === '') {
                                var window_id = this._id;
                                var inputs = jQuery('#' + window_id + '-body').find('.mce-formitem input');

                                 editor.windowManager.alert('Please, fill in all fields in a popup.');

                                if(e.data.imageIdList === '') {
                                    jQuery(inputs.get(0)).css('border-color', 'red');
                                }                       

                                return false;
                             }

                              if(e.data.linkIdList !== '') { 

                                  slideImageLinks = ' links="'+ e.data.linkIdList +'"';
                              }

                              if(e.data.imageSize !== ''){
                                imgSize = ' size="'+e.data.imageSize+'"';
                              }

                                    
                            editor.insertContent('[wps_slider images="'+ e.data.imageIdList +'"'+ slideImageLinks + imgSize +']');
                        }
                        });
                    }
                },
                {
                text:'Main Phone Number',
                icon: 'icon dashicons-phone',
                onclick: function() {
                        editor.windowManager.open( {
                            title: 'Add phone number',                         
                            body: [{
                                type: 'listbox',
                                name: 'link',
                                values: [
                                    {text: 'No', value: 'false'},
                                    {text: 'Yes', value: 'true'},
                                    ],
                                label: 'Wrap number in "tel:" link.',
                            },
                            {
                                type: 'listbox',
                                name: 'secondary',
                                values: [
                                    {text: 'No', value: 'false'},
                                    {text: 'Yes', value: 'true'},
                                    ],
                                label: 'Secondary Number',
                            },
                            {
                                type: 'textbox',
                                name: 'class',                                
                                label: 'Extra CSS class',
                            }],
                            onsubmit: function( e ) {

                                var link = '';
                                var secondary = '';
                                var cssClass = '';


                                if(e.data.link === 'true'){
                                 link = ' link="true"';
                                }
                                
                                if(e.data.secondary === 'true'){
                                 secondary = ' secondary="true"';
                                }

                                if(e.data.class !== ''){
                                  cssClass = ' class="'+e.data.class+'"';
                                }

                                editor.insertContent('[wps_main_phone_nr'+ link + secondary + cssClass +']');
                            }
                        });
                    }
                },
                {
                text: 'Main Email Address',
                icon: 'icon dashicons-email-alt',
                onclick: function() {
                        editor.windowManager.open( {
                            title: 'Add phone number',                         
                            body: [{
                                type: 'listbox',
                                name: 'link',
                                values: [
                                    {text: 'No', value: 'false'},
                                    {text: 'Yes', value: 'true'},
                                    ],
                                label: 'Wrap email in "mailto:" link.',
                            },
                            {
                                type: 'listbox',
                                name: 'secondary',
                                values: [
                                    {text: 'No', value: 'false'},
                                    {text: 'Yes', value: 'true'},
                                    ],
                                label: 'Secondary Email',
                            },
                            {
                                type: 'textbox',
                                name: 'class',                                
                                label: 'Extra CSS class',
                            }],
                            onsubmit: function( e ) {

                                var link = '';
                                var secondary = '';
                                var cssClass = '';


                                if(e.data.link === 'true'){
                                 link = ' link="true"';
                                }
                                
                                if(e.data.secondary === 'true'){
                                 secondary = ' secondary="true"';
                                }

                                if(e.data.class !== ''){
                                  cssClass = ' class="'+e.data.class+'"';
                                }

                                editor.insertContent('[wps_main_email'+ link + secondary + cssClass +']');
                            }
                        });
                    }
                },
            ],
                

        });

    });
})();