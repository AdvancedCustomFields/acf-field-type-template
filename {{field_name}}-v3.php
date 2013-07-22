<?php

class acf_field_{{field_name}} extends acf_Field
{

	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options


	/*--------------------------------------------------------------------------------------
	*
	*	Constructor
	*	- This function is called when the field class is initalized on each page.
	*	- Here you can add filters / actions and setup any other functionality for your field
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function __construct($parent)
	{

		// do not delete!
  	parent::__construct($parent);

  	// set name / title
  	$this->name = '{{field_name}}';
	  $this->title = __('{{field_label}}');
	  $this->defaults = array(
		  // add default here to merge into your field.
		  // This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
		  //'preview_size' => 'thumbnail'
	  );

		// settings
		$this->settings = array(
			'path' => $this->helpers_get_path(__FILE__),
			'dir' => $this->helpers_get_dir(__FILE__),
			'version' => '1.0.0'
		);

  }


 	/*
  *  helpers_get_path
  *
  *  @description: calculates the path (works for plugin / theme folders)
  *  @since: 3.6
  *  @created: 30/01/13
  */

  function helpers_get_path($file)
  {
    return trailingslashit(dirname($file));
  }


  /*
  *  helpers_get_dir
  *
  *  @description: calculates the directory (works for plugin / theme folders)
  *  @since: 3.6
  *  @created: 30/01/13
  */

  function helpers_get_dir($file)
  {
    $dir = trailingslashit(dirname($file));
    $count = 0;


    // sanitize for Win32 installs
    $dir = str_replace('\\', '/', $dir);


    // if file is in plugins folder
    $wp_plugin_dir = str_replace('\\', '/', WP_PLUGIN_DIR);
    $dir = str_replace($wp_plugin_dir, WP_PLUGIN_URL, $dir, $count);


    if($count < 1)
    {
      // if file is in wp-content folder
      $wp_content_dir = str_replace('\\', '/', WP_CONTENT_DIR);
      $dir = str_replace($wp_content_dir, WP_CONTENT_URL, $dir, $count);
    }


    if($count < 1)
    {
      // if file is in ??? folder
      $wp_dir = str_replace('\\', '/', ABSPATH);
      $dir = str_replace($wp_dir, site_url('/'), $dir);
    }

    return $dir;
  }


	/*--------------------------------------------------------------------------------------
	*
	*	create_options
	*	- this function is called from core/field_meta_box.php to create extra options
	*	for your field
	*
	*	@params
	*	- $key (int) - the $_POST obejct key required to save the options to the field
	*	- $field (array) - the field object
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function create_options($key, $field)
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/


		// Create Field Options HTML
		?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Preview Size", 'acf'); ?></label>
		<p class="description"><?php _e("Thumbnail is advised", 'acf'); ?></p>
	</td>
	<td>
		<?php

		$this->parent->create_field(array(
			'type'    =>	'radio',
			'name'    =>	'fields[' . $key . '][preview_size]',
			'value'	  => $field['preview_size'],
			'layout'  => 'horizontal',
			'choices'	=> array(
				'thumbnail' => __('Thumbnail'),
				'something_else' => __('Something Else'),
			)
		));

		?>
	</td>
</tr>
		<?php
	}


	/*--------------------------------------------------------------------------------------
	*
	*	pre_save_field
	*	- this function is called when saving your acf object. Here you can manipulate the
	*	field object and it's options before it gets saved to the database.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function pre_save_field($field)
	{
		// Note: This function can be removed if not used

		// do stuff with field (mostly format options data)

		return parent::pre_save_field($field);
	}


	/*--------------------------------------------------------------------------------------
	*
	*	create_field
	*	- this function is called on edit screens to produce the html for this field
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function create_field($field)
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// perhaps use $field['preview_size'] to alter the markup?


		// create Field HTML
		?>
		<div>

		</div>
		<?php
	}


	/*--------------------------------------------------------------------------------------
	*
	*	admin_head
	*	- this function is called in the admin_head of the edit screen where your field
	*	is created. Use this function to create css and javascript to assist your
	*	create_field() function.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*--------------------------------------------------------------------------------------
	*
	*	admin_print_scripts / admin_print_styles
	*	- this function is called in the admin_print_scripts / admin_print_styles where
	*	your field is created. Use this function to register css and javascript to assist
	*	your create_field() function.
	*
	*	@author Elliot Condon
	*	@since 3.0.0
	*
	*-------------------------------------------------------------------------------------*/

	function admin_print_scripts()
	{
		// Note: This function can be removed if not used


		// register acf scripts
		wp_register_script('acf-input-{{field_name}}', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version']);

		// scripts
		wp_enqueue_script(array(
			'acf-input-{{field_name}}',
		));


	}

	function admin_print_styles()
	{
		// Note: This function can be removed if not used


		wp_register_style('acf-input-{{field_name}}', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version']);

		// styles
		wp_enqueue_style(array(
			'acf-input-{{field_name}}',
		));
	}


	/*--------------------------------------------------------------------------------------
	*
	*	update_value
	*	- this function is called when saving a post object that your field is assigned to.
	*	the function will pass through the 3 parameters for you to use.
	*
	*	@params
	*	- $post_id (int) - usefull if you need to save extra data or manipulate the current
	*	post object
	*	- $field (array) - usefull if you need to manipulate the $value based on a field option
	*	- $value (mixed) - the new value of your field.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function update_value($post_id, $field, $value)
	{
		// Note: This function can be removed if not used

		// do stuff with value

		// save value
		parent::update_value($post_id, $field, $value);
	}


	/*--------------------------------------------------------------------------------------
	*
	*	get_value
	*	- called from the edit page to get the value of your field. This function is useful
	*	if your field needs to collect extra data for your create_field() function.
	*
	*	@params
	*	- $post_id (int) - the post ID which your value is attached to
	*	- $field (array) - the field object.
	*
	*	@author Elliot Condon
	*	@since 2.2.0
	*
	*-------------------------------------------------------------------------------------*/

	function get_value($post_id, $field)
	{
		// Note: This function can be removed if not used

		// get value
		$value = parent::get_value($post_id, $field);

		// format value

		// return value
		return $value;
	}


	/*--------------------------------------------------------------------------------------
	*
	*	get_value_for_api
	*	- called from your template file when using the API functions (get_field, etc).
	*	This function is useful if your field needs to format the returned value
	*
	*	@params
	*	- $post_id (int) - the post ID which your value is attached to
	*	- $field (array) - the field object.
	*
	*	@author Elliot Condon
	*	@since 3.0.0
	*
	*-------------------------------------------------------------------------------------*/

	function get_value_for_api($post_id, $field)
	{
		// Note: This function can be removed if not used

		// get value
		$value = $this->get_value($post_id, $field);

		// format value

		// return value
		return $value;

	}

}

?>
