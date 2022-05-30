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
    public static function getBreeds($request)
    {
        /*//$breeds = self::all();
        $breeds=self::with('categories')->get();
        return $breeds;*/
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

    //Retrieve a specific breed by ID number
    public static function getBreedByID(int $breedID)
    {
        $breed = self::findOrFail($breedID);
        $breed->load('categories');
        return $breed;
    }

    //Get a breed's color
    public static function getBreedColors(string $id)
    {
        return self::findOrFail($id)->color;
    }

    // Return an array of links for pagination. The array includes links for the current, first, next, and last pages.
    private static function getLinks($request, $limit, $offset) {
        $count = self::count();

        // Get request uri and parts
        $uri = $request->getUri();
        if($port = $uri->getPort()) {
            $port = ':' . $port;
        }
        $base_url = $uri->getScheme() . "://" . $uri->getHost() . $port . $uri->getPath();

        // Construct links for pagination
        $links = [];
        $links[] = ['rel' => 'self', 'href' => "$base_url?limit=$limit&offset=$offset"];
        $links[] = ['rel' => 'first', 'href' => "$base_url?limit=$limit&offset=0"];
        if ($offset - $limit >= 0) {
            $links[] = ['rel' => 'prev', 'href' => "$base_url?limit=$limit&offset=" . $offset - $limit];
        }
        if ($offset + $limit < $count) {
            $links[] = ['rel' => 'next', 'href' => "$base_url?limit=$limit&offset=" . $offset + $limit];
        }
        $links[] = ['rel' => 'last', 'href' => "$base_url?limit=$limit&offset=" . $limit * (ceil($count / $limit) - 1)];

        return $links;
    }

    /*
     * Sort keys are optionally enclosed in [ ], separated with commas;
     * Sort directions can be optionally appended to each sort key, separated by :.
     * Sort directions can be 'asc' or 'desc' and defaults to 'asc'.
     * Examples: sort=[number:asc,title:desc], sort=[number, title:desc]
     * This function retrieves sorting keys from uri and returns an array.
    */
    private static function getSortKeys($request) {
        $sort_key_array = [];

        // Get querystring variables from url
        $params = $request->getQueryParams();

        if (array_key_exists('sort', $params)) {
            $sort = preg_replace('/^\[|\]$|\s+/', '', $params['sort']);  // remove white spaces, [, and ]
            $sort_keys = explode(',', $sort); //get all the key:direction pairs
            foreach ($sort_keys as $sort_key) {
                $direction = 'asc';
                $column = $sort_key;
                if (strpos($sort_key, ':')) {
                    list($column, $direction) = explode(':', $sort_key);
                }
                $sort_key_array[$column] = $direction;
            }
        }

        return $sort_key_array;
    }

    //Search for breeds
    public static function searchBreeds($term) {
        if(is_numeric($term)) {
            $query = self::where('breedID', '=', $term)
                ->orWhere('sizeID', '=', $term)
                ->orWhere('temperamentID', '=', $term)
                ->orWhere('categoryID', '=', $term)
                ->orWhere('originID', '=', $term);
        } else {
            $query = self::where('name', 'like', "%$term%");
        }
        return $query->get();
    }

}
