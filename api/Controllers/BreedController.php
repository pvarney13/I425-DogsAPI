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
use DogBreedsAPI\Validation\Validator;

class BreedController {

    //Retrieve all the breeds
    public function index(Request $request, Response $response, array $args) : Response {
        //$results = Breed::getBreeds($request);
        //Get querystring variables from url
        $params = $request->getQueryParams();
        $term = array_key_exists('q', $params) ? $params['q'] : "";
        //Call the model method to get breeds
        $results = ($term) ? Breed::searchBreeds($term) : Breed::getBreeds($request);

        return Helper::withJson($response, $results, 200);
    }

    //View a specific breed by ID
    public function view(Request $request, Response $response, array $args) : Response {
        $results = Breed::getBreedByID($args['breedID']);
        return Helper::withJson($response, $results, 200);
    }

    //View all colors of a breed
    public function getBreedColors(Request $request, Response $response, array $args) :
    Response {
        $id = $args['id'];
        $results = Breed::getBreedColors($id);
        return Helper::withJson($response, $results, 200);
    }

    //Create a breed
    public function create(Request $request, Response $response, array $args) : Response {
        //Validate the request
        $validation = Validator::validateCategory($request);
        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }
        //Create a new breed
        $breed = Breed::createBreed($request);
        if(!$breed) {
            $results['status']= "Breed cannot been created.";
            return Helper::withJson($response, $results, 500);
        }
        $results = [
            'status' => "Breed has been created.",
            'data' => $breed
        ];
        return Helper::withJson($response, $results, 200);
    }

    //Update a breed
    public function update(Request $request, Response $response, array $args) : Response {
        //Validate the request
        $validation = Validator::validateCategory($request);
        //if validation failed
        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }
        $breed = Breed::updateBreed($request);
        if(!$breed) {
            $results['status']= "Breed cannot been updated.";
            return Helper::withJson($response, $results, 500);
        }
        $results = [
            'status' => "Breed has been updated.",
            'data' => $breed
        ];
        return Helper::withJson($response, $results, 200);
    }

    //Delete a breed
    public function delete(Request $request, Response $response, array $args) : Response {
        $breed = Breed::deleteBreed($request);

        if(!$breed) {
            $results['status']= "Breed cannot be deleted.";
            return Helper::withJson($response, $results, 500);
        }

        $results['status'] = "Breed has been deleted.";
        return Helper::withJson($response, $results, 200);
    }

}