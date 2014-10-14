# [Wordpress Admin Color Schema ](https://github.com/hyyan/admin-color-schema/)

[![project status](http://stillmaintained.com/hyyan/admin-color-schema.png)](http://stillmaintained.com/hyyan/admin-color-schema)
[![Latest Stable Version](https://poser.pugx.org/hyyan/admin-color-schema/v/stable.svg)](https://packagist.org/packages/hyyan/admin-color-schema)
[![Total Downloads](https://poser.pugx.org/hyyan/admin-color-schema/downloads.svg)](https://packagist.org/packages/hyyan/admin-color-schema)
[![License](https://poser.pugx.org/hyyan/admin-color-schema/license.svg)](https://packagist.org/packages/hyyan/admin-color-schema)

The plugin to enable wordpress themes to add its own admin color schemas directly 
from theme

## Features

1. Adding new admin color shemas directly with theme
2. Activating specific admin color schema for every new registered user automatically
3. Removing admin color picker from users profile
4. Applying selected admin color shema on the wordpress adminbar in the frontend

## How to install

### Classical way
    
1. Download the plugin as zip archive and then upload it to your wordpress plugins folder and 
extract it there.
2. Activate the plugin from your admin panel

### Composer way

1. run composer command : ``` composer require hyyan/admin-color-schema```

## Example

The plugin comes with an example to see how the plugin works , it is under
```example/Dark``` folder.

To use the example :

1. Copy ```example/Dark``` to ```your/theme/folder/color-schema/Dark```
2. Activate the new schema from you profile 

![ScreenShot](https://raw.github.com/hyyan/admin-color-schema/master/example/Dark/screenshot.png
)
## How to use

### Plugin configutaion

The plugin comes with following configuration as default :

```php
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
```

You can override the default configuration using ```add_filters``` function like 
in the following example :

```php
// in the your theme's functions.php file

add_filter('Hyyan\AdminColorSchema.options', function(array $default) {

    // read schemas from "admin-color-schema" folder relative to current theme
    $default['path'] = '/admin-color-schema';

    // use Bluetheme as default schema for every new user
    $default['default'] = 'BlueTheme';

    return $default;
});
```

### Create new schema

If you are using the default path in the plugin configuration then :

1. Create ```color-schema``` in your theme root dir
2. Create new schema dir for example : ```vivid``` in the ```color-schema```
3. Create ```schema.ini``` file and configure it like in the following
   example :

```ini
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
```

4. create 'colors.scss' like the following example then complie it into ```colors.css```

```sass
$base-color: #52accc;
$icon-color: #e5f8ff;
$highlight-color: #096484;
$notification-color: #e1a948;
$button-color: #e1a948;

$menu-submenu-text: #e2ecf1;
$menu-submenu-focus-text: #fff;
$menu-submenu-background: #4796b3;

@import "...../wp-admin/css/colors/_admin.scss";
```


You are done ...

Go to your profile now and you will see your new color schema whiche you can 
activate


## Contributing

Everyone is welcome to help contribute and improve this plugin. There are several 
ways you can contribute:

* Reporting issues (please read [issue guidelines](https://github.com/necolas/issue-guidelines))
* Suggesting new features
* Writing or refactoring code
* Fixing [issues](https://github.com/hyyan/admin-color-schema/issues)

