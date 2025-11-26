<?php
require '../vendor/autoload.php';
require_once '../rest/services/UserService.php';
require_once '../rest/services/BillService.php';
require_once '../rest/services/CategoryService.php';
require_once '../rest/services/PaymentService.php';
require_once '../rest/services/PaymentMethodService.php';
require_once '../rest/services/AuthService.php';
require_once '../middleware/AuthMiddleware.php';

Flight::register('user_service', 'UserService');
Flight::register('bill_service', 'BillService');
Flight::register('category_service', 'CategoryService');
Flight::register('payment_service', 'PaymentService');
Flight::register('payment_method_service', 'PaymentMethodService');
Flight::register('auth_service', 'AuthService');
Flight::register('auth_middleware', 'AuthMiddleware');


Flight::before('start', function(&$params, &$output){

    $url = Flight::request()->url;


    if (str_starts_with($url, '/auth')) {
        return;
    }

    $authHeader = Flight::request()->getHeader("Authorization");

    if (!$authHeader) {
        Flight::halt(401, "Missing Authorization header");
    }

    $token = str_replace("Bearer ", "", $authHeader);

    try {
        Flight::auth_middleware()->verifyToken($token);
    } catch (Exception $e) {
        Flight::halt(401, "Unauthorized: " . $e->getMessage());
    }
});

require_once '../rest/routes/AuthRoutes.php';
require_once '../rest/routes/UserRoutes.php';
require_once '../rest/routes/BillRoutes.php';
require_once '../rest/routes/CategoryRoutes.php';
require_once '../rest/routes/PaymentRoutes.php';
require_once '../rest/routes/PaymentMethodRoutes.php';


Flight::start();
