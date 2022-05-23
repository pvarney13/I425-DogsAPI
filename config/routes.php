<?php
/**
 * Author: Piper Varney
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

    //Route group api/v1 pattern
    $app->group('/api/v1', function(RouteCollectorProxy $group) {
        //Route group for /categories pattern
        $group->group('/categories', function (RouteCollectorProxy $group) {
            //Call the index method defined in the CategoriesController class
            //Categories is the container key defined in dependencies.php.
            $group->get('', 'Categories:index');
            $group->get('/{id}', 'Categories:view');
        });
    });
};