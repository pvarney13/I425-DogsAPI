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

//Retrieve all breeds
    public static function getBreeds()
    {
        $breeds = self::all();
        //$breeds=self::with(['sizeID', 'temperamentID', 'categoryID', 'originID'])->get();
        return $breeds;
    }

    //Retrieve a specific breed by ID number
    public static function getBreedByID(int $breedID)
    {
        $breed = self::findOrFail($breedID);
        //$breed->load("sizeID")->load("temperamentID")->load("categoryID")->load("originID");
        return $breed;
    }
}
