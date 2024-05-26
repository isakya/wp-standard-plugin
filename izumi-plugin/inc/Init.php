<?php


/**
 * @package IzumiPlugin
 */

namespace Inc;

final class Init // 设置为常量，则这个类无法被继承也无法实例化
{
    // Inc文件夹下所有需要注册的类，都放这里
    public static function get_services()
    {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class

        ];
    }

    public static function register_services()
    {
        foreach(self::get_services() as $class) {
            $service = self::instantiate($class); // 实例化类
            if(method_exists($service, 'register')) { // 判断实例是否有register方法
                $service->register();
            }
        }
    }

    // 实例化类方法
    private static function instantiate($class) {
        return new $class();
    }
}
