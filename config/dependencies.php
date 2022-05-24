<?php
/**

 * Author: Lily Weber
 * Date: 5/22/2022
 * File: dependencies.php
 * Description: define dependencies, these are instances of the controller classes
 *
 */

use DI\Container;
use DogBreedsAPI\Controllers\BreedController;
use DogBreedsAPI\Controllers\BreedColorController;
use DogBreedsAPI\Controllers\CategoriesController;


return function(Container $container){

    //Set a dependency called "Breed"
    $container->set('Breed', function(){
        return new BreedController();
    });
        // Set a dependency called "BreedColor"
        $container->set('BreedColor', function() {
            return new BreedColorController();
        });
        // Set a dependency called "Categories"
        $container->set('Categories', function() {
            return new CategoriesController();
        });



};
