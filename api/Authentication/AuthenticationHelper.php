<?php
/**
 * Author: Piper Varney
 * Date: 6/5/22
 * File: AuthenticationHelper.php
 * Description: A helper class that sends a JSON data to the client
 */
namespace DogBreedsAPI\Authentication;

use Slim\Psr7\Response;

class AuthenticationHelper {
    public static function withJson($data, int $code) : Response {
        $response = new Response();
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}