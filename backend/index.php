<?php
require 'vendor/autoload.php'; //run autoloader



require_once __DIR__ . '/rest/services/ServiceService.php';
Flight::register('serviceService', 'ServiceService');

require_once __DIR__ . '/rest/services/PatientService.php';
Flight::register('patientService', 'PatientService');

require_once __DIR__ . '/rest/services/DoctorService.php';
Flight::register('doctorService', 'DoctorService');

require_once __DIR__ . '/rest/services/DepartmentService.php';
Flight::register('departmentService', 'DepartmentService');

require_once __DIR__ . '/rest/services/AppointmentService.php';
Flight::register('appointmentService', 'AppointmentService');

require_once __DIR__ . '/rest/services/AppointmentServiceService.php';
Flight::register('appointmentServiceService', 'AppointmentServiceService');


require_once __DIR__ . '/rest/routes/ServiceRoutes.php';
require_once __DIR__ . '/rest/routes/PatientRoutes.php';
require_once __DIR__ . '/rest/routes/DoctorRoutes.php';
require_once __DIR__ . '/rest/routes/DepartmentRoutes.php';
require_once __DIR__ . '/rest/routes/AppointmentRoutes.php';
require_once __DIR__ . '/rest/routes/AppointmentServiceRoutes.php';

Flight::start();  //start FlightPHP
?>
