# ACF { Field Type Template

Welcome to the repository for Advanced Custom Fields Field Type Template.
This repository holds a starting kit to create a field type Add-on with these abilities:
* works in ACF version 4
* works in ACF version 3
* works as a WP plugin
* works as a theme include

For more information, please read the documentation here:
http://www.advancedcustomfields.com/resources/tutorials/creating-a-new-field-type/

### Structure

* /css :  folder for .css files.
* /images : folder for image files
* /js : folder for .js files
* /lang : folder for .po and .mo files
* acf-{{field_name}}.php : Main add-on file. This file acts as the WP plugin and includes the neccessary field file
* {{field_name}}-v4.php : Field class compatible with ACF version 4
* {{field_name}}-v3.php : Field class compatible with ACF version 3
* readme.txt : WordPress readme file to be used by the wordpress repository if this add-on is also uploaded to WP

### step 1.

This template uses moustache placeholders such as this {{field_name}} throughout the file names and code. Use the list of placeholders below to do a 'find and replace'. The list below shows an example for a field called 'Google Maps'

**General**

* {{field_name}} : google_maps (used for class & file names so please use '_' instead of '-')
* {{field_label}} : Google Maps

**Readme**

* {{wp_user_name}} : elliotcondon
* {{full_name}} : Elliot Condon
* {{website}} : http://www.elliotcondon.com
* {{short_description}} : ...
* {{description}} : ...
* {{git_url}} : https://github.com/elliotcondon/acf-field-type-template

### step 2.

Edit the {{field_name}}-v4.php and {{field_name}}-v3.php files (now renamed with your field name) and include your custom code in the apropriate functions.
Please note that v3 and v4 field classes have slightly different functions. For more information, please read:
* http://www.advancedcustomfields.com/resources/tutorials/creating-a-new-field-type/
* http://www.advancedcustomfields.com/resources/tutorials/creating-a-new-field-type-v3/

### step 3.

Edit this README.md file with the apropriate information and delete all content above and including the following line!

-----------------------

# ACF { {{field_label}} Field

Adds a '{{field_label}}' field type for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin.

-----------------------

### Overview

{{description}}

### Compatibility

This add-on will work with:

* version 4 and up
* version 3 and bellow

### Installation

This add-on can be treated as both a WP plugin and a theme include.

**Install as Plugin**

1. Copy the 'acf-{{field_name}}' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

**Include within theme**

1.	Copy the 'acf-{{field_name}}' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.	Edit your functions.php file and add the code below (Make sure the path is correct to include the acf-{{field_name}}.php file)

```php
include_once('acf-{{field_name}}/acf-{{field_name}}.php');
```

### More Information

Please read the readme.txt file for more information
