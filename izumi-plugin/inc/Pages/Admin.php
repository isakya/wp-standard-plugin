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
    public $subpages = array();

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
            )
        );
        $this->subpages = array(
            array(
                'parent_slug' => 'izumi_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'izumi_cpt',
                'callback' => function() {echo '<h1>CPT Manager</h1>';},
            ),
            array(
                'parent_slug' => 'izumi_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'izumi_taxonomies',
                'callback' => function() {echo '<h1>Taxonomies Manager</h1>';},
            ),
            array(
                'parent_slug' => 'izumi_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug' => 'izumi_Widgets',
                'callback' => function() {echo '<h1>Widgets Manager</h1>';},
            )
        );
    }

    public function register()
    {
        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }
}