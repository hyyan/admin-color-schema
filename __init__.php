<?php

/*
 * Plugin Name: Admin Color Schema
 * Plugin URI: https://github.com/hyyan/admin-color-schema/
 * Description: A wordpress plugin to enable wordpress themes to add its own admin color schema directly from theme
 * Author: Hyyan Abo Fakher
 * Version: 0.2
 * Author URI: https://github.com/hyyan
 * GitHub Plugin URI: hyyan/admin-color-schema
 * License: MIT License
 */

require_once __DIR__ . '/src/HyyanAdminColorSchema.php';

/**
 * Bootstrap the plugin
 */
new HyyanAdminColorSchema();
