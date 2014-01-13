<?php
/*
Plugin Name: Advanced Custom Fields: {{field_label}}
Plugin URI: {{git_url}}
Description: {{short_description}}
Version: 1.0.0
Author: {{full_name}}
Author URI: {{website}}
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class acf_field_{{field_name}}_plugin {
	/**
	 * Constructor.
	 *
	 * @since 3.6
	 */
	function __construct() {
		// Set text domain.
		/*
		$domain = 'acf-{{field_name}}';
		$mofile = trailingslashit( dirname( __File__ ) ) . 'lang/' . $domain . '-' . get_locale() . '.mo';
		load_textdomain( $domain, $mofile );
		*/

		// Version 4+.
		add_action( 'acf/register_fields', array( $this, 'register_fields' ) );

		// Version 3-.
		add_action( 'init', array( $this, 'init' ), 5 );
	}

	/**
	 * Init.
	 *
	 * @since 3.6
	 */
	function init() {
		if ( function_exists( 'register_field' ) ) {
			register_field( 'acf_field_{{field_name}}', dirname( __File__ ) . '/{{field_name}}-v3.php' );
		}
	}

	/**
	 * Register fields.
	 *
	 * @since 3.6
	 */
	function register_fields() {
		include_once( '{{field_name}}-v4.php' );
	}
}

new acf_field_{{field_name}}_plugin();
