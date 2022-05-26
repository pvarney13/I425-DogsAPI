<?php
/**
 * Author: Lily Weber
 * Date: 5/25/2022
 * File: ColorController.php
 * Description:
 */
namespace DogBreedsAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DogBreedsAPI\Models\Color;
use DogBreedsAPI\Controllers\ControllerHelper as Helper;

class ColorController {
    //list all categories
    public function index(Request $request, Response $response, array $args) : Response {
        $results = Color::getColors();

        return Helper::withJson($response, $results, 200);
    }

    //view a specific category
    public function view(Request $request, Response $response, array $args) : Response {
        $id = $args['id'];
        $results = Color::getColorById($id);

        return Helper::withJson($response, $results, 200);
    }

    //View all colors of a breed
    public function getColorsBreed(Request $request, Response $response, array $args) :
    Response {
        $id = $args['id'];
        $results = Color::getColorsBreed($id);
        return Helper::withJson($response, $results, 200);
    }
}