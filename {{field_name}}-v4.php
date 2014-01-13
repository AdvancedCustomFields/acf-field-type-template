<?php
/**
 * {{field_name}} field class.
 *
 * Used in ACF version 4+.
 */

class acf_field_{{field_name}} extends acf_field {
	// Variables.
	var $settings, // Will hold info such as dir/path.
	    $defaults; // Will hold default field options.

	/**
	 * Constructor.
	 *
	 * Set name/label needed for actions/filters.
	 *
	 * @since 3.6
	 */
	function __construct() {
		// Variables.
		$this->name = '{{field_name}}';
		$this->label = __( '{{field_label}}' );
		$this->category = __( "Basic",'acf' ); // Basic, Content, Choice, etc.
		$this->defaults = array(
			// Add default here to merge into your field.
			// This makes life easy when creating the field options as you don't need to use any if ( isset( '' ) ) logic. eg:
			//'preview_size' => 'thumbnail',
		);

		// Do not delete!
		parent::__construct();

		// Settings.
		$this->settings = array(
			'path' => apply_filters( 'acf/helpers/get_path', __FILE__ ),
			'dir' => apply_filters( 'acf/helpers/get_dir', __FILE__ ),
			'version' => '1.0.0',
		);
	}

	/**
	 * Create the field options.
	 *
	 * Create extra options for your field. This is rendered when editing a field.
	 * The value of $field['name'] can be used (like below) to save extra data to the $field.
	 *
	 * @since 3.6
	 *
	 * @param array $field An array holding all the field's data.
	 */
	function create_options( $field ) {
		// Defaults?
		/*
		$field = array_merge( $this->defaults, $field );
		*/

		// Key is needed in the field names to correctly save the data.
		$key = $field['name'];

		// Create Field Options HTML.
		?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e( 'Preview Size', 'acf' ); ?></label>
		<p class="description"><?php _e( 'Thumbnail is advised', 'acf' ); ?></p>
	</td>
	<td>
		<?php
		do_action( 'acf/create_field', array(
			'type'    => 'radio',
			'name'    => 'fields[' . $key . '][preview_size]',
			'value'   => $field['preview_size'],
			'layout'  => 'horizontal',
			'choices' => array(
				'thumbnail' => __( 'Thumbnail' ),
				'something_else' => __( 'Something Else' ),
			)
		));
		?>
	</td>
</tr>
		<?php
	}

	/**
	 * Create the field.
	 *
	 * Create the HTML interface for your field.
	 *
	 * @since 3.6
	 *
	 * @param array $field An array holding all the field's data.
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
	 * Add scripts and styles to the field admin page.
	 *
	 * This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	 * Use this action to add CSS + javaScript to assist your create_field() action.
	 *
	 * @since 3.6
	 *
	 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	 */
	function input_admin_enqueue_scripts() {
		// Note: This function can be removed if not used.

		// Register ACF scripts.
		wp_register_script( 'acf-input-{{field_name}}', $this->settings['dir'] . 'js/input.js', array( 'acf-input' ), $this->settings['version'] );
		wp_register_style( 'acf-input-{{field_name}}', $this->settings['dir'] . 'css/input.css', array( 'acf-input' ), $this->settings['version'] );

		// Scripts.
		wp_enqueue_script( array(
			'acf-input-{{field_name}}',
		) );

		// Styles.
		wp_enqueue_style( array(
			'acf-input-{{field_name}}',
		) );
	}

	/**
	 * Input admin head action.
	 *
	 * This action is called in the admin_head action on the edit screen where your field is created.
	 * Use this action to add CSS and JavaScript to assist your create_field() action.
	 *
	 * @since 3.6
	 *
	 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	 */
	function input_admin_head() {
		// Note: This function can be removed if not used.
	}

	/**
	 * Add scripts and styles to the field group edit page.
	 *
	 * This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	 * Use this action to add CSS + JavaScript to assist your create_field_options() action.
	 *
	 * @since 3.6
	 *
	 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	 */
	function field_group_admin_enqueue_scripts() {
		// Note: This function can be removed if not used.
	}

	/**
	 * Field group admin head action.
	 *
	 * This action is called in the admin_head action on the edit screen where your field is edited.
	 * Use this action to add CSS and JavaScript to assist your create_field_options() action.
	 *
	 * @since 3.6
	 *
	 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	 */
	function field_group_admin_head() {
		// Note: This function can be removed if not used.
	}

	/**
	 * Load the field value.
	 *
	 * This filter is applied to the $value after it is loaded from the database.
	 *
	 * @since 3.6
	 *
	 * @param  mixed $value The value found in the database.
	 * @param  mixed $post_id The $post_id from which the value was loaded.
	 * @param  array $field The field array holding all the field options.
	 * @return mixed The value to be saved in the database.
	 */
	function load_value( $value, $post_id, $field ) {
		// Note: This function can be removed if not used.
		return $value;
	}

	/**
	 * Update the field value.
	 *
	 * This filter is applied to the $value before it is updated in the database.
	 *
	 * @since	3.6
	 *
	 * @param  mixed $value The value which will be saved in the database.
	 * @param  mixed $post_id The $post_id of which the value will be saved.
	 * @param  array $field The field array holding all the field options.
	 * @return mixed The modified value.
	 */
	function update_value( $value, $post_id, $field ) {
		// Note: This function can be removed if not used.
		return $value;
	}

	/**
	 * Format the field value.
	 *
	 * This filter is applied to the $value after it is loaded from the database and before it is passed to the create_field action.
	 *
	 * @since	3.6
	 *
	 * @param  mixed $value The value which was loaded from the database.
	 * @param  mixed $post_id The $post_id from which the value was loaded.
	 * @param  array $field The field array holding all the field options.
	 * @return mixed The modified value.
	 */
	function format_value( $value, $post_id, $field ) {
		// Defaults?
		/*
		$field = array_merge( $this->defaults, $field );
		*/

		// Perhaps use $field['preview_size'] to alter the $value?

		// Note: This function can be removed if not used.
		return $value;
	}

	/**
	 * Format the field value for API calls.
	 *
	 * This filter is applied to the $value after it is loaded from the database and before it is passed back to the API functions such as the_field().
	 *
	 * @since 3.6
	 *
	 * @param  mixed $value The value which was loaded from the database.
	 * @param  mixed $post_id The $post_id from which the value was loaded.
	 * @param  array $field The field array holding all the field options.
	 * @return mixed The modified value.
	 */
	function format_value_for_api( $value, $post_id, $field ) {
		// Defaults?
		/*
		$field = array_merge( $this->defaults, $field );
		*/

		// Perhaps use $field['preview_size'] to alter the $value?

		// Note: This function can be removed if not used.
		return $value;
	}

	/**
	 * Load the field.
	 *
	 * This filter is applied to the $field after it is loaded from the database.
	 *
	 * @since 3.6
	 *
	 * @param  array $field The field array holding all the field options.
	 * @return array The field array holding all the field options.
	 */
	function load_field( $field ) {
		// Note: This function can be removed if not used.
		return $field;
	}

	/**
	 * Update the field.
	 *
	 * This filter is applied to the $field before it is saved to the database.
	 *
	 * @since 3.6
	 *
	 * @param  array $field The field array holding all the field options.
	 * @param  mixed $post_id The field group ID (post_type = acf).
	 * @return array The modified field.
	 */
	function update_field( $field, $post_id ) {
		// Note: This function can be removed if not used.
		return $field;
	}
}

// Create the field.
new acf_field_{{field_name}}();
