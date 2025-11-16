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
 *     )
 * )
 */
Flight::route('POST /patients', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::patientService()->createPatient($data));
});

/**
 * @OA\Put(
 *     path="/patients/{id}",
 *     tags={"patients"},
 *     summary="Update patient",
 *     @OA\Parameter(name="id", in="path", required=true)
 * )
 */
Flight::route('PUT /patients/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::patientService()->update((int)$id, $data));
});

/**
 * @OA\Delete(
 *     path="/patients/{id}",
 *     tags={"patients"},
 *     summary="Delete patient"
 * )
 */
Flight::route('DELETE /patients/@id', function($id) {
    Flight::json(Flight::patientService()->delete((int)$id));
});

