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

/**
 * 常量定义区
 */
define('PLUGIN_PATH', plugin_dir_path(__FILE__)); // 定义插件根路径常量
define('PLUGIN_URL', plugin_dir_url(__FILE__)); // 定义插件根url路径
define('PLUGIN', plugin_basename(__FILE__)); // 定义插件名称常量

/**
 * 激活和停用方法区
*/
use Inc\Base\Activate;
use Inc\Base\Deactivate;
function activate_izumi_plugin() {
    Activate::activate();
}
function deactivate_izumi_plugin() {
    deactivate::deactivate();
}
register_activation_hook(__FILE__, 'activate_izumi_plugin');
register_activation_hook(__FILE__, 'deactivate_izumi_plugin');


if(class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}