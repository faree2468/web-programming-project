<?php
require 'vendor/autoload.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/BillService.php';
require_once __DIR__ . '/services/CategoryService.php';
require_once __DIR__ . '/services/PaymentService.php';
require_once __DIR__ . '/services/PaymentMethodService.php';


Flight::register('user_service', 'UserService');
Flight::register('bill_service', 'BillService');
Flight::register('category_service', 'CategoryService');
Flight::register('payment_service', 'PaymentService');
Flight::register('payment_method_service', 'PaymentMethodService');


require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/BillRoutes.php';
require_once __DIR__ . '/routes/CategoryRoutes.php';
require_once __DIR__ . '/routes/PaymentRoutes.php';
require_once __DIR__ . '/routes/PaymentMethodRoutes.php';


Flight::route('GET /', function() {
    echo "Hello FlightPHP";
});

Flight::start();