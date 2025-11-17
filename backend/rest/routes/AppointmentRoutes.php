<?php

/**
 * @OA\Get(
 *     path="/appointments",
 *     tags={"appointments"},
 *     summary="Get all appointments",
 *     @OA\Response(
 *         response=200,
 *         description="Returns list of all appointments"
 *     )
 * )
 */
Flight::route('GET /appointments', function() {
    Flight::json(Flight::appointmentService()->get_all());
});

/**
 * @OA\Get(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Get an appointment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns appointment with given ID"
 *     )
 * )
 */
Flight::route('GET /appointments/@id', function($id) {
    Flight::json(Flight::appointmentService()->get_by_id((int)$id));
});

/**
 * @OA\Get(
 *     path="/appointments/doctor/{doctor_id}",
 *     tags={"appointments"},
 *     summary="Get appointments for a doctor",
 *     @OA\Parameter(
 *         name="doctor_id",
 *         in="path",
 *         required=true,
 *         description="Doctor ID",
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of appointments for the doctor"
 *     )
 * )
 */
Flight::route('GET /appointments/doctor/@doctor_id', function($doctor_id) {
    Flight::json(Flight::appointmentService()->getByDoctor((int)$doctor_id));
});

/**
 * @OA\Get(
 *     path="/appointments/patient/{patient_id}",
 *     tags={"appointments"},
 *     summary="Get appointments for a patient",
 *     @OA\Parameter(
 *         name="patient_id",
 *         in="path",
 *         required=true,
 *         description="Patient ID",
 *         @OA\Schema(type="integer", example=10)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of appointments for the patient"
 *     )
 * )
 */
Flight::route('GET /appointments/patient/@patient_id', function($patient_id) {
    Flight::json(Flight::appointmentService()->getByPatient((int)$patient_id));
});

/**
 * @OA\Post(
 *     path="/appointments",
 *     tags={"appointments"},
 *     summary="Create a new appointment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"doctor_id","patient_id","date","time"},
 *             @OA\Property(property="doctor_id", type="integer", example=3),
 *             @OA\Property(property="patient_id", type="integer", example=7),
 *             @OA\Property(property="date", type="string", example="2025-05-20"),
 *             @OA\Property(property="time", type="string", example="14:30")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment created"
 *     )
 * )
 */
Flight::route('POST /appointments', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentService()->create($data));
});

/**
 * @OA\Put(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Update an appointment",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="doctor_id", type="integer", example=3),
 *             @OA\Property(property="patient_id", type="integer", example=7),
 *             @OA\Property(property="date", type="string", example="2025-06-01"),
 *             @OA\Property(property="time", type="string", example="10:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment updated"
 *     )
 * )
 */
Flight::route('PUT /appointments/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentService()->update((int)$id, $data));
});

/**
 * @OA\Delete(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Delete an appointment",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment deleted"
 *     )
 * )
 */
Flight::route('DELETE /appointments/@id', function($id) {
    Flight::json(Flight::appointmentService()->delete((int)$id));
});

?>
