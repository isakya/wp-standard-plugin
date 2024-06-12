<?php

/**
 * @package IzumiPlugin
 */

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard() {
        return require_once ("$this->plugin_path/templates/admin.php");
    }

//    public function izumiOptionsGroup($input) {
//        return $input;
//    }
//
//    public function izumiAdminSection() {
//        echo 'section!';
//    }

    public function izumiTextExample() {
        $value = esc_attr( get_option( 'text_example' ) ); // 获取自定义选项的数据
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!">';
    }

    public function izumiFirstName() {
        $value = esc_attr( get_option( 'first_name' ) ); // 获取自定义选项的数据
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your First Name">';
    }
}