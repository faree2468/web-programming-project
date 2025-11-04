<?php

/**
 * @OA\Get(
 *      path="/payments",
 *      tags={"Payments"},
 *      summary="Get all payments",
 *      @OA\Response(response=200, description="List of all payments")
 * )
 */

Flight::route('GET /payments', function() {
    $payments = Flight::payment_service()->get_all();
    Flight::json($payments);
});


/**
 * @OA\Get(
 *      path="/payments/{id}",
 *      tags={"Payments"},
 *      summary="Get a payment by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the payment",
 *          @OA\Schema(type="integer", example=5)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Payment details for the specified ID"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Payment not found"
 *      )
 * )
 */


Flight::route('GET /payments/@id', function($id) {
    $payment = Flight::payment_service()->get_by_id($id);

    if ($payment) {
        Flight::json($payment);
    } else {
        Flight::json(['error' => 'Payment not found'], 404);
    }
});


/**
 * @OA\Get(
 *      path="/payments/user/{user_id}",
 *      tags={"Payments"},
 *      summary="Get all payments for a user",
 *      @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer", example=1)),
 *      @OA\Response(response=200, description="List of payments for user")
 * )
 */

Flight::route('GET /payments/user/@user_id', function($user_id) {
    $payments = Flight::payment_service()->get_paid_bills_for_user($user_id);
    Flight::json($payments);
});


/**
 * @OA\Get(
 *      path="/payments/{year}/{month}/{user_id}",
 *      tags={"Payments"},
 *      summary="Get all payments for a specific month, year, and user",
 *      @OA\Parameter(name="year", in="path", required=true, @OA\Schema(type="integer", example=2025)),
 *      @OA\Parameter(name="month", in="path", required=true, @OA\Schema(type="integer", example=11)),
 *      @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer", example=1)),
 *      @OA\Response(response=200, description="Payments for the specified month/year")
 * )
 */

Flight::route('GET /payments/@year/@month/@user_id', function($year, $month, $user_id) {
    $payments = Flight::payment_service()->get_paid_bills_for_month_year($month, $year, $user_id);
    Flight::json($payments);
});


/**
 * @OA\Post(
 *      path="/payments",
 *      tags={"Payments"},
 *      summary="Add a new payment",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"amount","bill_id","user_id","payment_date"},
 *              @OA\Property(property="amount", type="number", example=120.50),
 *              @OA\Property(property="bill_id", type="integer", example=2),
 *              @OA\Property(property="user_id", type="integer", example=1),
 *              @OA\Property(property="payment_date", type="string", format="date", example="2025-11-10")
 *          )
 *      ),
 *      @OA\Response(response=200, description="Payment created successfully")
 * )
 */


Flight::route('POST /payments', function() {
    $data = Flight::request()->data->getData();

    $result = Flight::payment_service()->add($data);
    Flight::json($result);
});


/**
 * @OA\Put(
 *     path="/payments/{id}",
 *     tags={"Payments"},
 *     summary="Update an existing payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the payment to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"amount", "bill_id"},
 *             @OA\Property(property="amount", type="number", format="float", example=99.99),
 *             @OA\Property(property="bill_id", type="integer", example=1),
 *             @OA\Property(property="payment_date", type="string", format="date", example="2025-02-10")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Payment not found"
 *     )
 * )
 */
Flight::route('PUT /payments/@id', function($id) {
    $data = Flight::request()->data->getData();
    
    $result = Flight::payment_service()->update($data, $id);

    if ($result !== null) {
        Flight::json(['success' => true]);
    } else {
        Flight::json(['error' => 'Payment not found or update failed'], 404);
    }
});


/**
 * @OA\Delete(
 *      path="/payments/{id}",
 *      tags={"Payments"},
 *      summary="Delete a payment by ID",
 *      @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
 *      @OA\Response(response=200, description="Success status of deletion")
 * )
 */

Flight::route('DELETE /payments/@id', function($id) {
    $result = Flight::payment_service()->delete($id);
    Flight::json(['success' => $result !== null]);
});
