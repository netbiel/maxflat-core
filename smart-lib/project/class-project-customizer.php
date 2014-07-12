<?php
/**
 * Project Customizer Class
 *
 * Contains methods for customizing the theme customization screen.
 *
 *

 * @subpackage project
 * @since      project 1.0
 */





class Smart_Project_Customizer{

	/**
	 * Identifier, namespace
	 */
	public static $theme_key;

	public $obj_project;

	public $obj_admin_project;

	public $project_prefix;

    public $plugin_territory;



	public static $font_variants = array(
	'project_general_fonts'=>'body, p',
		'project_header_fonts'=>'h1, h2, h3, h4, h5, h6, .smartlib-site-logo',
		'project_menu_fonts'=> '#top-navigation'
	);//sections with different external fonts with related components

	public static $design_index = 'flat';//usefull with design variants

	/**
	 * The option value in the database will be based on get_stylesheet()
	 * so child themes don't share the parent theme's option value.
	 */
	public static $option_key;

	/**
	 * Array of default theme options
	 */

	/**
	 * Array of default theme options
	 */

	public static $default_theme_options = array(
		'default'=>array(
			'link_color'                      => '#6491A1',
			'link_color_hover'                      => '#6491A0',
			'main_font_color' => '#444',
			'breadcrumb_separator'            => ' &raquo; ',
			'sidebar_color'                   => '#385A72',
			'header_color'                    => '#404040',
			'top_bar_outer_color'             => '#404040',
			'top_bar_menu_color'              => '#212121',
			'top_bar_menu_link_color'         => '#ffffff',
			'top_bar_menu_link_background'    => '#404040',
			'project_logo'                 => '',
			'project_pagination_posts'     => '1',
			'custom_code_header'              => '',
			'custom_code_footer'              => '',
			'social_button_facebook'          => '0',
			'social_button_gplus'             => '0',
			'social_button_twitter'           => '0',
			'social_button_pinterest'         => '0',
			'layout_options'                  => '1',
			'project_layout_width'         => '1280',
			'title_tagline_footer' =>'',
			'project_favicon' => '',
			'project_fonts'=> array('project_general_fonts'=> 'merriweather-sans', //key from $font_variants
																 'project_header_fonts'=> 'open-sans-condesed',
																 'project_menu_fonts'=>'')
		),
		'flat'=> array(
			'link_color'                      => '#6491A1',
			'link_color_hover'                      => '#6491A0',
			'main_font_color' => '#444',
			'breadcrumb_separator'            => ' &raquo; ',
			'sidebar_color'                   => '#385A72',
			'header_color'                    => '#404040',
			'top_bar_outer_color'             => '#404040',
			'top_bar_menu_color'              => '#212121',
			'top_bar_menu_link_color'         => '#ffffff',
			'top_bar_menu_link_background'    => '#404040',
			'project_logo'                 => '',
			'project_pagination_posts'     => '1',
			'custom_code_header'              => '',
			'custom_code_footer'              => '',
			'social_button_facebook'          => '0',
			'social_button_gplus'             => '0',
			'social_button_twitter'           => '0',
			'social_button_pinterest'         => '0',
			'layout_options'                  => '1',
			'project_layout_width'         => '1280',
			'title_tagline_footer' =>'',
			'project_favicon' => '',
			'project_fonts'=> array('project_general_fonts'=> 'open-sans',
																 'project_header_fonts'=> 'dosis',
																 'project_menu_fonts'=>'')
		)

	);

        public $plugin_territory_sections = array(
            'colors',
            '_section_project_layout',
            'maxflat_section_project_sidebar_resize',
            '_section_project_social_buttons',
            '_section_project_fonts',
            '_section_project_custom_code'
        );


	public function __construct($obj_admin_project){

		//project object
		 $this->obj_admin_project = $obj_admin_project;
         $this->plugin_territory = $this->obj_admin_project->plugin_territory;
         $this->project_prefix = $this->obj_admin_project->project_prefix;


		//get options key
		self::$option_key = $this->obj_admin_project->customizer_key;
		self::$option_key = $this->project_prefix .'_theme_options';

	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 */
	public static function header_output() {


		//self::project_design_modify();

		?>
	<!--Customizer CSS-->
<style type="text/css">
	body{background-color: #fff;}
<?php self::generate_css( 'body, body p', 'color', 'main_font_color' );  ?>
<?php self::generate_css( 'a', 'color', 'link_color' );  ?>
<?php self::generate_css( 'a:hover, a:focus', 'color', 'link_color_hover' );  ?>
<?php self::generate_css( '#sidebar .widget-title', 'background-color', 'sidebar_color' );  ?>
<?php self::generate_css( '#top-bar', 'background-color', 'top_bar_outer_color' );  ?>
<?php self::generate_css( '#top-bar > .row', 'background-color', 'top_bar_menu_color' );  ?>
<?php self::generate_css( '#top-bar .top-menu  a', 'color', 'top_bar_menu_link_color' );  ?>
<?php self::generate_css( '#top-navigation li:hover a, #top-navigation .current_page_item a,#top-navigation li:hover ul', 'background-color', 'top_bar_menu_link_background' );  ?>
<?php self::generate_css( 'h1, h2 a, h2, h3, h4, h5, h6', 'color', 'header_color' ); ?>
<?php self::generate_layout_css();
		?>
</style>
	<?php

		self::get_header_output_fonts(self::$design_index);

	}


	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses  get_theme_mod()
	 *
	 * @param string $selector CSS selector
	 * @param string $style    The name of the CSS *property* to modify
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param string $prefix   Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix  Optional. Anything that needs to be output after the CSS property
	 * @param bool   $echo     Optional. Whether to print directly to the page (default: true).
	 *
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since project 1.0
	 */
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
		$return = '';
		$mod    = get_option( self::$option_key );

		if ( ! empty( $mod[$mod_name] ) ) {
			$return = sprintf( '%s { %s:%s; }',
				$selector,
				$style,
					$prefix . $mod[$mod_name] . $postfix
			);
			if ( $echo ) {
				echo $return . "\n";
			}
		}
		return $return;
	}

/**
* Generate layout css.
 *
* @since project Pro 1.0
*/
	public static function generate_layout_css(){

		$width = self::get_project_option( 'project_layout_width' );
        $sidebar_width = 340;
    //layout resize
		$layout_width = ! empty($width)?$width:1280;
		echo '@media only screen and (min-width: '.($layout_width+25).'px){'."\n";
		if(! empty($width)){
			echo 'body{min-width:'.$layout_width.'px}'."\n";
			echo '.row, #wrapper{ width:'.$layout_width.'px }'."\n";
			echo '.row, #wrapper{ max-width: 100% }'."\n";
		}

		if(!empty($sidebar_width)){
			echo '#sidebar{ width:'.$sidebar_width.'px }'."\n";
		}
		//if sidebar exists change page size
		$layot_option = self::get_project_option(  'project_layout' );
		if (!empty($layot_option) && $layot_option != '4' )
			echo '#page { width:'.($layout_width - $sidebar_width ) . 'px }'."\n";
		echo '}'."\n";
	}

	/*Gets single project option*/

	public static function get_project_option( $option_name ) {
		$mod = get_option( self::$option_key );
		return isset( $mod[$option_name] ) ? $mod[$option_name] : 0;
	}

    /**
     * Get default value based on $option_key
     * @static
     * @param $option_key
     * @return int
     */
    public static function get_default_option($option_key){
        if(isset(self::$default_theme_options[self::$design_index][$option_key])){
            return self::$default_theme_options[self::$design_index][$option_key];
        }else{
            return 0;
        }
    }

	/*Get header font styles*/

	public static function get_header_output_fonts() {

		$mod           = get_option( self::$option_key );
		$fonts         = self::get_project_available_fonts();
		$option_fonts = array();
		if(isset($mod['project_fonts'])&&count($mod['project_fonts'])>0){
			$option_fonts = $mod['project_fonts'];
		}

		$default_fonts = self::$default_theme_options[self::$design_index]['project_fonts'];

		$display_fonts = array_merge($default_fonts,$option_fonts);
		$import_fonts = array_unique($display_fonts);


		/*first: load fonts - lazy include*/
		echo "\n" . '<style>'."\n";
		echo "\n" .'/*CUSTOM FONTS*/'."\n"."\n";


		/*second: add font styles*/



		foreach($import_fonts as $font){
			if(isset($fonts[$font])){
			echo "\n" .$fonts[$font]['import'];
			}
		}
		echo "\n";
		foreach ( self::$font_variants as $key_section =>$css_line ) { //$row = project_general_fonts or project_headers_fonts

				if ( isset( $display_fonts[$key_section] ) ) {
                     if(isset($fonts[$display_fonts[$key_section]]['css'])){
                         echo "\n" .$css_line .'{' .$fonts[$display_fonts[$key_section]]['css'].'}';
                     }

				}
			}
		echo "\n" . '</style>';
	}

	/**
	 * Implement theme options into Theme Customizer on Frontend
	 *
	 * @see   examples for different input fields https://gist.github.com/2968549
	 * @since 08/09/2012
	 *
	 * @param $wp_customize Theme Customizer object
	 *
	 * @return void
	 */
	public function  register( $wp_customize ) {


  
// defaults, import for live preview with js helper
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		//get design index - design variant
		$design_index = self::get_project_option(self::$option_key.'_design');

		if($design_index){
			self::$design_index = $design_index;
		}

    //get default values ​​depending on the design id

		$defaults = self::$default_theme_options[self::$design_index];



		//add section: logo
		$wp_customize->add_section( 'project_section_logo', array(
			'title'    => __( 'Logo', 'maxflat'),
			'priority' => 20,
		) );
		//add section: breadcrumb
		$wp_customize->add_section( $this->project_prefix.'_section_project_breadcrumb', array(
			'title'    => __( 'Breadcrumb', 'maxflat'),
			'priority' => 70,
		) );

		//add section: pagination
		$wp_customize->add_section( $this->project_prefix.'_section_pagination_posts', array(
			'title'    => __( 'Pagination', 'maxflat'),
			'priority' => 90,
		) );


		//add section: custom code

		$wp_customize->add_section( '_section_project_custom_code', array(
			'title'    => __( 'Custom Code', 'maxflat'),
			'priority' => 80,
		) );

		//add footer text

		$wp_customize->add_setting( self::$option_key . '[title_tagline_footer]', array(
			'default'    => $defaults['title_tagline_footer'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_string')
		) );

		$wp_customize->add_control( self::$option_key . '_title_tagline_footer', array(
			'label'      => __( 'Footer text', 'maxflat'),
			'section'    => 'title_tagline',
			'settings'   => self::$option_key . '[title_tagline_footer]',
			'type'       => 'text',

		) );

		//add setting pagination

		$wp_customize->add_setting( self::$option_key . '[project_pagination_posts]', array(
			'default'    => '1',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_pagination_posts')
		) );


		$wp_customize->add_control( self::$option_key . '_pagination_posts', array(
			'label'      => __( 'Pagination', 'maxflat'),
			'section'    => $this->project_prefix.'_section_pagination_posts',
			'settings'   => self::$option_key . '[project_pagination_posts]',
			'type'       => 'radio',
			'choices'    => array(
				'1' => __( 'Older posts/Newer posts', 'maxflat'),
				'2' => __( 'Paginate links', 'maxflat')
			)

		) );

		//add setting breadcrumb_separator

		$wp_customize->add_setting( self::$option_key . '[breadcrumb_separator]', array(
			'default'    => $defaults['breadcrumb_separator'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_breadcrumb_separator')
		) );

		$wp_customize->add_control( self::$option_key . '_breadcrumb_separator', array(
			'label'      => __( 'Separator', 'maxflat'),
			'section'    => $this->project_prefix.'_section_project_breadcrumb',
			'settings'   => self::$option_key . '[breadcrumb_separator]',
			'type'       => 'text',

		) );


		$wp_customize->add_setting( self::$option_key . '[main_font_color]', array(

			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_main_font_color', array(
			'label'    => __( 'Main Font Color', 'maxflat'),
			'section'  => 'colors',
			'settings' => self::$option_key . '[main_font_color]',
		) ) );
		//add header color

		$wp_customize->add_setting( self::$option_key . '[header_color]', array(

			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_header_color', array(
			'label'    => __( 'Headers Text Color', 'maxflat'),
			'section'  => 'colors',
			'settings' => self::$option_key . '[header_color]',
		) ) );

		//sidebar color
		$wp_customize->add_setting( self::$option_key . '[sidebar_color]', array(

			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_sidebar_color', array(
			'label'    => __( 'Sidebar Color', 'maxflat'),
			'section'  => 'colors',
			'settings' => self::$option_key . '[sidebar_color]',
		) ) );

		// Link Color (added to Color Scheme section in Theme Customizer)
		$wp_customize->add_setting( self::$option_key . '[link_color]', array(

			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_link_color', array(
			'label'    => __( 'Link Color', 'maxflat'),
			'section'  => 'colors',
			'settings' => self::$option_key . '[link_color]',
		) ) );




		/*LOGO*/
		$wp_customize->add_setting( self::$option_key . '[project_logo]', array(
			'default'    => $defaults['project_logo'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_string')
		) );


		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, self::$option_key . '_logo', array(
			'label'    => __( 'Upload', 'maxflat'),
			'section'  => 'project_section_logo',
			'settings' => self::$option_key . '[project_logo]',
		) ) );

		/* Favicon */

		$wp_customize->add_setting( self::$option_key . '[project_favicon]', array(
			'default'    => $defaults['project_favicon'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_string')
		) );


		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, self::$option_key . '_favicon', array(
			'label'    => __( 'Upload favicon', 'maxflat'),
			'section'  => self::$option_key.'_section_project_logo',
			'settings' => self::$option_key . '[project_favicon]',
		) ) );



		//add costom code setting



		/*ADD PREMIUM SECTIONS*/
		//add section: layout
		$wp_customize->add_section( $this->project_prefix.'_section_project_layout', array(
			'title'    => __( 'Layout', 'maxflat'),
			'priority' => 40,
		) );


		$wp_customize->add_setting( self::$option_key . '[project_layout]', array(
			'default'    => 1,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_project_layout')

		) );

		$wp_customize->add_control( self::$option_key . '_project_layout', array(
			'settings'   => self::$option_key . '[project_layout]',
			'label'      => __( 'Layout variants:', 'maxflat'),
			'section'    => $this->project_prefix.'_section_project_layout',

			'type'       => 'radio',
			'choices'    => array(
				'1' => __( 'Left menu & right sidebar', 'maxflat'),
				'2' => __( 'Left sidebar & right menu', 'maxflat'),
				'3' => __( 'Right sidebar without menu', 'maxflat'),
				'4' => __( 'Left menu without sidebar', 'maxflat')
			)

		) );

		//fixed top bar option
    /*
		$wp_customize->add_setting( self::$option_key . '[project_fixed_topbar]', array(
			'default'    => 1,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		) );

		$wp_customize->add_control( self::$option_key . '_project_fixed_topbar', array(
			'label'      => __( 'Fixed Top Bar', 'maxflat'),
			'section'    => $this->project_prefix.'_section_project_layout',
			'settings'   => self::$option_key . '[project_fixed_topbar]',
			'type'       => 'checkbox',


		) );
   */
		//add section sidebar
		$wp_customize->add_section( 'maxflat_section_project_sidebar_resize', array(
			'title'    => __( 'Resize components', 'maxflat'),
			'priority' => 60,
		) );

		$wp_customize->add_setting( self::$option_key . '[project_layout_width]', array(
			'default'    => '1280',
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback'=> array($this, 'sanitize_project_layout_width')
		) );



		$wp_customize->add_control( new project_Customize_Range_Control( $wp_customize, 'maxflat_project_layout_width', array(
			'settings' => self::$option_key . '[project_layout_width]',
			'label'    => __( 'Layout Width ', 'maxflat'),
			'section'  => 'maxflat_section_project_sidebar_resize',
			'type'     => 'text',

		) ) );



		//add font section
		$wp_customize->add_section( '_section_project_fonts', array(
			'title'    => __( 'Typography options', 'maxflat'),
			'priority' => 90,
		) );

		$wp_customize->add_setting( self::$option_key . '[project_fonts][project_general_fonts]', array(
            'default'    => $defaults['project_fonts']['project_general_fonts'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_project_general_fonts')
		) );

		$wp_customize->add_control( self::$option_key . '_project_general_fonts', array(
			'label'      => __( 'Primary font', 'maxflat'),
			'section'    =>'_section_project_fonts',
			'settings'   => self::$option_key . '[project_fonts][project_general_fonts]',
			'type'       => 'select',
			'choices'    => self::get_project_choices_fonts()

		) );

		$wp_customize->add_setting( self::$option_key . '[project_fonts][project_header_fonts]', array(
            'default'    => $defaults['project_fonts']['project_header_fonts'],
			'type'       => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array($this, 'sanitize_project_header_fonts')
		) );

		$wp_customize->add_control( self::$option_key . '_project_header_fonts', array(
			'label'      => __( 'Top headers font', 'maxflat'),
			'section'    => '_section_project_fonts',
			'settings'   => self::$option_key . '[project_fonts][project_header_fonts]',
			'type'       => 'select',
			'choices'    => self::get_project_choices_fonts()

		) );


        //add section: social buttons
        $wp_customize->add_section( '_section_project_social_buttons', array(
            'title'    => __( 'Social buttons', 'maxflat'),
            'priority' => 120,
        ) );



		//Fixed vertical menu settings
		/*
		$wp_customize->add_setting( self::$option_key . '[project_menu_fixed]', array(

			'type'       => 'option',
			'capability' => 'edit_theme_options',
		) );

		$wp_customize->add_control( self::$option_key . '_project_menu_fixed', array(
			'label'      => __( 'Fixed vertical menu', 'maxflat'),
			'section'    => 'nav',
			'settings'   => self::$option_key . '[project_menu_fixed]',
			'type'       => 'checkbox',


		) );
   */




     /**
     * ADD Pugin plugin_territory options  $this->plugin_territory
     */



        if($this->plugin_territory){
            $this->register_plugin_territory($wp_customize);
        }else{
            $this->add_placeholder($wp_customize);
        }
	}

    /*Settings sanitization*/

    /**
     * SETTINGS SANITIZATION
     */

    /**
     * @param $value
     * @return string
     */
    function sanitize_breadcrumb_separator($value){
        if(strlen($value)==0){
            $value = self::get_default_option('breadcrumb_separator');
        }
        return (string)$value;
    }

    function sanitize_project_layout($value){
        if(!in_array($value, array('1', '2', '3', '4'))){
            $value = '1';
        }

        return $value;
    }


    function sanitize_pagination_posts($value){
        if(!in_array($value, array('1', '2'))){
            $value = '1';
        }

        return $value;
    }

    function sanitize_project_layout_width($value){
        $value = (int)$value;

        if($value<900 || $value>1280){
            $value = 1280;
        }

        return $value;
    }

    function sanitize_project_general_fonts($value){
        $fonts_array = self::get_project_available_fonts();
        if(!array_key_exists($value,$fonts_array)){
            $default_fonts = self::get_default_option('project_fonts');
            $value = $default_fonts['project_general_fonts'];
        }

        return $value;

    }

    function sanitize_project_header_fonts($value){
        $fonts_array = self::get_project_available_fonts();
        if(!array_key_exists($value,$fonts_array)){
            $default_fonts = self::get_default_option('project_fonts');
            $value = $default_fonts['project_header_fonts'];
        }

        return $value;
    }

    function sanitize_string($value){
        if(empty($value)){
            $value = '';
        }
        return $value;
    }


    public function register_plugin_territory($wp_customize){


        //add social buttons settings

        //Facebook
        $wp_customize->add_setting(  self::$option_key .'[social_button_facebook]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
        ) );

        $wp_customize->add_control( self::$option_key . '_social_button_facebook', array(
            'settings' => self::$option_key . '[social_button_facebook]',
            'label'    => __( 'Facebook Like', 'maxflat'),
            'section'  => $this->project_prefix.'_section_project_social_buttons',
            'type'     => 'checkbox',
        ) );

        //Twitter
        $wp_customize->add_setting( self::$option_key . '[social_button_twitter]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
        ) );

        $wp_customize->add_control( self::$option_key . '_social_button_twitter', array(
            'settings' => self::$option_key . '[social_button_twitter]',
            'label'    => __( 'Twitter Button ', 'maxflat'),
            'section'  => $this->project_prefix.'_section_project_social_buttons',
            'type'     => 'checkbox',
        ) );

        //Google +1
        $wp_customize->add_setting( self::$option_key . '[social_button_gplus]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
        ) );

        $wp_customize->add_control( self::$option_key . '_social_button_gplus', array(
            'settings' => self::$option_key . '[social_button_gplus]',
            'label'    => __( 'Google +1', 'maxflat'),
            'section'  => $this->project_prefix.'_section_project_social_buttons',
            'type'     => 'checkbox',
        ) );

        //Pinterest
        $wp_customize->add_setting( self::$option_key . '[social_button_pinterest]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
        ) );

        $wp_customize->add_control( self::$option_key . '_social_button_pinterest', array(
            'settings' => self::$option_key . '[social_button_pinterest]',
            'label'    => __( 'Pinterest', 'maxflat'),
            'section'  => $this->project_prefix.'_section_project_social_buttons',
            'type'     => 'checkbox',
        ) );


        $wp_customize->add_setting( self::$option_key . '[link_color_hover]', array(

            'type'              => 'option',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_link_color_hover', array(

            'section'  => 'colors',
            'settings' => self::$option_key . '[link_color_hover]',
        ) ) );

        /*extended colors*/

        // Top bar outer color

        $wp_customize->add_setting( self::$option_key . '[top_bar_outer_color]', array(

            'type'              => 'option',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_top_bar_outer_color', array(
            'label'    => __( 'Top Bar Outer Color', 'maxflat'),
            'section'  => 'colors',
            'settings' => self::$option_key . '[top_bar_outer_color]',
        ) ) );
// Top bar menu color
        $wp_customize->add_setting( self::$option_key . '[top_bar_menu_color]', array(

            'type'              => 'option',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_top_bar_menu_color', array(
            'label'    => __( 'Top Bar Menu Color', 'maxflat'),
            'section'  => 'colors',
            'settings' => self::$option_key . '[top_bar_menu_color]',
        ) ) );

        // Top bar menu links color
        $wp_customize->add_setting( self::$option_key . '[top_bar_menu_link_color]', array(

            'type'              => 'option',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_top_bar_menu_link_color', array(
            'label'    => __( 'Top Bar Menu Link Color','maxflat'),
            'section'  => 'colors',
            'settings' => self::$option_key . '[top_bar_menu_link_color]',
        ) ) );
        // Top bar menu links background
        $wp_customize->add_setting( self::$option_key . '[top_bar_menu_link_background]', array(

            'type'              => 'option',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, self::$option_key . '_top_bar_menu_link_background', array(
            'label'    => __( 'Top Bar Menu Link Background', 'maxflat'),
            'section'  => 'colors',
            'settings' => self::$option_key . '[top_bar_menu_link_background]',
        ) ) );

        /*sidebar resize*/
        $wp_customize->add_setting( self::$option_key . '[project_sidebar_resize]', array(
            'default'    => 320,
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new project_Customize_Range_Control( $wp_customize,'maxflat_project_sidebar_resize', array(
            'label'      => __( 'Sidebar Width', 'maxflat'),
            'section'    => 'maxflat_section_project_sidebar_resize',
            'settings'   => self::$option_key . '[project_sidebar_resize]',
            'type'       => 'text',

        )) );

        $wp_customize->add_setting( self::$option_key . '[project_fonts][project_menu_fonts]', array(

            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );

        $wp_customize->add_control( self::$option_key . '_project_menu_fonts', array(
            'label'      => __( 'Top menu font', 'maxflat'),
            'section'    => '_section_project_fonts',
            'settings'   => self::$option_key . '[project_fonts][project_menu_fonts]',
            'type'       => 'select',
            'choices'    => self::get_project_choices_fonts()

        ) );


        $wp_customize->add_setting( self::$option_key . '[custom_code_header]', array(
            'default'    => '',
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );

        $wp_customize->add_setting( self::$option_key . '[custom_code_footer]', array(
            'default'    => '',
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new project_Customize_Textarea_Control( $wp_customize, self::$option_key . '_custom_code_header', array(
            'label'      => __( 'Custom Scripts for Header [header.php]', 'maxflat'),
            'section'    => '_section_project_custom_code',
            'capability' => 'edit_theme_options',
            'settings'   => self::$option_key . '[custom_code_header]'

        ) ) );

        $wp_customize->add_control( new project_Customize_Textarea_Control( $wp_customize, self::$option_key . '_custom_code_footer', array(
            'label'      => __( 'Custom Scripts for Footer [footer.php]', 'maxflat'),
            'section'    => '_section_project_custom_code',
            'capability' => 'edit_theme_options',
            'settings'   => self::$option_key . '[custom_code_footer]'

        ) ) );

    }


    /**
     * Add promo fields to section
     */
    public function add_placeholder($wp_customize){


        foreach($this->plugin_territory_sections as $section){

            $wp_customize->add_setting( self::$option_key . '[promo_'.$section.']', array(
                'capability' => 'edit_theme_options',
                'type'       => 'option',
            ) );

            $wp_customize->add_control( new Smart_Customize_ColorReadonly_Control( $wp_customize,$section, array(
                'settings' => self::$option_key . '[promo_'.$section.']',
                'section'    => $section,

                'type'       => 'text',

            )) );
      }

    }


	/**
	 * Get available fonts
	 *
	 * @since  project 1.1
	 * @return array
	 */
	public static function get_project_available_fonts() {
		$fonts = array(
			'arial'             => array(
				'name'   => 'Arial',
				'import' => '',
				'css'    => "font-family: Arial, sans-serif;"
			),
			'cantarell'         => array(
				'name'   => 'Cantarell',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Cantarell);',
				'css'    => "font-family: 'Cantarell', sans-serif;"
			),
			'droid'             => array(
				'name'   => 'Droid Sans',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Droid+Sans);',
				'css'    => "font-family: 'Droid Sans', sans-serif;"
			),
			'lato'              => array(
				'name'   => 'Lato',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Lato);',
				'css'    => "font-family: 'Droid Sans', sans-serif;"
			),
			'merriweather-sans' => array(
				'name'   => 'Merriweather Sans',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Merriweather+Sans:400,700&amp;subset=latin,latin-ext);',
				'css'    => "font-family: 'Merriweather Sans', sans-serif;"
			),
			'open-sans'         => array(
				'name'   => 'Open Sans',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Open+Sans);',
				'css'    => "font-family: 'Open Sans', sans-serif;"
			),
			'open-sans-condesed'=> array(
				'name'   => 'Open Sans Condensed',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&amp;subset=latin,latin-ext);',
				'css'    => "font-family: 'Open Sans Condensed', sans-serif;"
			),
			'roboto'            => array(
				'name'   => 'Roboto',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Roboto&subset=latin,latin-ext);',
				'css'    => "font-family: 'Roboto', sans-serif;"
			),
			'source-sans-pro'   => array(
				'name'   => 'Source Sans Pro',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro&subset=latin,latin-ext);',
				'css'    => "font-family: 'Source Sans Pro', sans-serif;"
			),
			'Tahoma'            => array(
				'name'   => 'Tahoma',
				'import' => '',
				'css'    => "font-family: Tahoma, sans-serif;"
			),
			'dosis'   => array(
				'name'   => 'Dosis',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Dosis:500&subset=latin,latin-ext);',
				'css'    => "font-family: 'Dosis', sans-serif;"
			),
			'vollkorn'          => array(
				'name'   => 'Vollkorn',
				'import' => '@import url(http://fonts.googleapis.com/css?family=Vollkorn);',
				'css'    => "font-family: 'Vollkorn', serif;"
			),

		);

		return apply_filters( 'project_available_fonts', $fonts );
	}

	/**
	 * Get array of fonts -> wp_customize control select
	 *
	 * @since  project 1.1
	 * @return array
	 */
	public static function get_project_choices_fonts() {
		$font_array   = self::get_project_available_fonts();
		$font_choices = array();

		foreach ( $font_array as $key=> $row ) {
			$font_choices[$key] = $row['name'];
		}
		return $font_choices;
	}

}


/**
 * Customize for textarea, extend the WP customizer
 *

 * @subpackage project
 * @since      project 1.0
 */
if (class_exists('WP_Customize_Control'))
{
class project_Customize_Textarea_Control extends WP_Customize_Control {
	public $type = 'textarea';

	public function render_content() {
		?>
	<label>
		<?php echo esc_html( $this->label ); ?></label>
	<textarea rows="5"
						style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>

	<?php
	}
}
}
/**
 * Customize for input range field, extend the WP customizer
 *

 * @subpackage project
 * @since      project 1.0
 */
if (class_exists('WP_Customize_Control'))
{
class project_Customize_Range_Control extends WP_Customize_Control {
	public $type = 'text';

	public function render_content() {
		?>
	<fieldset class="range-fieldset">
		<label for="<?php echo $this->id ?>">
			<?php echo esc_html( $this->label ); ?></label>
		<input type="text" class="slider-range-input" readonly="readonly" id="<?php echo $this->id ?>" class="range-customize-input" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" /><span>px</span>

		<div class="noUiSlider <?php echo $this->id ?>" rel="<?php echo $this->id ?>"></div>
	</fieldset>
	<?php
	}
}

    class Smart_Customize_ColorReadonly_Control extends WP_Customize_Control {
        public $type = 'text';

        public function render_content() {
            ?>
        <li id="maxflat_customize_layout_placeholder" class="maxflat_customize_layout_placeholder">
            <div class="smartlib-form-proversion-info-outer">
                <div class="smartlib-form-proversion-info-inner"><a href="<?php _e('http://netbiel.pl/maxflat', 'maxflat') ?>" target="_blank" class="maxflat-proversion-link"><?php _e('Available in pro version &#187;', 'maxflat');?></a></div>
                <div class="smartlib-color-readonly-image"></div>
            </div>
        <?php
        }
    }

}








