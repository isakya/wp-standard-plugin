<?php
/**
 * @package IzumiPlugin
 */

class IzumiPluginDeactivate {
    public static function deactivate() {
        flush_rewrite_rules();
    }
}