<?php
/**
 * @package IzumiPlugin
 */

namespace Inc;

class Deactivate {
    public static function deactivate() {
        flush_rewrite_rules();
    }
}