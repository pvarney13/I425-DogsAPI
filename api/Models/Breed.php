<?php
/**
 * Author: Lily Weber
 * Date: 5/23/2022
 * File: Breed.php
 * Description:
 */
namespace DogBreedsAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{

    //The table associated with this model
    protected $table = 'breeds';

//The primary key of the table
    protected $primaryKey = 'breedID';

//The PK is numeric
    public $incrementing = true;


//If the created_at and updated_at columns are not used
    public $timestamps = false;

//define the one to many (inverse) relationship between category and breed
    public function categories(){
        return $this->belongsTo(Categories::class, 'categoryID');
    }

    /* Define the many-to-many relationship between Color and Breed model classes.
*  The third intermediate table linking the colors and breeds tables in DB is
 * breed_color. In the breed_color table, breedID and colorID are the foreign keys.
*/
    public function color() {
        return $this->belongsToMany(Color::class, 'breed_color', 'breedID', 'colorID');
    }

//Retrieve all breeds
    public static function getBreeds()
    {
        //$breeds = self::all();
        $breeds=self::with('categories')->get();
        return $breeds;
    }

    //Retrieve a specific breed by ID number
    public static function getBreedByID(int $breedID)
    {
        $breed = self::findOrFail($breedID);
        $breed->load('categories');
        return $breed;
    }

    //Get a student's classes
    public static function getBreedColors(string $id)
    {
        return self::findOrFail($id)->color;
    }
}
