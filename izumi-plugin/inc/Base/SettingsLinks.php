<?php
/**
 * @package IzumiPlugin
 */

namespace Inc\Base;

class SettingsLinks
{
    protected $plugin; // 声明一个变量，用来接收插件名称

    public function __construct()
    {
        $this->plugin = PLUGIN;
    }

    public function register()
    {
        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link')); // 注意：plugin_action_links_NAME-OF-MY-PLUGIN // php双引号会转译变量
    }

    public function settings_link($links)
    {
        // 在插件列表的当前插件信息当中添加自定义跳转到该插件设置页面的链接
        $settings_link = '<a href="admin.php?page=izumi_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}