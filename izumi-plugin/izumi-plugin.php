<?php
/**
 * @package IzumiPlugin
 */
/**
 * Plugin Name: Izumi Plugin
 */

if(!defined('ABSPATH')){
    die;
}

class IzumiPlugin {
    function __construct(string $string) {
        echo $string;
    }

    function activate() {
        echo 'activated';
    }

    function deactivate() {
        echo 'deactivated';
    }

    function uninstall() {

    }
}

// 判断类是否存在
if(class_exists('IzumiPlugin')) {
    $izumiPlugin = new IzumiPlugin('izumi');
}

/**
 * 插件生命周期
 */
// activation
register_activation_hook(__FILE__, array( $izumiPlugin, 'activate'));

// deactivation
register_deactivation_hook(__FILE__, array( $izumiPlugin, 'deactivate'));

// uninstall