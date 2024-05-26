<?php
/**
 * @package IzumiPlugin
 */

namespace Inc\Pages;
class Admin
{
    public function register()
    {
        add_action('admin_menu', array($this, 'add_admin_pages')); // 加载后台自定义插件入口按钮
    }

    // 注册管理界面的入口按钮
    public function add_admin_pages()
    {
        add_menu_page('Izumi Plugin', 'Izumi', 'manage_options', 'izumi_plugin', array($this, 'admin_index'), 'dashicons-store', 110);
    }

    // 定义plugin的设置界面
    public function admin_index()
    {
        require_once PLUGIN_PATH . 'templates/admin.php';
    }
}