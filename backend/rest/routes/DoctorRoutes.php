<?php
/**
 * @OA\Get(
 *     path="/doctors",
 *     tags={"doctors"},
 *     summary="Get all doctors"
 * )
 */
Flight::route('GET /doctors', function() {
    Flight::json(Flight::doctorService()->get_all());
});

/**
 * @OA\Get(
 *     path="/doctors/{id}",
 *     tags={"doctors"},
 *     summary="Get doctor by ID"
 * )
 */
Flight::route('GET /doctors/@id', function($id) {
    Flight::json(Flight::doctorService()->get_by_id((int)$id));
});

/**
 * @OA\Get(
 *     path="/doctors/email/{email}",
 *     tags={"doctors"},
 *     summary="Get doctor by email"
 * )
 */
Flight::route('GET /doctors/email/@email', function($email) {
    Flight::json(Flight::doctorService()->getByEmail($email));
});

/**
 * @OA\Get(
 *     path="/doctors/department/{department_id}",
 *     tags={"doctors"},
 *     summary="Get doctors by department"
 * )
 */
Flight::route('GET /doctors/department/@department_id', function($department_id) {
    Flight::json(Flight::doctorService()->getByDepartment((int)$department_id));
});

/**
 * @OA\Post(
 *     path="/doctors",
 *     tags={"doctors"},
 *     summary="Create doctor"
 * )
 */
Flight::route('POST /doctors', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::doctorService()->createDoctor($data));
});

/**
 * @OA\Put(
 *     path="/doctors/{id}",
 *     tags={"doctors"},
 *     summary="Update doctor"
 * )
 */
Flight::route('PUT /doctors/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::doctorService()->update((int)$id, $data));
});

/**
 * @OA\Delete(
 *     path="/doctors/{id}",
 *     tags={"doctors"},
 *     summary="Delete doctor"
 * )
 */
Flight::route('DELETE /doctors/@id', function($id) {
    Flight::json(Flight::doctorService()->deleteDoctor((int)$id));
});

?>
