<?php
/**
 * Author: Lily Weber
 * Date: 5/25/2022
 * File: ColorController.php
 * Description:
 */
namespace DogBreedsAPI\Controllers;

use DogBreedsAPI\Validation\Validator;
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

    //Create a color
    public function create(Request $request, Response $response, array $args) : Response {
        //Validate the request
        $validation = Validator::validateColor($request);
        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }
        //Create a new color
        $color = Color::createColor($request);
        if(!$color) {
            $results['status']= "Color cannot been created.";
            return Helper::withJson($response, $results, 500);
        }
        $results = [
            'status' => "Color has been created.",
            'data' => $color
        ];
        return Helper::withJson($response, $results, 200);
    }

    //Update a category
    public function update(Request $request, Response $response, array $args) : Response {
        //Validate the request
        $validation = Validator::validateColor($request);
        //if validation failed
        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }
        $color = Color::updateColor($request);
        if(!$color) {
            $results['status']= "Color cannot been updated.";
            return Helper::withJson($response, $results, 500);
        }
        $results = [
            'status' => "Color has been updated.",
            'data' => $color
        ];
        return Helper::withJson($response, $results, 200);
    }

    //Delete a color
    public function delete(Request $request, Response $response, array $args) : Response {
        $color = Color::deleteColor($request);

        if(!$color) {
            $results['status']= "Color cannot been deleted.";
            return Helper::withJson($response, $results, 500);
        }

        $results['status'] = "Color has been deleted.";
        return Helper::withJson($response, $results, 200);
    }
}