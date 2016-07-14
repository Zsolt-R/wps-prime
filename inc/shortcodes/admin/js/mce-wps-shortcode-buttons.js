// ref: https://www.gavick.com/blog/wordpress-tinymce-custom-buttons
(function() {

    // Predefined widths
    var generateWidths = function(prefix){

        this.prefix = prefix || '';

        var values = [{text: '----',    value: ''},
                      {text: '1/1 - Whole',    value: prefix+'1/1'},
                      {text: '1/2 - Halves',   value: prefix+'1/2'},
                      {text: '2/4 - Halves',   value: prefix+'2/4'},
                      {text: '3/6 - Halves',   value: prefix+'3/6'},
                      {text: '4/8 - Halves',   value: prefix+'4/8'},
                      {text: '5/10 - Halves',   value: prefix+'5/10'},
                      {text: '6/12 - Halves',   value: prefix+'6/12'},
                      {text: '1/3 - Thirds',   value: prefix+'1/3'},
                      {text: '2/6 - Thirds',   value: prefix+'2/6'},
                      {text: '3/9 - Thirds',   value: prefix+'3/9'},
                      {text: '4/12 - Thirds',   value: prefix+'4/12'},
                      {text: '2/3 - Thirds',   value: prefix+'2/3'},
                      {text: '4/6 - Thirds',   value: prefix+'4/6'},
                      {text: '6/9 - Thirds',   value: prefix+'6/9'},
                      {text: '8/12 - Thirds',   value: prefix+'8/12'},
                      {text: '1/4 - Quarters', value: prefix+'1/4'},
                      {text: '2/8 - Quarters', value: prefix+'2/8'},
                      {text: '3/12 - Quarters', value: prefix+'3/12'}, 
                      {text: '3/4 - Quarters', value: prefix+'3/4'},
                      {text: '6/8 - Quarters', value: prefix+'6/8'},
                      {text: '9/12 - Quarters', value: prefix+'9/12'},
                      {text: '1/5 - Fifths',   value: prefix+'1/5'},
                      {text: '2/10 - Fifths',   value: prefix+'2/10'},
                      {text: '2/5 - Fifths',   value: prefix+'2/5'},
                      {text: '4/10 - Fifths',   value: prefix+'4/10'}, 
                      {text: '3/5 - Fifths',   value: prefix+'3/5'},
                      {text: '6/10 - Fifths',   value: prefix+'6/10'},
                      {text: '4/5 - Fifths',   value: prefix+'4/5'},
                      {text: '8/10 - Fifths',   value: prefix+'8/10'}, 
                      {text: '1/6 - Sixths',   value: prefix+'1/6'},
                      {text: '2/12 - Sixths',   value: prefix+'2/12'},
                      {text: '5/6 - Sixths',   value: prefix+'5/6'},
                      {text: '10/12 - Sixths',   value: prefix+'10/12'},
                      {text: '1/8 - Eighths',  value: prefix+'1/8'},  
                      {text: '3/8 - Eighths',  value: prefix+'3/8'},  
                      {text: '5/8 - Eighths',  value: prefix+'5/8'},  
                      {text: '7/8 - Eighths',  value: prefix+'7/8'},
                      {text: '1/9 - Ninths',   value: prefix+'1/9'},  
                      {text: '2/9 - Ninths',   value: prefix+'2/9'},  
                      {text: '4/9 - Ninths',   value: prefix+'4/9'},  
                      {text: '5/9 - Ninths',   value: prefix+'5/9'},  
                      {text: '7/9 - Ninths',   value: prefix+'7/9'},  
                      {text: '8/9 - Ninths',   value: prefix+'8/9'},  
                      {text: '1/10 - Tenths',   value: prefix+'1/10'}, 
                      {text: '3/10 - Tenths',   value: prefix+'3/10'}, 
                      {text: '7/10 - Tenths',   value: prefix+'7/10'}, 
                      {text: '9/10 - Tenths',   value: prefix+'9/10'},
                      {text: '1/12 - Twelfths', value: prefix+'1/12'}, 
                      {text: '5/12 - Twelfths', value: prefix+'5/12'}, 
                      {text: '7/12 - Twelfths', value: prefix+'7/12'}, 
                      {text: '11/12 - Twelfths', value: prefix+'11/12'}];

                return values;
            };

    // Predefined button classes
    var predefinedButtonCss = function(){

        var values = { importance: [
                            {text:'Default',value:''},
                            {text:'Primary',value:'btn--primary'},
                            {text:'Secondary',value:'btn--secondary'},
                            {text:'Tertiary',value:'btn--tertiary'}
                        ],
                       sizes: [
                            {text:'Normal',value:''},
                            {text:'Small',value:'btn--small'},
                            {text:'Large',value:'btn--large'}
                        ]
                    };
        return values;
    }; 

    // Predefined button classes
    var predefinedListStyles = function(){

        var values = { listtypes: [
                            {text:'Style None',value:''},
                            {text:'Style One',value:'list--style-one'},
                            {text:'Style two',value:'list--style-two'},
                            {text:'Style three',value:'list--style-three'},
                            {text:'Style four',value:'list--style-four'},
                            {text:'Style five',value:'list--style-five'},
                            {text:'Style six',value:'list--style-six'},
                            {text:'Style seven',value:'list--style-seven'},
                            {text:'Style eight',value:'list--style-eight'},
                            {text:'Style nine',value:'list--style-nine'},
                            {text:'Style ten',value:'list--style-ten'}
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

        editor.addButton( 'wps_shortcode_buttons', {
            title: editor.getLang('wps_button.button_label'),        
            type: 'menubutton',
            icon: 'icon wps-own-icon',
            menu: [{
                    text: 'Layouts',
                    icon: 'icon dashicons-feedback',
                    menu: [{
                text:'Layout item',
                icon: 'icon dashicons-editor-contract',
                onclick: function() {

                     editor.windowManager.open( {
                        title: 'Insert layout item', 
                        body: [{
                                type: 'textbox',
                                name: 'itemClassOpt',
                                label: 'Optional CSS class'
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth1',
                            label: 'Width: palm (max-width: 44.9375em)',
                            'values': new generateWidths('palm-')
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth2',
                            label: 'Width: lap ((min-width: 45em) and (max-width: 63.9375em))',
                            'values': new generateWidths('lap-')
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth3',
                            label: 'Width: lap-and-up (min-width: 45em)',
                            'values': new generateWidths('lap-and-up-')
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth4',
                            label: 'Width: portable (max-width: 63.9375em)',
                            'values': new generateWidths('portable-')
                            },
                            {
                            type: 'listbox',                                
                            name: 'itemWidth5',
                            label: 'Width: desk (min-width: 64em)',
                            'values': new generateWidths('desk-')
                            }],

                            onsubmit: function( e ) {
                                    // Collect all the class selections
                                    var options = [e.data.itemWidth1,e.data.itemWidth2,e.data.itemWidth3,e.data.itemWidth4,e.data.itemWidth5,e.data.itemClassOpt];
                       
                                    // Return the shortcode to editor.
                                    // Check if there is a valid css declaration and trim first and last space using trim
                                    editor.insertContent('[wps_item' + getCssClass(options) +']'+ editor.selection.getContent() +'[/wps_item]');
                            }

                     });                    
                }
            },
            {
                text:'Layout',
                icon: 'icon dashicons-editor-expand',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert layout wrapper', 
                        body: [{
                                type: 'textbox',
                                name: 'layoutWrapperClass',
                                label: 'Optional CSS class'
                            },
                            { 
                            type: 'listbox',                                
                            name: 'layoutWrapperState',
                            label: 'Add Wrapper',
                            'values': [
                                {text: 'No', value: 'false'},
                                {text: 'Yes', value: 'true'},
                            ]

                        }],
                        onsubmit: function( e ) {
                            editor.insertContent('[wps_layout wrapper="'+ e.data.layoutWrapperState +'"'+ (e.data.layoutWrapperClass !== '' ? ' class="'+ e.data.layoutWrapperClass +'"' : '') + ']' + editor.selection.getContent() +'[/wps_layout]');
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
                            body: {
                                type: 'textbox',
                                name: 'iconClass',
                                label: 'Fontawesome Icon CSS ex.fa fa-bluetooth ( http://fontawesome.io/icons/ )',
                            },
                            onsubmit: function( e ) {
                                if(e.data.iconClass === ''){

                                    var window_id = this._id;
                                    var inputs = jQuery('#' + window_id + '-body').find('.mce-formitem input');

                                    editor.windowManager.alert('Please, fill in all fields in a popup.');

                                    if(e.data.iconClass === '') {
                                        jQuery(inputs.get(0)).css('border-color', 'red');
                                    }

                                    return false;
                                }
                                editor.insertContent('[wps_ico]'+ e.data.iconClass +'[/wps_ico]');
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

                                    
                            editor.insertContent('[wps_slider images="'+ e.data.imageIdList +'"'+ slideImageLinks +']');
                        }
                        });
                    }
                }
            ],
                

        });

    });
})();