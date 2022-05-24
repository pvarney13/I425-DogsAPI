<?php
/**
 * Author: Piper Varney, Lily Weber
 * Date: 5/22/22
 * File: routes.php
 * Description: Define application routes
 */
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Add an app route
    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write('Welcome to the Dog Breeds API!');
        return $response;
    });

    // Add another route
    $app->get('/api/hello/{name}', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Hello " . $args['name']);
        return $response;
    });
//Route group for api/v1 pattern
    $app->group('/api/v1', function(RouteCollectorProxy $group){
    //Route group for /breeds pattern
    $group->group('/breeds', function (RouteCollectorProxy $group) {
        //Call the index method defined in the BreedController class
        $group->get('', 'Breed:index');
        //Call the view method defined in the BreedController class
        $group->get('/{breedID}', 'Breed:view');

    });
    //Route group for /categories pattern
    $group->group('/categories', function (RouteCollectorProxy $group) {
        //Call the index method defined in the CategoriesController class
        //Categories is the container key defined in dependencies.php.
        $group->get('', 'Categories:index');
        $group->get('/{id}', 'Categories:view');
    });

        //Route group for /breedcolor pattern
        $group->group('/breedcolor', function (RouteCollectorProxy $group) {
            //Call the index method defined in the BreedController class
            $group->get('', 'BreedColor:index');
            //Call the view method defined in the BreedController class
            $group->get('/{breed_color_id}', 'BreedColor:view');

        });
});
};
