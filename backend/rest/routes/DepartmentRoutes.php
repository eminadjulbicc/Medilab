<?php

/**
 * @OA\Get(
 *     path="/departments",
 *     tags={"departments"},
 *     summary="Get all departments",
 *     @OA\Response(
 *         response=200,
 *         description="Returns list of all departments"
 *     )
 * )
 */
Flight::route('GET /departments', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::departmentService()->get_all());
});

/**
 * @OA\Get(
 *     path="/departments/{id}",
 *     tags={"departments"},
 *     summary="Get a department by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Department ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns department with given ID"
 *     )
 * )
 */
Flight::route('GET /departments/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::departmentService()->get_by_id((int)$id));
});

/**
 * @OA\Post(
 *     path="/departments",
 *     tags={"departments"},
 *     summary="Create a new department",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"department_name"},
 *             @OA\Property(
 *                 property="department_name",
 *                 type="string",
 *                 example="Cardiology",
 *                 description="Name of the new department"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Department created"
 *     )
 * )
 */
Flight::route('POST /departments', function() {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::departmentService()->create($data));
});

/**
 * @OA\Put(
 *     path="/departments/{id}",
 *     tags={"departments"},
 *     summary="Update a department",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Department ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="department_name",
 *                 type="string",
 *                 example="Updated Department Name",
 *                 description="New name of the department"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Department updated"
 *     )
 * )
 */
Flight::route('PUT /departments/@id', function($id) {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::departmentService()->update((int)$id, $data));
});

/**
 * @OA\Delete(
 *     path="/departments/{id}",
 *     tags={"departments"},
 *     summary="Delete a department",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Department ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Department deleted"
 *     )
 * )
 */
Flight::route('DELETE /departments/@id', function($id) {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::departmentService()->delete((int)$id));
});

?>
