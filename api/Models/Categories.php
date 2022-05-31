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
    public static function getCategories() {
        //Retrieve all categories
        //$categories = self::all();
        $categories=self::with('breeds')->get();
        return $categories;
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
}