<?php
/**
 * @package IzumiPlugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;


class Admin extends BaseController
{
    public $settings;
    public $callbacks;
    public $callbacks_mngr;
    public $pages = array();
    public $subpages = array();


    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();

        $this->setPages();
        $this->setSubPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();


        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }

    public function setPages() {
        $this->pages = array(
            array(
                'page_title' => 'Izumi Plugin',
                'menu_title' => 'Izumi',
                'capability' => 'manage_options',
                'menu_slug' => 'izumi_plugin',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            )
        );
    }

    public function setSubPages() {
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

    public function setSettings() {
        $args = array();

        foreach ($this -> managers as $key => $value) {
            $args[] = array(
                'option_group' => 'izumi_plugin_settings',
                'option_name' => $key,
                'callback' => array($this->callbacks, 'checkboxSanitize')
            );
        }
        $this->settings->setSettings($args);
    }

    public function setSections() {
        $args = array(
            array(
                'id' => 'izumi_admin_index',
                'title' => 'Settings Manager',
                'callback' => array($this->callbacks_mngr, 'adminSectionManager'),
                'page' => 'izumi_plugin'
            )
        );

        $this->settings->setSections($args);
    }

    public function setFields() {
        foreach ($this -> managers as $key => $value) {
            $args[] = array(
                'id' => $key,
                'title' => $value,
                'callback' => array($this->callbacks_mngr, 'checkboxField'),
                'page' => 'izumi_plugin',
                'section' => 'izumi_admin_index',
                'args' => array(
                    'label_for' => $key,
                    'class' => 'ui-toggle'
                )
            );
        }
        $this->settings->setFields($args);
    }
}