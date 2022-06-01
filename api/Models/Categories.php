<?php
/**
 * Author: Piper Varney
 * Date: 5/23/22
 * File: Categories.php
 * Description:
 */

namespace DogBreedsAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model{
    //The table associated with this model
    protected $table = 'categories';

    //The primary key of the table
    protected $primaryKey = 'categoryID';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;

//define the one to many relationship between categories and breeds
    public function breeds(){
        return $this->hasMany(Breed::class , 'categoryID');
    }

    //Retrieve all categories
    public static function getCategories($request) {
        //Retrieve all categories
        //$categories = self::all();
        //$categories=self::with('breeds')->get();
        //return $categories;
        /*********** code for pagination and sorting *************************/
        //get the total number of row count
        $count = self::count();

        //Get querystring variables from url
        $params = $request->getQueryParams();

        //do limit and offset exist?
        $limit = array_key_exists('limit', $params) ? (int)$params['limit'] : 10;   //items per page
        $offset = array_key_exists('offset', $params) ? (int)$params['offset'] : 0;  //offset of the first item

        //pagination
        $links = self::getLinks($request, $limit, $offset);

        //build query
        $query = self::with('categories');  //build the query to get all courses
        $query = $query->skip($offset)->take($limit);  //limit the rows

        //code for sorting
        $sort_key_array = self::getSortKeys($request); //soft the output by one or more columns
        foreach ($sort_key_array as $column => $direction) { $query->orderBy($column, $direction);
        }

        //retrieve the breeds
        $breeds = $query->get();  //Finally, run the query and get the results

        //construct the data for response
        $results = [
            'totalCount' => $count,
            'limit' => $limit,
            'offset' => $offset,
            'links' => $links,
            'sort' => $sort_key_array,
            'data' => $breeds
        ];

        return $results;
    }

    //View a specific category by id
    public static function getCategoryById(string $id) {
        $category = self::findOrFail($id);
        $category->load("breeds");
        return $category;
    }

    //Insert a new category
    public static function createCategory($request) {
        //Retrieve parameters from request body
        $params = $request->getParsedBody();
        //Create a new Category instance
        $category = new Categories();
        //Set the category's attributes
        foreach($params as $field => $value) {
            $category->$field = $value;
        }
        //Insert the category into the database
        $category->save();
        return $category;
    }

    //Update a category
    public static function updateCategory($request) {
        //Retrieve parameters from request body
        $params = $request->getParsedBody();
        //Retrieve id from the request url
        $id = $request->getAttribute('id');
        $category = self::findOrFail($id);
        if(!$category) {
            return false;
        }
        //update attributes of the category
        foreach($params as $field => $value) {
            $category->$field = $value;
        }
        //save the category into the database
        $category->save();
        return $category;
    }


    //Delete a category
    public static function deleteCategory($request) {
        //Retrieve id from the request
        $id = $request->getAttribute('id');
        $category = self::findOrFail($id);
        return($category ? $category->delete() : $category);
    }

    //Search for categories
    public static function searchCategories($term) {
        if(is_numeric($term)) {
            $query = self::where('categoryID', '=', $term);
        } else {
            $query = self::where('categoryName', 'like', "%$term%")
                ->orWhere('categoryDesc', 'like', "%$term%");
        }
        return $query->get();
    }
}