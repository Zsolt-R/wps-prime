<?php
/**
 * Theme Shortcodes.
 */

/**
 *  WPS SHORTCODES
 * 14 Accordion [accordion][/accordion]
 * 15 Accordion Item [accordion_item][accordion_item].
 */

// Make sure to not redeclare the class
if (!class_exists('WPS_Accordion_Shortcodes')) :

class WPS_Accordion_Shortcodes
{
    /**
     * Should the accordion JavaScript file be loaded the on the current page
     * False by default.
     */
    private $load_script = false;

    /**
     * Holds all the accordion shortcodes group settings.
     */
    private $script_data = array();

    /**
     * Count of each accordion group on a page.
     */
    private $group_count = 0;

    /**
     * Count for each accordion item within an accordion group.
     */
    private $item_count = 0;

    /**
     * Holds the accordion group container HTML tag.
     */
    private $wrapper_tag = 'div';

    /**
     * Holds the accordion item title HTML tag.
     */
    private $title_tag = 'h3';

    /**
     * Animation data attr.
     */
    private $anim = '';

    /**
     * Holds the accordion item content container HTML tag.
     */
    private $content_tag = 'div';

    /**
     * Class constructor
     * Sets up the plugin, including: textdomain, adding shortcodes, registering
     * scripts and adding buttons.
     */
    public function __construct()
    {
        // Load text domain
        load_plugin_textdomain('wps-prime', false, WPS_THEME_DIR.'/languages/');

        // Register JavaScript
        add_action('wp_enqueue_scripts', array($this, 'register_script'));

        add_shortcode('wps_accordion', array($this, 'accordion_shortcode'));
        add_shortcode('wps_accordion_item', array($this, 'accordion_item_shortcode'));

        // Print script in wp_footer
        add_action('wp_footer', array($this, 'print_script'));
    }

    /**
     * Registers the JavaScript file
     * If SCRIPT_DEBUG is set to true in the config file, the un-minified
     * version of the JavaScript file will be used.
     */
    public function register_script()
    {
        wp_register_script('accordion_script', WPS_JS_DIR_URI.'/min/accordion.min.js', array('jquery'), '2.2.6', true);
    }

    /**
     * Prints the accordion JavaScript in the footer
     * This inlcludes both the accordion jQuery plugin file registered by
     * 'register_script()' and the accordion settings JavaScript variable.
     */
    public function print_script()
    {
        // Check to see if shortcodes are used on page
        if (!$this->load_script) {
            return;
        }

        wp_enqueue_script('accordion_script');

        // Output accordions settings JavaScript variable
        wp_localize_script('accordion_script', 'accordionShortcodesSettings', $this->script_data);
    }

    /**
     * Checks if a value is boolean.
     *
     * @param string $value The value to test
     *                      return bool
     */
    private function is_boolean($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Check for valid HTML tag
     * Checks the supplied HTML tag against a list of approved tags.
     *
     * @param string $tag The HTML tag to test
     *                    return string A valid HTML tag
     */
    private function check_html_tag($tag)
    {
        $tag = preg_replace('/\s/', '', $tag);
        $tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'div');

        if (in_array($tag, $tags)) {
            return $tag;
        } else {
            return $this->title_tag;
        }
    }

    /**
     * Check for valid scroll value
     * Scroll value must be either an int or bool.
     *
     * @param int/bool $scroll The scroll offset integer or true/false
     *                         return int/bool The scroll offset integer else true/false
     */
    private function check_scroll_value($scroll)
    {
        $int = intval($scroll);

        if (is_int($int) && $int != 0) {
            return $int;
        } else {
            return $this->is_boolean($scroll);
        }
    }

    /**
     * Get's the ID for an accordion item.
     *
     * @param string $id If the user set an ID
     *                   return array The IDs for the accordion title and item
     */
    private function get_accordion_id($id)
    {
        $title_id = $id ? $id : "accordion-$this->group_count-t$this->item_count";
        $content_id = $id ? "content-$id" : "accordion-$this->group_count-c$this->item_count";

        return array(
            'title' => $title_id,
            'content' => $content_id,
        );
    }

    /**
     * Accordion group shortcode.
     */
    public function accordion_shortcode($atts, $content = null)
    {
        // The shortcode is used on the page, so load the JavaScript
        $this->load_script = true;

        // Set accordion counters
        ++$this->group_count;
        $this->item_count = 0;

        extract(shortcode_atts(array(
            'tag' => '',
            'autoclose' => true,
            'openfirst' => false,
            'openall' => false,
            'clicktoclose' => false,
            'scroll' => false,
            'semantics' => '',
            'class' => '',
            'anim_data' => false,
        ), $atts, 'accordion'));

        // Set global HTML tag names
        // Set title HTML tag
        if ($tag) {
            $this->title_tag = $this->check_html_tag($tag);
        } else {
            $this->title_tag = 'h3';
        }

        if ($anim_data) {
            $this->anim = ' data-animate="'.$anim_data.'"';
        } else {
            $this->anim = '';
        }

        // Set wrapper HTML tags
        if ($semantics == 'dl') {
            $this->wrapper_tag = 'dl';
            $this->title_tag = 'dt';
            $this->content_tag = 'dd';
        } else {
            $this->wrapper_tag = 'div';
            $this->content_tag = 'div';
        }

        // Set settings object (for use in JavaScript)
        $script_data = array(
            'id' => "accordion-$this->group_count",
            'autoClose' => $this->is_boolean($autoclose),
            'openFirst' => $this->is_boolean($openfirst),
            'openAll' => $this->is_boolean($openall),
            'clickToClose' => $this->is_boolean($clicktoclose),
            'scroll' => $this->check_scroll_value($scroll),
        );

        // Add this shortcodes settings instance to the global script data array
        $this->script_data[] = $script_data;

        return sprintf('<%2$s id="%3$s" class="accordion no-js%4$s" role="tablist"%5$s>%1$s</%2$s>',
            do_shortcode($content),
            $this->wrapper_tag,
            "accordion-$this->group_count",
            $class ? " $class" : '',
            $this->anim
        );
    }

    /**
     * Accordion item shortcode.
     */
    public function accordion_item_shortcode($atts, $content = null)
    {
        $options = shortcode_atts(array(
            'title' => '',
            'id' => '',
            'tag' => '',
            'class' => '',
            'icon_class' => '',
            'icon_family' => '',
        ), $atts);

        /**
         * Deprecated
         * these arguments are kept for backward compatibility.
         */
        // TODO remove in time
        $deprecated = shortcode_atts(
        array(
        'ico_type' => '',
        'icon_fontawesome' => '',
        'icon_fontawesome_modern' => '',
        'icon_fontawesome_modern_regular' => '',
        'icon_fontawesome_modern_light' => '',
        'icon_fontawesome_modern_solid' => '',
        'icon_fontawesome_modern_brands' => '',
        'icon_typicons' => '',
        'icon_linecons' => '',
        'icon_woothemesecom' => '',
    ), $atts);

        // Increment accordion item count
        ++$this->item_count;

        $ids = $this->get_accordion_id($options['id']);

        // TODO remove in time
        // Check the regular, sometimes it can be decalred only as icon_fontawesome
        $regularIcon = $deprecated['icon_fontawesome'] ? $deprecated['icon_fontawesome'] : '';

        // TODO remove in time
        // If we have a regular icon declared switch to this argument
        if ($deprecated['icon_fontawesome_modern_regular']) {
            $regularIcon = $deprecated['icon_fontawesome_modern_regular'];
        }

        $iconArgs = array(
            // TODO remove in time
            //Start backward compatibility
            'regular' => $regularIcon,
            'light' => $deprecated['icon_fontawesome_modern_light'],
            'solid' => $deprecated['icon_fontawesome_modern_solid'],
            'brands' => $deprecated['icon_fontawesome_modern_brands'],
            // End backward compatibility

            'icon_class' => $options['icon_class'],
            'icon_family' => $options['icon_family'],
            'nowrap' => true,
        );

        $icon = wps_run_icon($iconArgs);

        $accordion_title = sprintf('<%1$s id="%3$s" class="accordion-title%5$s" role="tab" aria-controls="%4$s" aria-selected="false" aria-expanded="false">%6$s%2$s</%1$s>',
            $options['tag'] ? $this->check_html_tag($options['tag']) : $this->title_tag,
            $options['title'] ? $options['title'] : '<span style="color:red;">'.__('Please enter a title attribute', 'wps-prime').'</span>',
            $ids['title'],
            $ids['content'],
            $options['class'] ? ' '.$options['class'] : '',
            !empty($icon) ? "{$icon} " : ''
        );

        $accordion_content = sprintf('<%1$s id="%3$s" class="accordion-content" role="tabpanel" aria-labelledby="%4$s" aria-hidden="true">%2$s</%1$s>',
            $this->content_tag,
            do_shortcode($content),
            $ids['content'],
            $ids['title']
        );

        return $accordion_title.$accordion_content;
    }
}

$WPS_Accordion_Shortcodes = new WPS_Accordion_Shortcodes();

endif;
