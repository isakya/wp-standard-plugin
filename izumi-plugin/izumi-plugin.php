<?php
/**
 * @package IzumiPlugin
 */
/**
 * Plugin Name: Izumi Plugin
 */

if (!defined('ABSPATH')) {
    die;
}

if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

define('PLUGIN_PATH', plugin_dir_path(__FILE__)); // 定义插件根路径常量
define('PLUGIN_URL', plugin_dir_url(__FILE__)); // 定义插件根url路径

if(class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}