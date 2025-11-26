<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::group('/auth', function() {

    
    Flight::route("POST /register", function () {
        $data = Flight::request()->data->getData();

        $response = Flight::auth_service()->register($data);
    
        if ($response['success']) {
            Flight::json([
                'message' => 'User registered successfully',
                'data' => $response['data']
            ]);
        } else {
            Flight::halt(500, $response['error']);
        }
    });
    
    
    Flight::route('POST /login', function() {
        $data = Flight::request()->data->getData();

        $response = Flight::auth_service()->login($data);
    
        if ($response['success']) {
            Flight::json([
                'message' => 'User logged in successfully',
                'data' => $response['data']
            ]);
        } else {
            Flight::halt(500, $response['error']);
        }
    });
 
});


?>