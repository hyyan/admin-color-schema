<?php

/*
 * This file is part of the hyyan/admin-color-schema plugin.
 * (c) Hyyan Abo Fakher <tiribthea4hyyan@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hyyan\AdminColorSchema;

/**
 * HyyanAdminColorSchema
 *
 * @author Hyyan
 */
class HyyanAdminColorSchema {

    /**
     * Constrcut the plugin
     */
    public function __construct() {

        $this->removeColorPicker();

        // register admin hooks
        add_action('admin_init', array($this, 'collectSchema'));
        add_action('user_register', array($this, 'registerDefaultColorSchema'));
    }

    /**
     * Collect schema from wordpress active theme
     * 
     * @return boolean true on success false if color schema folder is not exists
     *                 in the active theme folder
     */
    public function collectSchema() {

        $options = $this->getOptions();
        $path = get_template_directory() . $options['path'];

        // make sure that the color schema folder exsists
        if (!file_exists($path) || !is_dir($path)) {
            return; // just ignore 
        }

        // register the new color schema
        $contents = new \DirectoryIterator($path);
        foreach ($contents as $content) {
            if ($contents->isDot())
                continue;
            if ($contents->isDir()) {
                $name = $content->getFilename();
                $init = parse_ini_file($content->getPathname() . '/schema.ini');
                if (!is_array($init))
                    trigger_error('Unbale Admin Color Schema Config File', E_USER_ERROR);

                $suffix = is_rtl() ? '-rtl' : '';
                $url = get_template_directory_uri()
                        . $options['path']
                        . '/'
                        . $name
                        . "/colors{$suffix}.css";

                wp_admin_css_color(
                        $name
                        , __(
                                (isset($init['name']) && !empty($init['name'])) ?
                                        $init['name'] : $name
                                , isset($init['domain']) && !empty($init['domain']) ?
                                        $init['domain'] : 'default'
                        )
                        , $url
                        , isset($init['colors']) && is_array($init['colors']) ?
                                $init['colors'] : array()
                        , isset($init['icons']) && is_array($init['icons']) ?
                                $init['icons'] : array()
                );
            }
        }
    }

    /**
     * Register the default color schmea for every new registered user
     * 
     * @param int $userId the user id
     */
    public function registerDefaultColorSchema($userId) {
        $setting = $this->getOptions();
        if ($setting['default']) {
            wp_update_user(array(
                'ID' => $userId,
                'admin_color' => $setting['default']
            ));
        }
    }

    /**
     * Remove color picker from profile page
     * 
     * this method will remove the color picker from profile page if the
     * "disable_color_picker" is set to true where default is false
     */
    protected function removeColorPicker() {
        $setting = $this->getOptions();
        if (
                current_user_can('manage_options') &&
                $setting['disable_color_picker'] == true
        ) {
            remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
        }
    }

    /**
     * Get the default options 
     * 
     * You can change the default options by using the 
     * "Hyyan\AdminColorSchema.options" filter
     * 
     * @return array array with the following as default :
     *                 $default = array(
     *                      // path relative to the theme dir
     *                      'path' => '/color-schema',
     *                      // default color-schema to activate for every new user
     *                      'default' => '',
     *                      // if true the user will no more able to change its dashboard color schema
     *                      // and the default one will be used
     *                      'disable_color_picker' => false,
     *                )
     */
    public function getOptions() {
        $default = array(
            // path relative to the theme dir
            'path' => '/color-schema',
            // default color-schema to activate for every new user
            'default' => '',
            // if true the user will no more able to change its dashboard color schema
            // and the default one will be used
            'disable_color_picker' => false,
        );
        return apply_filters('Hyyan\AdminColorSchema.options', $default);
    }

}
