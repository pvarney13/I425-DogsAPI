<?php
/**
 * Author: Lily Weber
 * Date: 5/29/2022
 * File: Validator.php
 * Description:
 */
namespace DogBreedsAPI\Validation;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;
class Validator {
    private static array $errors = [];
//Return the errors in an array
    public static function getErrors() : array {
        return self::$errors;
    }

    // A generic validation method. it returns true on success or false on failed validation.
    public static function validate($request, array $rules) : bool {
        foreach ($rules as $field => $rule) {
            //Retrieve parameters from URL or the request body
            $param = $request->getAttribute($field) ?? $request->getParsedBody()[$field];
            try{
                $rule->setName($field)->assert($param);
            } catch (NestedValidationException $ex) {
                self::$errors[$field] = $ex->getFullMessage();
            }
        }
        // Return true or false; "false" means a failed validation.
        return empty(self::$errors);
    }

    //Validate category data.
    public static function validateCategory($request) : bool {
        //Define all the validation rules
        $rules = [
            'categoryID' => v::notEmpty()->numericVal(),
            'categoryName' => v::alnum(' '),
            'categoryDesc' => v::alpha(' ')
        ];

        return self::validate($request, $rules);
    }

    //Validate color data.
    public static function validateColor($request) : bool {
        //Define all the validation rules
        $rules = [
            'colorID' => v::notEmpty()->numericVal(),
            'colorName' => v::alpha(' ')
        ];

        return self::validate($request, $rules);
    }
}
