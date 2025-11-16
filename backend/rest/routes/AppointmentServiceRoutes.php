<?php

/**
 * @OA\Get(
 *     path="/appointment-services",
 *     tags={"appointment_services"},
 *     summary="Get all appointment-service records",
 *     @OA\Response(
 *         response=200,
 *         description="Returns all appointment services"
 *     )
 * )
 */
Flight::route('GET /appointment-services', function() {
    Flight::json(Flight::appointmentServiceService()->get_all());
});

/**
 * @OA\Get(
 *     path="/appointment-services/{id}",
 *     tags={"appointment_services"},
 *     summary="Get an appointment-service record by ID",
 *     @OA\Parameter(
 *         name="id", in="path", required=true,
 *         description="Appointment-service ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment-service record"
 *     )
 * )
 */
Flight::route('GET /appointment-services/@id', function($id) {
    Flight::json(Flight::appointmentServiceService()->get_by_id((int)$id));
});

/**
 * @OA\Get(
 *     path="/appointment-services/appointment/{appointment_id}",
 *     tags={"appointment_services"},
 *     summary="Get all services linked to an appointment",
 *     @OA\Parameter(
 *         name="appointment_id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of services for a given appointment"
 *     )
 * )
 */
Flight::route('GET /appointment-services/appointment/@appointment_id', function($appointment_id) {
    Flight::json(Flight::appointmentServiceService()->getServicesByAppointment((int)$appointment_id));
});

/**
 * @OA\Post(
 *     path="/appointment-services",
 *     tags={"appointment_services"},
 *     summary="Create a new appointment-service record",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"appointment_id","service_id"},
 *             @OA\Property(property="appointment_id", type="integer", example=4),
 *             @OA\Property(property="service_id", type="integer", example=12)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment-service record created"
 *     )
 * )
 */
Flight::route('POST /appointment-services', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentServiceService()->create($data));
});

/**
 * @OA\Put(
 *     path="/appointment-services/{id}",
 *     tags={"appointment_services"},
 *     summary="Update an appointment-service record",
 *     @OA\Parameter(
 *         name="id", in="path", required=true,
 *         description="Appointment-service ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="appointment_id", type="integer", example=4),
 *             @OA\Property(property="service_id", type="integer", example=10)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment-service record updated"
 *     )
 * )
 */
Flight::route('PUT /appointment-services/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentServiceService()->update((int)$id, $data));
});

/**
 * @OA\Delete(
 *     path="/appointment-services/{id}",
 *     tags={"appointment_services"},
 *     summary="Delete an appointment-service record",
 *     @OA\Parameter(
 *         name="id", in="path", required=true,
 *         description="Appointment-service ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment-service record deleted"
 *     )
 * )
 */
Flight::route('DELETE /appointment-services/@id', function($id) {
    Flight::json(Flight::appointmentServiceService()->delete((int)$id));
});

?>
