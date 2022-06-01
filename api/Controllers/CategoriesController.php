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
use DogBreedsAPI\Models\Categories;
use DogBreedsAPI\Controllers\ControllerHelper as Helper;
use DogBreedsAPI\Validation\Validator;

class CategoriesController {
    //list all categories
    public function index(Request $request, Response $response, array $args) : Response {
        //$results = Categories::getCategories();
        //Get querystring variables from url
        $params = $request->getQueryParams();
        $term = array_key_exists('q', $params) ? $params['q'] : "";
        //Call the model method to get categories
        $results = ($term) ? Categories::searchCategories($term) : Categories::getCategories($request);
        return Helper::withJson($response, $results, 200);
    }

    //view a specific category
    public function view(Request $request, Response $response, array $args) : Response {
        $id = $args['id'];
        $results = Categories::getCategoryById($id);

        return Helper::withJson($response, $results, 200);
    }

//Create a category
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
        //Create a new category
        $category = Categories::createCategory($request);
        if(!$category) {
            $results['status']= "Category cannot been created.";
            return Helper::withJson($response, $results, 500);
        }
        $results = [
            'status' => "Category has been created.",
            'data' => $category
        ];
        return Helper::withJson($response, $results, 200);
    }

    //Update a category
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
        $category = Categories::updateCategory($request);
        if(!$category) {
            $results['status']= "Category cannot been updated.";
            return Helper::withJson($response, $results, 500);
        }
        $results = [
            'status' => "Category has been updated.",
            'data' => $category
        ];
        return Helper::withJson($response, $results, 200);
    }

    //Delete a category
    public function delete(Request $request, Response $response, array $args) : Response {
        $category = Categories::deleteCategory($request);

        if(!$category) {
            $results['status']= "Category cannot been deleted.";
            return Helper::withJson($response, $results, 500);
        }

        $results['status'] = "Category has been deleted.";
        return Helper::withJson($response, $results, 200);
    }
}