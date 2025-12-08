<?php


/**
 * @OA\Get(
 *      path="/categories",
 *      tags={"Categories"},
 *      summary="Get all categories",
 *      @OA\Response(response=200, description="List of all categories")
 * )
 */

Flight::route('GET /categories', function() {
    $categories = Flight::category_service()->get_all();
    Flight::json($categories);
});


/**
 * @OA\Get(
 *      path="/categories/{id}",
 *      tags={"Categories"},
 *      summary="Get a category by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the category",
 *          @OA\Schema(type="integer", example=2)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Category details for the specified ID"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Category not found"
 *      )
 * )
 */

Flight::route('GET /categories/@id', function($id) {
    $category = Flight::category_service()->get_by_id($id);

    if ($category) {
        Flight::json($category);
    } else {
        Flight::json(['error' => 'Category not found'], 404);
    }
});


/**
 * @OA\Get(
 *      path="/categories/name/{name}",
 *      tags={"Categories"},
 *      summary="Get category by name",
 *      @OA\Parameter(name="name", in="path", required=true, @OA\Schema(type="string", example="Utilities")),
 *      @OA\Response(response=200, description="Category details")
 * )
 */

Flight::route('GET /categories/name/@name', function($name) {
    $category = Flight::category_service()->get_ctg_by_name($name);

    if ($category) {
        Flight::json($category);
    } else {
        Flight::json(['error' => 'Category not found'], 404);
    }
});



/**
 * @OA\Get(
 *      path="/get_paid_bills_by_category",
 *      tags={"Categories"},
 *      summary="Get total paid bills grouped by category",
 *      @OA\Response(response=200, description="Sum of paid bills by category")
 * )
 */

Flight::route('GET /get_paid_bills_by_category/@user_id', function($user_id) {
    Flight::auth_middleware()->allowAdminOrSelf($user_id);
    $data = Flight::category_service()->get_paid_bills_by_ctg($user_id);
    Flight::json($data);
});



/**
 * @OA\Post(
 *      path="/categories",
 *      tags={"Categories"},
 *      summary="Add a new category",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"name"},
 *              @OA\Property(property="name", type="string", example="Groceries")
 *          )
 *      ),
 *      @OA\Response(response=200, description="Category added successfully")
 * )
 */

Flight::route('POST /categories', function() {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();

    $result = Flight::category_service()->add($data);
    Flight::json($result);
});


/**
 * @OA\Put(
 *      path="/categories/{id}",
 *      tags={"Categories"},
 *      summary="Update a category by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the category to update",
 *          @OA\Schema(type="integer", example=2)
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              @OA\Property(property="name", type="string", example="Updated Category Name")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Category updated successfully"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Category not found or update failed"
 *      )
 * )
 */

Flight::route('PUT /categories/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();

    $result = Flight::category_service()->update($data, $id);

    if ($result !== null) {
        Flight::json(['success' => true]);
    } else {
        Flight::json(['error' => 'Category not found or update failed'], 404);
    }
});



/**
 * @OA\Delete(
 *      path="/categories/{id}",
 *      tags={"Categories"},
 *      summary="Delete category by ID",
 *      @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=2)),
 *      @OA\Response(response=200, description="Success status of deletion")
 * )
 */

Flight::route('DELETE /categories/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $result = Flight::category_service()->delete($id);
    Flight::json(['success' => $result !== null]);
});
