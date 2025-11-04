<?php
Flight::route("GET /users", function() {
    Flight::json(Flight::user_service()->get_all_users());
});

Flight::route("POST /users", function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_service()->add($data));
});

Flight::route("DELETE /users/@id", function($id) {
    $result = Flight::user_service()->delete($id);
    Flight::json(['success' => $result !== null]);
});
