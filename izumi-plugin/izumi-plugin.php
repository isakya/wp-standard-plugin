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
 * 激活和停用方法区
*/
use Inc\Base\Activate;
use Inc\Base\Deactivate;
function activate_izumi_plugin() {
    Activate::activate();
}
register_activation_hook(__FILE__, 'activate_izumi_plugin');


function deactivate_izumi_plugin() {
    deactivate::deactivate();
}
register_activation_hook(__FILE__, 'deactivate_izumi_plugin');


if(class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}