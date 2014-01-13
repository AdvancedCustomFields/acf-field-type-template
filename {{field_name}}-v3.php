<?php
/**
 * {{field_name}} field class.
 *
 * Used in ACF version 3 and below.
 */

class acf_field_{{field_name}} extends acf_Field {
	// Variables.
	var $settings, // Will hold info such as dir/path.
	    $defaults; // Will hold default field options.

	/**
	 * Constructor.
	 *
	 * This function is called when the field class is initalized on each page.
	 * Here you can add filters/actions and setup any other functionality for your field.
	 *
	 * @author Elliot Condon
	 * @since 2.2.0
	 */
	function __construct( $parent ) {
		// Do not delete!
		parent::__construct( $parent );

		// Set name/title.
		$this->name = '{{field_name}}';
		$this->title = __( '{{field_label}}' );
		$this->defaults = array(
			// Add default here to merge into your field.
			// This makes life easy when creating the field options as you don't need to use any if ( isset( '' ) ) logic. eg:
			//'preview_size' => 'thumbnail',
		);

		// Settings.
		$this->settings = array(
			'path' => $this->helpers_get_path( __FILE__ ),
			'dir' => $this->helpers_get_dir( __FILE__ ),
			'version' => '1.0.0',
		);
	}

	/**
	 * Calculate the path (works for plugin/theme folders).
	 *
	 * @since 3.6
	 */
	function helpers_get_path( $file ) {
		return trailingslashit( dirname( $file ) );
	}

	/**
	 * Calculate the directory (works for plugin/theme folders).
	 *
	 * @since 3.6
	 */
	function helpers_get_dir( $file ) {
		$dir = trailingslashit( dirname( $file ) );
		$count = 0;

		// Sanitize for Win32 installs.
		$dir = str_replace( '\\', '/', $dir );

		// If file is in plugins folder.
		$wp_plugin_dir = str_replace( '\\', '/', WP_PLUGIN_DIR );
		$dir = str_replace( $wp_plugin_dir, WP_PLUGIN_URL, $dir, $count );

		if ( $count < 1 ) {
			// If file is in wp-content folder.
			$wp_content_dir = str_replace( '\\', '/', WP_CONTENT_DIR );
			$dir = str_replace( $wp_content_dir, WP_CONTENT_URL, $dir, $count );
		}

		if ( $count < 1 ) {
			// If file is in ??? folder.
			$wp_dir = str_replace( '\\', '/', ABSPATH );
			$dir = str_replace( $wp_dir, site_url( '/' ), $dir );
		}

		return $dir;
	}

	/**
	 * Create the field options.
	 *
	 * This function is called from core/field_meta_box.php to create extra options for your field.
	 *
	 * @author Elliot Condon
	 * @since 2.2.0
	 *
	 * @param int $key The $_POST object key required to save the options to the field.
	 * @param array $field The field object.
	 */
	function create_options( $key, $field ) {
		// Defaults?
		/*
		$field = array_merge( $this->defaults, $field );
		*/

		// Create Field Options HTML.
		?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e( 'Preview Size', 'acf' ); ?></label>
		<p class="description"><?php _e( 'Thumbnail is advised', 'acf' ); ?></p>
	</td>
	<td>
		<?php

		$this->parent->create_field( array(
			'type'    => 'radio',
			'name'    => 'fields[' . $key . '][preview_size]',
			'value'	  => $field['preview_size'],
			'layout'  => 'horizontal',
			'choices' => array(
				'thumbnail' => __( 'Thumbnail' ),
				'something_else' => __( 'Something Else' ),
			)
		) );

		?>
	</td>
</tr>
		<?php
	}

	/**
	 * Pre-save the field.
	 *
	 * This function is called when saving your ACF object. Here you can manipulate
	 * the field object and its options before it gets saved to the database.
	 *
	 * @author Elliot Condon
	 * @since 2.2.0
	 */
	function pre_save_field( $field ) {
		// Note: This function can be removed if not used.

		// Do stuff with field (mostly format options data).

		return parent::pre_save_field( $field );
	}

	/**
	 * Create the field.
	 *
	 * This function is called on edit screens to produce the HTML for this field.
	 *
	 * @author Elliot Condon
	 * @since 2.2.0
	 */
	function create_field( $field ) {
		// Defaults?
		/*
		$field = array_merge( $this->defaults, $field );
		*/

		// Perhaps use $field['preview_size'] to alter the markup?

		// Create Field HTML.
		?>
		<div>

		</div>
		<?php
	}

	/**
	 * Admin head action.
	 *
	 * This function is called in the admin_head of the edit screen where your field
	 * is created. Use this function to create CSS and JavaScript to assist your
	 * create_field() function.
	 *
	 * @author Elliot Condon
	 * @since 2.2.0
	 */
	function admin_head() {
		// Note: This function can be removed if not used.
	}

	/**
	 * Print admin styles and scripts.
	 *
	 * This function is called in the admin_print_scripts/admin_print_styles where
	 * your field is created. Use this function to register CSS and JavaScript to
	 * assist your create_field() function.
	 *
	 * @author Elliot Condon
	 * @since 3.0.0
	 */
	function admin_print_scripts() {
		// Note: This function can be removed if not used.

		// Register ACF scripts.
		wp_register_script( 'acf-input-{{field_name}}', $this->settings['dir'] . 'js/input.js', array( 'acf-input' ), $this->settings['version'] );

		// Scripts.
		wp_enqueue_script( array(
			'acf-input-{{field_name}}',
		) );
	}

	function admin_print_styles() {
		// Note: This function can be removed if not used.

		wp_register_style( 'acf-input-{{field_name}}', $this->settings['dir'] . 'css/input.css', array( 'acf-input' ), $this->settings['version'] );

		// Styles.
		wp_enqueue_style( array(
			'acf-input-{{field_name}}',
		) );
	}

	/**
	 * Update the field value.
	 *
	 * This function is called when saving a post object to which your field is assigned.
	 * The function will pass through the 3 parameters for you to use.
	 *
	 * @author Elliot Condon
	 * @since 2.2.0
	 *
	 * @param int $post_id Useful if you need to save extra data or manipulate the current post object.
	 * @param array $field Useful if you need to manipulate the $value based on a field option.
	 * @param mixed $value The new value of your field.
	 */
	function update_value( $post_id, $field, $value ) {
		// Note: This function can be removed if not used.

		// Do stuff with value.

		// Save value.
		parent::update_value( $post_id, $field, $value );
	}

	/**
	 * Get the field value.
	 *
	 * Called from the edit page to get the value of your field. This function is useful
	 * if your field needs to collect extra data for your create_field() function.
	 *
	 * @author Elliot Condon
	 * @since 2.2.0
	 *
	 * @param int $post_id The post ID to which your value is attached.
	 * @param array $field The field object.
	 */
	function get_value( $post_id, $field ) {
		// Note: This function can be removed if not used.

		// Get value.
		$value = parent::get_value( $post_id, $field );

		// Format value.

		// Return value.
		return $value;
	}

	/**
	 * Get the field value for API calls.
	 *
	 * Called from your template file when using the API functions (get_field, etc).
	 * This function is useful if your field needs to format the returned value.
	 *
	 * @author Elliot Condon
	 * @since 3.0.0
	 *
	 * @param int $post_id The post ID to which your value is attached.
	 * @param array $field The field object.
	 */
	function get_value_for_api( $post_id, $field ) {
		// Note: This function can be removed if not used.

		// Get value.
		$value = $this->get_value( $post_id, $field );

		// Format value.

		// Return value.
		return $value;
	}
}
