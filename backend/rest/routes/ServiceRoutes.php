<?php

/**
 * @OA\Get(
 *     path="/services",
 *     tags={"services"},
 *     summary="Get all services",
 *     @OA\Response(response=200, description="List of all services")
 * )
 */
Flight::route('GET /services', function() {
    Flight::json(Flight::serviceService()->get_all());
});

/**
 * @OA\Get(
 *     path="/services/{id}",
 *     tags={"services"},
 *     summary="Get service by ID",
 *     @OA\Parameter(
 *         name="id", in="path", required=true, @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Service by ID")
 * )
 */
Flight::route('GET /services/@id', function($id) {
    Flight::json(Flight::serviceService()->get_by_id((int)$id));
});

/**
 * @OA\Get(
 *     path="/services/department/{department_id}",
 *     tags={"services"},
 *     summary="Get services by department",
 *     @OA\Parameter(
 *         name="department_id", in="path", required=true, @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Services for given department")
 * )
 */
Flight::route('GET /services/department/@department_id', function($department_id) {
    Flight::json(Flight::serviceService()->getByDepartment((int)$department_id));
});

/**
 * @OA\Get(
 *     path="/services/name/{service_name}",
 *     tags={"services"},
 *     summary="Get service by name",
 *     @OA\Parameter(
 *         name="service_name", in="path", required=true, @OA\Schema(type="string")
 *     ),
 *     @OA\Response(response=200, description="Service details")
 * )
 */
Flight::route('GET /services/name/@service_name', function($service_name) {
    Flight::json(Flight::serviceService()->getByName($service_name));
});

/**
 * @OA\Post(
 *     path="/services",
 *     tags={"services"},
 *     summary="Create a new service",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"service_name"},
 *             @OA\Property(property="service_name", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Service created")
 * )
 */
Flight::route('POST /services', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::serviceService()->createService($data));
});

/**
 * @OA\Put(
 *     path="/services/{id}",
 *     tags={"services"},
 *     summary="Update an existing service",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="service_name", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Service updated")
 * )
 */
Flight::route('PUT /services/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::serviceService()->update((int)$id, $data));
});

/**
 * @OA\Delete(
 *     path="/services/{id}",
 *     tags={"services"},
 *     summary="Delete a service",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Service deleted")
 * )
 */
Flight::route('DELETE /services/@id', function($id) {
    Flight::json(Flight::serviceService()->delete((int)$id));
});

