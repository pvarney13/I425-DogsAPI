<?php
/**
 * Author: Piper Varney
 * Date: 5/23/22
 * File: Categories.php
 * Description:
 */

namespace DogBreedsAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Temperaments extends Model{
    //The table associated with this model
    protected $table = 'temperaments';

    //The primary key of the table
    protected $primaryKey = 'temperamentID';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;




    //View a specific category by id
    public static function getTemperamentById(string $id) {
        $temperament = self::findOrFail($id);
        $temperament->load('breeds');
        return $temperament;
    }

    //Retrieve all categories
    public static function getTemperaments()
    {
        //Retrieve all categories
        $temperaments = self::all();

        return $temperaments;
    }





}