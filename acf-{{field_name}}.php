<?php
/*
Plugin Name: Advanced Custom Fields: {{field_name}}
Plugin URI: {{git_url}}
Description: {{description}}
Version: 1.0.0
Author: {{full_name}}
Author URI: {{website}}
License: GPL
Copyright: {{full_name}}
*/


add_action('acf/register_fields', '{{field_name}}_register_fields');
		
function {{field_name}}_register_fields()
{
	include_once('{{field_name}}.php');
}
		
?>