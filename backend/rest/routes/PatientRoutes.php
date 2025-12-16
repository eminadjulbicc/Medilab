<?php
/**
 * @OA\Get(
 *     path="/patients",
 *     tags={"patients"},
 *     summary="Get all patients",
 *     @OA\Response(response=200, description="List of patients")
 * )
 */
Flight::route('GET /patients', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::patientService()->get_all());
});

/**
 * @OA\Get(
 *     path="/patients/{id}",
 *     tags={"patients"},
 *     summary="Get patient by ID",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\Response(response=200, description="Patient details")
 * )
 */
Flight::route('GET /patients/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::patientService()->get_by_id((int)$id));
});

/**
 * @OA\Get(
 *     path="/patients/email/{email}",
 *     tags={"patients"},
 *     summary="Get patient by email",
 *     @OA\Parameter(name="email", in="path", required=true),
 *     @OA\Response(response=200, description="Patient by email")
 * )
 */
Flight::route('GET /patients/email/@email', function($email) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::patientService()->getByEmail($email));
});

/**
 * @OA\Get(
 *     path="/patients/phone/{phone}",
 *     tags={"patients"},
 *     summary="Get patient by phone",
 *     @OA\Parameter(name="phone", in="path", required=true),
 *     @OA\Response(response=200, description="Patient by phone")
 * )
 */
Flight::route('GET /patients/phone/@phone', function($phone) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::patientService()->getByPhone($phone));
});

/**
 * @OA\Post(
 *     path="/patients",
 *     tags={"patients"},
 *     summary="Create new patient",
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             required={"email","phone"}
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Patient created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=123),
 *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
 *             @OA\Property(property="phone", type="string", example="+1234567890"),
 *             @OA\Property(property="created_at", type="string", example="2025-01-01 12:00:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request - validation failed",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Email is required")
 *         )
 *     )
 * )
 */

Flight::route('POST /patients', function() {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::patientService()->createPatient($data));
});

/**
 * @OA\Put(
 *     path="/patients/{id}",
 *     tags={"patients"},
 *     summary="Update patient",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\Response(
 *         response=200,
 *         description="Patient updated successfully"
 *     )
 * )
 */

Flight::route('PUT /patients/@id', function($id) {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::patientService()->update((int)$id, $data));
});


/**
 * @OA\Delete(
 *     path="/patients/{id}",
 *     tags={"patients"},
 *     summary="Delete patient",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Patient ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Patient deleted"
 *     )
 * )
 */
Flight::route('DELETE /patients/@id', function($id) {
     Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::patientService()->delete((int)$id));
});

?>