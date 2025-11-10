<?php
require 'vendor/autoload.php';
require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/BillService.php';
require_once __DIR__ . '/rest/services/CategoryService.php';
require_once __DIR__ . '/rest/services/PaymentService.php';
require_once __DIR__ . '/rest/services/PaymentMethodService.php';


Flight::register('user_service', 'UserService');
Flight::register('bill_service', 'BillService');
Flight::register('category_service', 'CategoryService');
Flight::register('payment_service', 'PaymentService');
Flight::register('payment_method_service', 'PaymentMethodService');


require_once __DIR__ . '/rest/routes/UserRoutes.php';
require_once __DIR__ . '/rest/routes/BillRoutes.php';
require_once __DIR__ . '/rest/routes/CategoryRoutes.php';
require_once __DIR__ . '/rest/routes/PaymentRoutes.php';
require_once __DIR__ . '/rest/routes/PaymentMethodRoutes.php';


Flight::route('GET /', function() {
    echo "Hello FlightPHP";
});

Flight::start();