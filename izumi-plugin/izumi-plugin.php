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
    function __construct() {
        add_action('init', array($this, 'custom_post_type')); // 在wp init时 执行custom_post_type函数
    }

    function activate() {
        $this -> custom_post_type(); // 注册自定义帖子函数还需要放在生命周期的激活函数中，不然有可能会不生成自定义post
        flush_rewrite_rules(); // 重新生成自定义 post 的url
    }

    function deactivate() {

    }

    function custom_post_type() {
        register_post_type('book', ['public' => true, 'label' => 'Books']);
    }
}

// 判断类是否存在
if(class_exists('IzumiPlugin')) {
    $izumiPlugin = new IzumiPlugin();
}

/**
 * 插件生命周期
 */
// activation
register_activation_hook(__FILE__, array( $izumiPlugin, 'activate'));

// deactivation
register_deactivation_hook(__FILE__, array( $izumiPlugin, 'deactivate'));
