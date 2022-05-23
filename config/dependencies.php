<?php
/**
 * Author: Piper Varney
 * Date: 5/23/22
 * File: dependencies.php
 * Description:
 */
use DI\Container;

use DogBreedsAPI\Controllers\CategoriesController;

    return function(Container $container) {
        // Set a dependency called "Categories"
        $container->set('Categories', function() {
            return new CategoriesController();
        });
    };