<?php
Flight::route('GET /bills', function() {
    $bills = Flight::bill_service()->get_all();
    Flight::json($bills);
});


Flight::route('GET /bills/@id', function($id) {
    $bill = Flight::bill_service()->get_by_id($id);

    if ($bill) {
        Flight::json($bill);
    } else {
        Flight::json(['error' => 'Bill not found'], 404);
    }
});


Flight::route('GET /bills/user/@user_id', function($user_id) {
    $bills = Flight::bill_service()->get_bills_for_user($user_id);
    Flight::json($bills);
});


Flight::route('GET /bills/@year/@month/@user_id', function($year, $month, $user_id) {
    $bills = Flight::bill_service()->get_bills_for_month_year($month, $year, $user_id);
    Flight::json($bills);
});


Flight::route('POST /bills', function() {
    $data = Flight::request()->data->getData();

    $result = Flight::bill_service()->add($data);
    Flight::json($result);
});


Flight::route('PUT /bills/@id', function($id) {
    $data = Flight::request()->data->getData();

    $result = Flight::bill_service()->edit($data, $id);

    if ($result !== null) {
        Flight::json(['success' => true]);
    } else {
        Flight::json(['error' => 'Bill not found or update failed'], 404);
    }
});

Flight::route('DELETE /bills/@id', function($id) {
    $result = Flight::bill_service()->delete($id);

    Flight::json(['success' => $result !== null]);
});


