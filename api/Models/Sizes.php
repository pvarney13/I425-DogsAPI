<?php
/**
 * Author: Piper Varney
 * Date: 5/23/22
 * File: Categories.php
 * Description:
 */

namespace DogBreedsAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Sizes extends Model{
    //The table associated with this model
    protected $table = 'sizes';

    //The primary key of the table
    protected $primaryKey = 'sizeID';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;




    //View a specific category by id
    public static function getSizeById(string $id) {
        $size = self::findOrFail($id);
        $size->load('breeds');
        return $size;
    }

    //Retrieve all categories
    public static function getSizes()
    {
        //Retrieve all categories
        $sizes = self::all();

        return $sizes;
    }





}