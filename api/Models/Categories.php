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
    protected $primaryKey = 'id';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;

    //Retrieve all categories
    public static function getCategories() {
        //Retrieve all categories
        $categories = self::all();
        return $categories;
    }

    //View a specific category by id
    public static function getCategoryById(string $id) {
        $category = self::findOrFail($id);
        return $category;
    }
}