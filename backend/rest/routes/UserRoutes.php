<?php
/**
 * @OA\Get(
 *      path="/users",
 *      tags={"Users"},
 *      summary="Get all users",
 *      @OA\Response(
 *          response=200,
 *          description="List of all users"
 *      )
 * )
 */

Flight::route("GET /users", function() {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::user_service()->get_all_users());
});


/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Get user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user to fetch",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User retrieved successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('GET /users/@id', function($id) {
    Flight::auth_middleware()->allowAdminOrSelf($id);

    $user = Flight::user_service()->get_by_id($id);

    if ($user) {
        Flight::json($user);
    } else {
        Flight::json(['error' => 'User not found'], 404);
    }
});


/**
 * @OA\Post(
 *      path="/users",
 *      tags={"Users"},
 *      summary="Add a new user",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"email","name"},
 *              @OA\Property(property="email", type="string", example="user@example.com"),
 *              @OA\Property(property="name", type="string", example="John Doe")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="User created successfully"
 *      )
 * )
 */

Flight::route("POST /users", function() {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_service()->add($data));
});


/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Update an existing user",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="User updated successfully"),
 *     @OA\Response(response=404, description="User not found")
 * )
 */

Flight::route('PUT /users/@id', function($id) {

    Flight::auth_middleware()->allowAdminOrSelf($id);

    $data = Flight::request()->data->getData();

    $result = Flight::user_service()->update($data, $id);

    if ($result !== null) {
        Flight::json(['success' => true]);
    } else {
        Flight::json(['error' => 'User not found or update failed'], 404);
    }
});


/**
 * @OA\Delete(
 *      path="/users/{id}",
 *      tags={"Users"},
 *      summary="Delete user by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="User ID",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success status of deletion"
 *      )
 * )
 */

Flight::route("DELETE /users/@id", function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $result = Flight::user_service()->delete($id);
    Flight::json(['success' => $result !== null]);
});
