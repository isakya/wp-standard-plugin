<?php
/**
 * @package IzumiPlugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;


class Admin extends BaseController
{
    public $settings;
    public $callbacks;
    public $pages = array();
    public $subpages = array();


    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

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
        $args = array(
            array(
                'option_group' => 'izumi_options_group',
                'option_name' => 'text_example',
                'callback' => array($this->callbacks, 'izumiOptionsGroup')
            ),
            array(
                'option_group' => 'izumi_options_group',
                'option_name' => 'first_name',
            )
        );

        $this->settings->setSettings($args);
    }

    public function setSections() {
        $args = array(
            array(
                'id' => 'izumi_admin_index',
                'title' => 'Settings',
                'callback' => array($this->callbacks, 'izumiAdminSection'),
                'page' => 'izumi_plugin'
            )
        );

        $this->settings->setSections($args);
    }

    public function setFields() {
        $args = array(
            array(
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => array($this->callbacks, 'izumiTextExample'),
                'page' => 'izumi_plugin',
                'section' => 'izumi_admin_index',
                'args' => array(
                    'label_for' => 'text_example',
                    'class' => 'example-class',
                )
            ),
            array(
                'id' => 'first_example',
                'title' => 'First Name',
                'callback' => array($this->callbacks, 'izumiFirstName'),
                'page' => 'izumi_plugin',
                'section' => 'izumi_admin_index',
                'args' => array(
                    'label_for' => 'first_name',
                    'class' => 'example-class',
                )
            )
        );

        $this->settings->setFields($args);
    }
}