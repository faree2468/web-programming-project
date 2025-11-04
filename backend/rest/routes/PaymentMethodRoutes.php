<?php

Flight::route('GET /payment_methods', function() {
    $methods = Flight::payment_method_service()->get_all();
    Flight::json($methods);
});

Flight::route('GET /payment_methods/@id', function($id) {
    $method = Flight::payment_method_service()->get_by_id($id);

    if ($method) {
        Flight::json($method);
    } else {
        Flight::json(['error' => 'Payment method not found'], 404);
    }
});

Flight::route('GET /payment_methods/name/@name', function($name) {
    $method = Flight::payment_method_service()->get_payment_method_by_name($name);

    if ($method) {
        Flight::json($method);
    } else {
        Flight::json(['error' => 'Payment method not found'], 404);
    }
});

Flight::route('POST /payment_methods', function() {
    $data = Flight::request()->data->getData();

    $result = Flight::payment_method_service()->add($data);
    Flight::json($result);
});

Flight::route('PUT /payment_methods/@id', function($id) {
    $data = Flight::request()->data->getData();

    if (empty($data)) {
        $data = Flight::request()->query->getData();
    }

    $result = Flight::payment_method_service()->update($data, $id);

    if ($result !== null) {
        Flight::json(['success' => true]);
    } else {
        Flight::json(['error' => 'Payment method not found or update failed'], 404);
    }
});

Flight::route('DELETE /payment_methods/@id', function($id) {
    $result = Flight::payment_method_service()->delete($id);
    Flight::json(['success' => $result !== null]);
});
