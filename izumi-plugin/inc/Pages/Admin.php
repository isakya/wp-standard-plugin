<?php
/**
 * @package IzumiPlugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
    public $settings;
    public $pages = array();

    public function __construct()
    {
        $this->settings = new SettingsApi();
        $this->pages = array(
            array(
                'page_title' => 'Izumi Plugin',
                'menu_title' => 'Izumi',
                'capability' => 'manage_options',
                'menu_slug' => 'izumi_plugin',
                'callback' => function() {echo '<h1>Plugin</h1>';},
                'icon_url' => 'dashicons-store',
                'position' => 110
            ),
            array(
                'page_title' => 'Test Plugin',
                'menu_title' => 'Test',
                'capability' => 'manage_options',
                'menu_slug' => 'test_plugin',
                'callback' => function() {echo '<h1>External</h1>';},
                'icon_url' => 'dashicons-external',
                'position' => 9
            ),
        );
    }

    public function register()
    {
        $this->settings->addPages($this->pages)->register();
    }
}