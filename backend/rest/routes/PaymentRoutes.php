<?php

Flight::route('GET /payments', function() {
    $payments = Flight::payment_service()->get_all();
    Flight::json($payments);
});


Flight::route('GET /payments/@id', function($id) {
    $payment = Flight::payment_service()->get_by_id($id);

    if ($payment) {
        Flight::json($payment);
    } else {
        Flight::json(['error' => 'Payment not found'], 404);
    }
});


Flight::route('GET /payments/user/@user_id', function($user_id) {
    $payments = Flight::payment_service()->get_paid_bills_for_user($user_id);
    Flight::json($payments);
});

Flight::route('GET /payments/@year/@month/@user_id', function($year, $month, $user_id) {
    $payments = Flight::payment_service()->get_paid_bills_for_month_year($month, $year, $user_id);
    Flight::json($payments);
});


Flight::route('POST /payments', function() {
    $data = Flight::request()->data->getData();

    $result = Flight::payment_service()->add($data);
    Flight::json($result);
});

Flight::route('DELETE /payments/@id', function($id) {
    $result = Flight::payment_service()->delete($id);
    Flight::json(['success' => $result !== null]);
});
