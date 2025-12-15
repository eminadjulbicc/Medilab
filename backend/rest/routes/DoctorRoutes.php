<?php
/**
 * @OA\Get(
 *     path="/doctors",
 *     tags={"doctors"},
 *     summary="Get all doctors",
 *     @OA\Response(
 *         response=200,
 *         description="Returns all doctors"
 *     )
 * )
 */
Flight::route('GET /doctors', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::doctorService()->get_all());
});


/**
 * @OA\Get(
 *     path="/doctors/{id}",
 *     tags={"doctors"},
 *     summary="Get doctor by ID",
 *     @OA\Response(
 *         response=200,
 *         description="Returns doctor doctor by id"
 *     )
 * )
 */
Flight::route('GET /doctors/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::doctorService()->get_by_id((int)$id));
});


/**
 * @OA\Get(
 *     path="/doctors/email{email}",
 *     tags={"doctors"},
 *     summary="Get doctor by email",
 *     @OA\Response(
 *         response=200,
 *         description="Returns doctor doctor by email"
 *     )
 * )
 */
Flight::route('GET /doctors/email/@email', function($email) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::doctorService()->getByEmail($email));
});

/**
 * @OA\Get(
 *     path="/doctors/department/{department_id}",
 *     tags={"doctors"},
 *     summary="Get doctor by department",
 *     @OA\Response(
 *         response=200,
 *         description="Returns doctor doctor by department"
 *     )
 * )
 */
Flight::route('GET /doctors/department/@department_id', function($department_id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::doctorService()->getByDepartment((int)$department_id));
});


/**
 * @OA\Post(
 *     path="/doctors",
 *     tags={"doctors"},
 *     summary="Create doctor",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"full_name"},
 *             @OA\Property(property="full_name", type="string", example="John Doe"),
 *             @OA\Property(property="specialization", type="string", example="Cardiologist"),
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="phone", type="string", example="+123456789"),
 *             @OA\Property(property="department_id", type="integer", example=1),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctor created"
 *     )
 * )
 */

Flight::route('POST /doctors', function() {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::doctorService()->createDoctor($data));
});

/**
 * @OA\Put(
 *     path="/doctors/{id}",
 *     tags={"doctors"},
 *     summary="Update doctor",
 *     @OA\Response(
 *         response=200,
 *         description="Doctor updated successfully"
 *     )
 * )
 */

Flight::route('PUT /doctors/@id', function($id) {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::doctorService()->update((int)$id, $data));
});


/**
 * @OA\Delete(
 *     path="/doctors/{id}",
 *     tags={"doctors"},
 *     summary="Delete doctor",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Doctor ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctor deleted"
 *     )
 * )
 */
Flight::route('DELETE /doctors/@id', function($id) {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::doctorService()->deleteDoctor((int)$id));
});

?>
