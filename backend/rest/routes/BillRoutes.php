<?php

/**
 * @OA\Get(
 *      path="/bills",
 *      tags={"Bills"},
 *      summary="Get all bills",
 *      @OA\Response(
 *          response=200,
 *          description="List of all bills"
 *      )
 * )
 */

Flight::route('GET /bills', function() {
    $bills = Flight::bill_service()->get_all();
    Flight::json($bills);
});



/**
 * @OA\Get(
 *      path="/bills/{id}",
 *      tags={"Bills"},
 *      summary="Get a bill by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the bill",
 *          @OA\Schema(type="integer", example=3)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Bill details for the specified ID"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Bill not found"
 *      )
 * )
 */


Flight::route('GET /bills/@id', function($id) {
    $bill = Flight::bill_service()->get_by_id($id);

    if ($bill) {
        Flight::json($bill);
    } else {
        Flight::json(['error' => 'Bill not found'], 404);
    }
});



/**
 * @OA\Get(
 *      path="/bills/user/{user_id}",
 *      tags={"Bills"},
 *      summary="Get bills for a specific user",
 *      @OA\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          description="User ID",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Bills for the specified user"
 *      )
 * )
 */


Flight::route('GET /bills/user/@user_id', function($user_id) {
    $bills = Flight::bill_service()->get_bills_for_user($user_id);
    Flight::json($bills);
});


/**
 * @OA\Get(
 *      path="/bills/{year}/{month}/{user_id}",
 *      tags={"Bills"},
 *      summary="Get bills for a specific month, year, and user",
 *      @OA\Parameter(name="year", in="path", required=true, @OA\Schema(type="integer", example=2025)),
 *      @OA\Parameter(name="month", in="path", required=true, @OA\Schema(type="integer", example=11)),
 *      @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer", example=1)),
 *      @OA\Response(response=200, description="Bills for specified time period")
 * )
 */


Flight::route('GET /bills/@year/@month/@user_id', function($year, $month, $user_id) {
    $bills = Flight::bill_service()->get_bills_for_month_year($month, $year, $user_id);
    Flight::json($bills);
});



/**
 * @OA\Post(
 *      path="/bills",
 *      tags={"Bills"},
 *      summary="Add a new bill",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name","amount","due_date","user_id","category_id"},
 *              @OA\Property(property="name", type="string", example="Electricity Bill"),
 *              @OA\Property(property="amount", type="number", example=150),
 *              @OA\Property(property="due_date", type="string", format="date", example="2025-11-30"),
 *              @OA\Property(property="user_id", type="integer", example=1),
 *              @OA\Property(property="category_id", type="integer", example=2)
 *          )
 *      ),
 *      @OA\Response(response=200, description="Bill added successfully")
 * )
 */

Flight::route('POST /bills', function() {
    $data = Flight::request()->data->getData();

    $result = Flight::bill_service()->add($data);
    Flight::json($result);
});



/**
 * @OA\Put(
 *      path="/bills/{id}",
 *      tags={"Bills"},
 *      summary="Edit an existing bill",
 *      @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=3)),
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", example="Updated Electricity Bill"),
 *              @OA\Property(property="amount", type="number", example=175)
 *          )
 *      ),
 *      @OA\Response(response=200, description="Bill updated successfully")
 * )
 */

Flight::route('PUT /bills/@id', function($id) {
    $data = Flight::request()->data->getData();

    $result = Flight::bill_service()->edit($data, $id);

    if ($result !== null) {
        Flight::json(['success' => true]);
    } else {
        Flight::json(['error' => 'Bill not found or update failed'], 404);
    }
});


/**
 * @OA\Delete(
 *      path="/bills/{id}",
 *      tags={"Bills"},
 *      summary="Delete a bill by ID",
 *      @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=3)),
 *      @OA\Response(response=200, description="Success status of deletion")
 * )
 */

Flight::route('DELETE /bills/@id', function($id) {
    $result = Flight::bill_service()->delete($id);

    Flight::json(['success' => $result !== null]);
});


