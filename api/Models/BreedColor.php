<?php
/**
 * Author: Lily Weber
 * Date: 5/23/2022
 * File: BreedColor.php
 * Description:
 */
namespace DogBreedsAPI\Models;

use Illuminate\Database\Eloquent\Model;



class BreedColor extends Model{

    //table associated with this model
    protected $table = 'breed_color';

    //primary key of table
    protected $primaryKey = 'breed_color_id';

    //PK is numeric
    public $incrementing = true;

    //if created_at and updated_at columns are not used
    public $timestamps=false;

    //retrieve all breed color combos
    public static function getBreedColor(){

        $breed_color = self::all();
        //$breed_color=self::with("classes")->get();
        return $breed_color;
    }

    //Retrieve a specific breed/color combo
    public static function getBreedColorByID(int $breed_color_id) {
        $breed_color = self::findOrFail($breed_color_id);
        //$breed_color->load("breedID")->load("colorID");
        return $breed_color;
    }



}

