<?php
/**
 * Author: Lily Weber
 * Date: 5/23/2022
 * File: BreedController.php
 * Description:
 */
namespace DogBreedsAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DogBreedsAPI\Models\Breed;
use DogBreedsAPI\Controllers\ControllerHelper as Helper;

class BreedController {

    //Retrieve all the breeds
    public function index(Request $request, Response $response, array $args) : Response {
        $results = Breed::getBreeds();
        return Helper::withJson($response, $results, 200);
    }

    //View a specific breed by ID
    public function view(Request $request, Response $response, array $args) : Response {
        $results = Breed::getBreedByID($args['breedID']);
        return Helper::withJson($response, $results, 200);
    }


}