<?php
/**
 * plugin unistall
 *
 * @package IzumiPlugin
 */

if(!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// 清除插件在数据库中的数据
// 原理根据帖子类型删除数据（不完善，还需查询出关联数据再删除）
$books = get_posts(array('post_type' => 'book', 'numberposts' => -1)); // 获取所有帖子
foreach($books as $book) {
    wp_delete_post($book -> ID, true); // 参数2 表示不放进垃圾桶，直接进行删除
}


// 直接操作数据库进行删除（完全清空数据）
global $wpdb;
$wpdb -> query("DELETE FROM wp_posts WHERE post_type = 'book'");
$wpdb -> query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)"); // 删除自定义的元数据，依赖第一个sql
$wpdb -> query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)"); // 也依赖第一个sql
