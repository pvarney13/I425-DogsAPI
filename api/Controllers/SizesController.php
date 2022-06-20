<?php
/**
 * Author: Piper Varney
 * Date: 5/23/22
 * File: CategoriesController.php
 * Description:
 */
namespace DogBreedsAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use DogBreedsAPI\Models\Sizes;
use DogBreedsAPI\Controllers\ControllerHelper as Helper;
use DogBreedsAPI\Validation\Validator;

class SizesController {
    //list all categories
    public function index(Request $request, Response $response, array $args) : Response {
        $results = Sizes::getSizes();


        return Helper::withJson($response, $results, 200);
    }

    //view a specific category
    public function view(Request $request, Response $response, array $args) : Response {
        $id = $args['id'];
        $results = Sizes::getSizeById($id);

        return Helper::withJson($response, $results, 200);
    }


}