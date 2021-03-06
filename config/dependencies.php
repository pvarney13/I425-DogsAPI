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
use DogBreedsAPI\Controllers\ColorController;
use DogBreedsAPI\Controllers\UserController;
use DogBreedsAPI\Controllers\SizesController;
use DogBreedsAPI\Controllers\OriginsController;
use DogBreedsAPI\Controllers\TemperamentsController;




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

    // Set a dependency called "Categories"
    $container->set('Sizes', function() {
        return new SizesController();
    });

    // Set a dependency called "Categories"
    $container->set('Origins', function() {
        return new OriginsController();
    });

    // Set a dependency called "Categories"
    $container->set('Temperaments', function() {
        return new TemperamentsController();
    });

    // Set a dependency called "Color
    $container->set('Color', function() {
        return new ColorController();
    });
    // Set a dependency called "User"
    $container->set('User', function() {
        return new UserController();
    });



};
