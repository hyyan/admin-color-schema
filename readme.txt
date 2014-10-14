=== Admin Color Schema ===
Contributors: hyyan 
Tags: admin, admin color scheme, color, color scheme, scheme
Requires at least: 3.0.1
Tested up to: 4.0
<<<<<<< HEAD
Stable tag: 0.4.1
=======
Stable tag: 0.4.2
>>>>>>> master
License: MIT

Enable wordpress theme to add its own admin color schemas directly from theme

== Description ==

The plugin to enable wordpress themes to add its own admin color schemas directly from theme

**Features**

1. Adding new admin color shemas directly with theme
1. Activating specific admin color schema for every new registered user automatically
1. Removing admin color picker from users profile
1. Applying selected admin color shema on the wordpress adminbar in the frontend


**What I need**

You will need *scss* for fast theme generating based on the wordpress scss files,
But of course you can still use normal CSS file.

**Contributing**

Everyone is welcome to help contribute and improve this plugin. There are several 
ways you can contribute:

* Reporting issues (please read [issue guidelines](https://github.com/necolas/issue-guidelines))
* Suggesting new features
* Writing or refactoring code
* Fixing [issues](https://github.com/hyyan/admin-color-schema/issues)

**Eaxmple**

The plugin comes with an example to see how the plugin works , it is under example/Dark folder.

To use the example :

1. Copy example/Dark to your/theme/folder/color-schema/Dark
1. Activate the new schema from you profile

**Plugin configutaion**

The plugin comes with following configuration as default :

`<? php
$default = array(
    // path relative to the theme dir 
    'path' => '/color-schema',
    // default color-schema to activate for every new user
    'default' => '',
    // if true the user will be no more able to change its dashboard color schema
    // and the default one will be used
    'disable_color_picker' => false,
    // enable color-schema on fontend
    'enbale-on-frontend' => true,
);
?>`

You can override the default configuration using *add_filter* function like 
in the following example :

`<?php

// in the your theme's functions.php file
add_filter('Hyyan\AdminColorSchema.options', function(array $default) {

    // read schemas from "admin-color-schema" folder relative to current theme
    $default['path'] = '/admin-color-schema';

    // use Bluetheme as default schema for every new user
    $default['default'] = 'BlueTheme';

    return $default;
});
?>`

**Create new schema**

If you are using the default path in the plugin configuration then :

1. Create *color-schema* in your theme root dir
2. Create new schema dir for example : *(vivid)* in the *color-schema* dir
3. Create *schema.ini* file and configure it 
4. create *colors.scss* then complie it into `colors.css`


`
; schema.ini
; ==============
; 
; the name of your theme if not set the current dir name will  be used
; for example if your theme live in "color-schema/vivid" then "vivid" will be used as name of theme
name= my create theme 

;your translaion domain if not set the 'defualt' domain will be used
;the domain will be used to translate the theme name
domain= default

; colors preview (4 colors)
colors []= #52accc
colors []= #e5f8ff
colors []= #096484
colors []= #e1a948

; icons colors preview (4 colors)
icons []= #52accc
icons []= #e5f8ff
icons []= #096484
icons []= #e1a948
`
`
// colors.scss
// ============

$base-color: #52accc;
$icon-color: #e5f8ff;
$highlight-color: #096484;
$notification-color: #e1a948;
$button-color: #e1a948;

$menu-submenu-text: #e2ecf1;
$menu-submenu-focus-text: #fff;
$menu-submenu-background: #4796b3;

// require the path relative to your wordpres (wp-admin) folder
@import "...../wp-admin/css/colors/_admin.scss";
`


You are done ...

Go to your profile now and you will see your new color schema whiche you can 
activate
 

== Installation ==

**Classical Way**

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

### Composer way

1. run composer command : ``` composer require hyyan/admin-color-schema```

== Screenshots ==

1. Showing the dark example

== Changelog ==

=0.4.2=

* Prevented direct access for the plugin file

=0.4.1=

* Fixed errors in the wordpress text file

=0.4=

* Added support for wordpress repository

<<<<<<< HEAD
=======
=0.4=

*Added support for wordpress repository

>>>>>>> master
=0.3=

* Changed the plugin name to ```Hyyan Admin Color Schema```

=0.2=
 
The release is the same as ```0.1.1``` but ```0.1.1``` is wrong release according
to the semantic versioning specification

=0.1.1=

* Added support for "github-updater" plugin
* prevented "removeColorPicker" method from checking if user can manage options

