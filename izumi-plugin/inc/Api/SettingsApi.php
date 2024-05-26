<?php
/**
 * @package IzumiPlugin
 */

namespace Inc\Api;

class SettingsApi
{
    public $admin_pages = array();

    public function register()
    {
        if (!empty($this->admin_pages)) { // 判断数组不为空
            add_action('admin_menu', array($this, 'add_admin_menu'));
        }
    }

    public function addPages(array $pages)
    {
        $this->admin_pages = $pages;

        return $this;
    }

    // 循环注册管理界面
    public function add_admin_menu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }
    }
}
