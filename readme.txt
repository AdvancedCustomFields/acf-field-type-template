=== Advanced Custom Fields: {{field_name}} Field ===
Contributors: {{wp_user_name}}
Author: {{full_name}}
Author URI: {{website}}
Plugin URI: {{git_url}}
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: trunk


== Copyright ==
Copyright 2011 - 2013 {{full_name}}

This software is NOT to be distributed, but can be INCLUDED in WP themes: Premium or Contracted.
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.


== Description ==

{{descripion}}

== Installation ==

This software can be treated as both a WP plugin and a theme include.

= Plugin =
1. Copy the 'acf-{{field_name}}' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

= Include =
1. Copy the 'acf-{{field_name}}' folder into your theme folder (can use sub folders)
   * You can place the folder anywhere inside the 'wp-content' directory
2. Edit your functions.php file and add the following code to include the field:

`
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('acf-{{field_name}}/{{field_name}}.php');
}
`

3. Make sure the path is correct to include the {{field_name}}.php file


== Changelog ==

= 0.0.1 =
* Initial Release.