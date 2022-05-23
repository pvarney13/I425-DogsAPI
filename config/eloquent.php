<?php
/**
 * Author: Piper Varney
 * Date: 5/22/22
 * File: eloquent.php
 * Description: Enable Eloquent ORM in the app
 */
use DI\Container;
use Illuminate\Database\Capsule\Manager;

return static function (Container $container) {
    // boot eloquent
    $capsule = new Manager;
    $capsule->addConnection($container->get('settings')['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
};