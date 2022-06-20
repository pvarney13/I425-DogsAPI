<?php
/**
 * Author: Piper Varney
 * Date: 5/23/22
 * File: Categories.php
 * Description:
 */

namespace DogBreedsAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Origins extends Model{
    //The table associated with this model
    protected $table = 'origins';

    //The primary key of the table
    protected $primaryKey = 'originID';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;




    //View a specific category by id
    public static function getOriginById(string $id) {
        $origin = self::findOrFail($id);
        $origin->load('origins');
        return $origin;
    }

    //Retrieve all categories
    public static function getOrigins()
    {
        //Retrieve all categories
        $origins = self::all();

        return $origins;
    }





}