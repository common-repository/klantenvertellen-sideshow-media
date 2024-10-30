<?php
/**
 * Creates the menu item for the plugin.
 *
 * @package Klantenvertellen_SideShow_Media
 */
 
/**
 * Creates the menu item for the plugin.
 *
 * Registers a new menu item under 'Tools' and uses the dependency passed into
 * the constructor in order to display the page corresponding to this menu item.
 *
 * @package Klantenvertellen_SideShow_Media
 */
class Menu {
 
    /**
     * A reference the class responsible for rendering the menu page.
     *
     * @var    Menu_Page
     * @access private
     */
    private $menu_page;
    
    /**
	 * Initializes all of the partial classes.
	 *
	 * @param Menu_Page $menu_page A reference to the class that renders the
	 *                             page for the plugin.
	 */
	public function __construct( $menu_page ) {
		$this->menu_page = $menu_page;
	}

    /**
     * Adds a menu for this plugin to the sidebar.
     */
    public function init() {
         add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
         add_action( 'admin_init', array( $this, 'kvssm_settings_init' ) );
    }
 
    /**
     * Creates the submenu item and calls on the Submenu Page object to render
     * the actual contents of the page.
     */
    public function add_menu_page() {
 
        add_menu_page(
            'Klantenvertellen SideShow Media', //Page title
            'Klantenvertellen SideShow Media', //Menu title
            'manage_options',
            'klantenvertellen-ssm', //Page slug
            array( $this->menu_page, 'render' ),
            plugin_dir_url( __FILE__ ) . 'images/kvssm-menu-icon-24x24.png'
        );
    }
    
    public function kvssm_settings_init(){
    	register_setting( 'kvPlugin', 'kvssm_settings' );
    	/**
    	 * Generic fields
    	 **/
    	add_settings_section(
    		'kvssm_kvPlugin_section',
    		'SideShow Media Klantenvertellen shortcode generator',
    		'kvssm_section_title',
    		'kvPlugin'
    	);
    	
    	add_settings_field(
    		'kvssm_select_type',
    		'Shortcode type',
    		'kvssm_select_type_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_company_name',
    		'Company name',
    		'kvssm_company_name_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_short_description',
    		'Short description',
    		'kvssm_short_description_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_xml_feed',
    		'XML link',
    		'kvssm_xml_feed_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	/**
    	 * Shared widget fields
    	 **/
    	add_settings_field(
    		'kvssm_widget_link',
    		'Widget link',
    		'kvssm_widget_link_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	/**
    	 * Widget Default fields
    	 **/
    	add_settings_field(
    		'kvssm_widget_color_grade',
    		'Grade color',
    		'kvssm_widget_color_grade_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_widget_color_other',
    		'Other text color',
    		'kvssm_widget_color_other_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_widget_letter_spacing',
    		'Grade letter spacing',
    		'kvssm_widget_letter_spacing_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_widget_letter_position_top',
    		'Grade position (top, left)',
    		'kvssm_widget_letter_position_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	/**
    	 * Widget Flat fields
    	 **/
    	add_settings_field(
    		'kvssm_widget_flat_letter_size',
    		'Font size',
    		'kvssm_widget_flat_letter_size_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_widget_flat_font_color',
    		'Text color',
    		'kvssm_widget_flat_font_color_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_widget_flat_left_padding',
    		'Left padding',
    		'kvssm_widget_flat_left_padding_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	/**
    	 * Review fields
    	 **/
    	add_settings_field(
    		'kvssm_review_limit',
    		'Review limit',
    		'kvssm_review_limit_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_review_key',
    		'Key field',
    		'kvssm_review_key_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_review_filter',
    		'Review Filter',
    		'kvssm_review_filter_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_review_averages_background_color',
    		'Averages background color',
    		'kvssm_review_averages_background_color_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_review_averages_text_color',
    		'Averages text color',
    		'kvssm_review_averages_text_color_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_review_reviews_background_color',
    		'Reviews background color',
    		'kvssm_review_reviews_background_color_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    	
    	add_settings_field(
    		'kvssm_review_reviews_text_color',
    		'Reviews text color',
    		'kvssm_review_reviews_text_color_render',
    		'kvPlugin',
    		'kvssm_kvPlugin_section'
    	);
    } // End kvssm_settings_init
}