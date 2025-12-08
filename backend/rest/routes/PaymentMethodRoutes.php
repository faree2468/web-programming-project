<?php


/**
 * @OA\Get(
 *      path="/payment_methods",
 *      tags={"Payment Methods"},
 *      summary="Get all payment methods",
 *      @OA\Response(response=200, description="List of all payment methods")
 * )
 */


Flight::route('GET /payment_methods', function() {
    $methods = Flight::payment_method_service()->get_all();
    Flight::json($methods);
});


/**
 * @OA\Get(
 *      path="/payment_methods/{id}",
 *      tags={"Payment Methods"},
 *      summary="Get a payment method by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the payment method",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Payment method details"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Payment method not found"
 *      )
 * )
 */

Flight::route('GET /payment_methods/@id', function($id) {
    $method = Flight::payment_method_service()->get_by_id($id);

    if ($method) {
        Flight::json($method);
    } else {
        Flight::json(['error' => 'Payment method not found'], 404);
    }
});


/**
 * @OA\Get(
 *      path="/payment_methods/name/{name}",
 *      tags={"Payment Methods"},
 *      summary="Get a payment method by name",
 *      @OA\Parameter(name="name", in="path", required=true, @OA\Schema(type="string", example="Credit Card")),
 *      @OA\Response(response=200, description="Payment method details")
 * )
 */

Flight::route('GET /payment_methods/name/@name', function($name) {
    $method = Flight::payment_method_service()->get_payment_method_by_name($name);

    if ($method) {
        Flight::json($method);
    } else {
        Flight::json(['error' => 'Payment method not found'], 404);
    }
});


/**
 * @OA\Post(
 *      path="/payment_methods",
 *      tags={"Payment Methods"},
 *      summary="Add a new payment method",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name"},
 *              @OA\Property(property="name", type="string", example="Cash")
 *          )
 *      ),
 *      @OA\Response(response=200, description="Payment method added successfully")
 * )
 */

Flight::route('POST /payment_methods', function() {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();

    $result = Flight::payment_method_service()->add($data);
    Flight::json($result);
});


/**
 * @OA\Put(
 *      path="/payment_methods/{id}",
 *      tags={"Payment Methods"},
 *      summary="Update a payment method by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the payment method to update",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", example="Updated Method Name")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Payment method updated successfully"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Payment method not found or update failed"
 *      )
 * )
 */

Flight::route('PUT /payment_methods/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
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


/**
 * @OA\Delete(
 *      path="/payment_methods/{id}",
 *      tags={"Payment Methods"},
 *      summary="Delete a payment method by ID",
 *      @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=2)),
 *      @OA\Response(response=200, description="Success status of deletion")
 * )
 */

Flight::route('DELETE /payment_methods/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $result = Flight::payment_method_service()->delete($id);
    Flight::json(['success' => $result !== null]);
});
