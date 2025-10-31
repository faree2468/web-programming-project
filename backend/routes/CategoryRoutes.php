<?php

Flight::route('GET /categories', function() {
    $categories = Flight::category_service()->get_all();
    Flight::json($categories);
});


Flight::route('GET /categories/@id', function($id) {
    $category = Flight::category_service()->get_by_id($id);

    if ($category) {
        Flight::json($category);
    } else {
        Flight::json(['error' => 'Category not found'], 404);
    }
});


Flight::route('GET /categories/name/@name', function($name) {
    $category = Flight::category_service()->get_ctg_by_name($name);

    if ($category) {
        Flight::json($category);
    } else {
        Flight::json(['error' => 'Category not found'], 404);
    }
});


Flight::route('GET /get_paid_bills_by_category', function() {
    $data = Flight::category_service()->get_paid_bills_by_ctg();
    Flight::json($data);
});


Flight::route('POST /categories', function() {
    $data = Flight::request()->data->getData();

    $result = Flight::category_service()->add($data);
    Flight::json($result);
});


Flight::route('PUT /categories/@id', function($id) {
    $data = Flight::request()->data->getData();

    $result = Flight::category_service()->update($data, $id);

    if ($result !== null) {
        Flight::json(['success' => true]);
    } else {
        Flight::json(['error' => 'Category not found or update failed'], 404);
    }
});


Flight::route('DELETE /categories/@id', function($id) {
    $result = Flight::category_service()->delete($id);
    Flight::json(['success' => $result !== null]);
});
