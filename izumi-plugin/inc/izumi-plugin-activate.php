<?php
/**
 * @package IzumiPlugin
 */

class IzumiPluginActivate {
    public static function activate() {
        flush_rewrite_rules();
    }
}