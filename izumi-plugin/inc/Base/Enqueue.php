<?php
/**
 * @package IzumiPlugin
 */

namespace Inc\Base;
class Enqueue
{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue')); // 把样式文件加载到后台页面
    }

    function enqueue()
    {
        // 加载脚本
        wp_enqueue_style('mypluginstyle', PLUGIN_URL . 'assets/mystyle.css');
        wp_enqueue_script('mypluginscript', PLUGIN_URL . 'assets/myscript.js');
    }
}