<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/AppointmentDao.php";


class AppointmentService extends BaseService {

    public function __construct() {
        $dao = new AppointmentDao();
        parent::__construct($dao);
    }

    /**
     * Validate appointment form fields
     */
    public function validateAppointmentForm($data) {

        $errors = [];

        // Name
        if (empty($data['name']) || strlen(trim($data['name'])) < 2) {
            $errors[] = "Name is required and must be at least 2 characters.";
        }

        // Email
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "A valid email address is required.";
        }

        // Phone
        if (empty($data['phone']) || !preg_match('/^[0-9\-\+\s\(\)]+$/', $data['phone'])) {
            $errors[] = "A valid phone number is required.";
        }

        // Appointment Date
        if (empty($data['date'])) {
            $errors[] = "Appointment date is required.";
        } else {
            $timestamp = strtotime($data['date']);
            if (!$timestamp) {
                $errors[] = "Invalid appointment date format.";
            } elseif ($timestamp < time()) {
                $errors[] = "Appointment date cannot be in the past.";
            }
        }

        // Department
        if (empty($data['department'])) {
            $errors[] = "Department is required.";
        }

        // Doctor
        if (empty($data['doctor'])) {
            $errors[] = "Doctor is required.";
        }

        // Message 
        if (!empty($data['message']) && strlen($data['message']) < 5) {
            $errors[] = "Message must be at least 5 characters if provided.";
        }

        // Return any errors
        return $errors;
    }

   
    public function createAppointment($data) {

        // Validate form data
        $errors = $this->validateAppointmentForm($data);

        if (!empty($errors)) {
            throw new Exception(implode("\n", $errors));
        }

        // Convert form fields to DB fields
        $dbData = [
            "patient_name"   => $data['name'],
            "email"          => $data['email'],
            "phone"          => $data['phone'],
            "appointment_date" => $data['date'],
            "department_id"  => $data['department'],
            "doctor_id"      => $data['doctor'],
            "message"        => $data['message'] ?? null
        ];

        return $this->create($dbData);
    }


    public function getByPatientId($patient_id) {
        return $this->dao->getByPatientId($patient_id);
    }

    public function getByDoctorId($doctor_id) {
        return $this->dao->getByDoctorId($doctor_id);
    }

    public function getUpcomingAppointments($date) {
        return $this->dao->getUpcomingAppointments($date);
    }

    public function updatePartial($id, $data) {
        return $this->dao->partial_update($id, $data);
    }

    public function deleteAppointment($id) {
        return $this->dao->deleteAppointment($id);
    }
}
?>

