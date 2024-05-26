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
// 判断类是否存在
if (class_exists('IzumiPlugin')) {
    class IzumiPlugin
    {

        function register()
        {
            // add_action('wp_enqueue_scripts', array($this, 'enqueue')); // 把样式文件加载到前台页面
            add_action('admin_enqueue_scripts', array($this, 'enqueue')); // 把样式文件加载到后台页面
        }

        protected function create_post_type()
        {
            add_action('init', array($this, 'custom_post_type')); // 在wp init时 执行custom_post_type函数
        }

        function custom_post_type()
        {
            register_post_type('book', ['public' => true, 'label' => 'Books']);
        }

        function enqueue()
        {
            // 加载脚本
            wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
            wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
        }

        function activate()
        {
            require_once plugin_dir_path(__FILE__) . 'inc/izumi-plugin-activate.php';
            IzumiPluginActivate::activate();
        }
    }


    $izumiPlugin = new IzumiPlugin();
    $izumiPlugin->register(); // 不想让脚本加载放在构造函数中，因为构造函数是用来初始化和赋值变量的，而不是来执行动作的

    /**
     * 插件生命周期
     */
    // activation
    register_activation_hook(__FILE__, array($izumiPlugin, 'activate'));

    // deactivation
    require_once plugin_dir_path(__FILE__) . 'inc/izumi-plugin-deactivate.php';
    register_deactivation_hook(__FILE__, array('IzumiPluginDeactivate', 'deactivate'));
}
