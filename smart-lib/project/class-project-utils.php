<?php

class Smart_Project_Utils extends Smart_Base_Utils{



	public function __construct($obj_project){
		parent::__construct($obj_project);


	}



	/**
	 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
	 *
	 * @since MaxFlat 1.0
	 *
	 */
	function page_menu_args($args)
	{
		if (!isset($args['show_home']))
			$args['show_home'] = true;
		return $args;
	}

	/**
	 *
	 * Static function Writing log to File
	 * @static
	 *
	 * @param $log
	 */
	static function write_log($log){
		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else {
				error_log( $log );
			}
		}
	}

}
