<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once './AppointmentDao.php';
require_once './AppointmentServiceDao.php';
require_once './DepartmentDao.php';
require_once './DoctorDao.php';
require_once './PatientDao.php';
require_once './ServiceDao.php';


$appointmentDao = new AppointmentDao();
$appointmentServiceDao = new AppointmentServiceDao();
$departmentDao = new DepartmentDao();
$doctorDao = new DoctorDao();
$patientDao = new PatientDao();
$serviceDao = new ServiceDao();

// Insert a department
$departmentDao->insert([
    'department_name' => 'Cardiology',
    'description' => 'Heart and blood vessel treatments.'
]);

// Insert a service linked to the department
$serviceDao->insert([
    'service_name' => 'ECG Test',
    'description' => 'Electrocardiogram test for heart rhythm.',
    'department_id' => 1
]);

// Insert a doctor
$doctorDao->insert([
    'full_name' => 'Dr. Alice Smith1',
    'specialization' => 'Cardiologist',
    'email' => 'alice1.smith1@medilab.com',
    'phone' => '123-456-78901',
    'department_id' => 1
]);

// Insert a patient
$patientDao->insert([
    'full_name' => 'John Doe',
    'date_of_birth' => '1985-06-15',
    'gender' => 'Male',
    'email' => 'john.doe@example.com',
    'phone' => '555-1234',
    'address' => '123 Main Street'
]);

// Insert an appointment
$appointmentDao->insert([
    'patient_id' => 1,
    'doctor_id' => 1,
    'appointment_date' => date('Y-m-d', strtotime('+1 day')),
    'appointment_time' => '10:00:00',
    'status' => 'Scheduled'
]);

// appointment to a service
$appointmentServiceDao->insert([
    'appointment_id' => 1,
    'service_id' => 1
]);


// delete doctor
$doctorDao->delete(3);






echo "\n---- Departments ----\n";
print_r($departmentDao->getAll());


echo "\n---- Doctors ----\n";
print_r($doctorDao->getAll());


echo "\n---- Patients ----\n";
print_r($patientDao->getAll());


echo "\n---- Services ----\n";
print_r($serviceDao->getAll());

echo "\n---- Appointments ----\n";
print_r($appointmentDao->getAll());

echo "\n---- Appointment 1 Services ----\n";
print_r($appointmentServiceDao->getServicesByAppointment(1));


echo "\n---- Doctor by Email ----\n";
print_r($doctorDao->getByEmail('alice.smith@medilab.com'));

echo "\n---- Patient by Email ----\n";
print_r($patientDao->getByEmail('john.doe@example.com'));

echo "\n---- Appointments for Doctor ID 1 ----\n";
print_r($appointmentDao->getByDoctorId(1));

?>
