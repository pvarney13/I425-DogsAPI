<?php
/**
 * Author: Lily Weber
 * Date: 5/23/2022
 * File: BreedColorController.php
 * Description:
 */
namespace DogBreedsAPI\Controllers;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DogBreedsAPI\Models\BreedColor;
use DogBreedsAPI\Controllers\ControllerHelper as Helper;

class BreedColorController {

    //Retrieve all the color breed combos
    public function index(Request $request, Response $response, array $args) : Response {
        $results = BreedColor::getBreedColor();
        return Helper::withJson($response, $results, 200);
    }

    //View a specific breed/color by composite key
    public function view(Request $request, Response $response, array $args) : Response {
        $results = BreedColor::getBreedColorByID($args['breed_color_id']);
        return Helper::withJson($response, $results, 200);
    }


}