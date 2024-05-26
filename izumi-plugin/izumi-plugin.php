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

use Inc\Activate;
use Inc\Deactivate;
use Inc\Admin\AdminPages;

// 判断类是否存在
if (!class_exists('IzumiPlugin')) {
    class IzumiPlugin
    {
        public $plugin; // 存储插件名称的变量

        function __construct() {
            $this->plugin = plugin_basename(__FILE__); // 返回当前插件到当前文件的路径 如: "izumi-plugin/izumi-plugin.php"
        }

        function register()
        {
            // add_action('wp_enqueue_scripts', array($this, 'enqueue')); // 把样式文件加载到前台页面
            add_action('admin_enqueue_scripts', array($this, 'enqueue')); // 把样式文件加载到后台页面

            add_action('admin_menu', array($this, 'add_admin_pages')); // 加载后台自定义插件入口按钮

            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link')); // 注意：plugin_action_links_NAME-OF-MY-PLUGIN
        }

        public function settings_link($links) {
            // 在插件列表的当前插件信息当中添加自定义跳转到该插件设置页面的链接
            $settings_link = '<a href="admin.php?page=izumi_plugin">Settings</a>';
            array_push($links, $settings_link);
            return $links;
        }

        // 注册管理界面的入口按钮
        public function add_admin_pages() {
            add_menu_page('Izumi Plugin', 'Izumi', 'manage_options', 'izumi_plugin', array($this, 'admin_index'), 'dashicons-store', 110 );
        }

        // 定义plugin的设置界面
        public function admin_index() {
            require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
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
            Activate::activate();
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
    register_deactivation_hook(__FILE__, array('Deactivate', 'deactivate'));
}
