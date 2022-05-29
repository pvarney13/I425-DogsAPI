<?php
/**
 * Author: Lily Weber
 * Date: 5/25/2022
 * File: Color.php
 * Description:
 */
namespace DogBreedsAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model{
    //The table associated with this model
    protected $table = 'colors';

    //The primary key of the table
    protected $primaryKey = 'colorID';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;

//define the one to many relationship between categories and breeds
    public function breedcolor(){
        return $this->hasMany(BreedColor::class , 'colorID');
    }

    /* Define the many-to-many relationship between Color and Breed model classes.
*  The third intermediate table linking the colors and breeds tables in DB is
* breed_color. In the breed_color table, breedID and colorID are the foreign keys.
*/
    public function breed() {
        return $this->belongsToMany(Breed::class, 'breed_color', 'colorID', 'breedID');
    }

    //Retrieve all categories
    public static function getColors() {
        //Retrieve all categories
        //$categories = self::all();
        $colors=self::with('breedcolor')->get();
        return $colors;
    }

    //View a specific category by id
    public static function getColorById(string $id) {
        $color = self::findOrFail($id);
        $color->load("breedcolor");
        return $color;
    }
    //Get breeds that come in a color
    public static function getColorsBreed(string $id)
    {
        return self::findOrFail($id)->breed;
    }

    //Update a color
    public static function updateColor($request) {
        //Retrieve parameters from request body
        $params = $request->getParsedBody();
        //Retrieve id from the request url
        $id = $request->getAttribute('id');
        $color = self::findOrFail($id);
        if(!$color) {
            return false;
        }
        //update attributes of the category
        foreach($params as $field => $value) {
            $color->$field = $value;
        }
        //save the category into the database
        $color->save();
        return $color;
    }


    //Delete a color
    public static function deleteColor($request) {
        //Retrieve id from the request
        $id = $request->getAttribute('id');
        $color = self::findOrFail($id);
        return($color ? $color->delete() : $color);
    }
}