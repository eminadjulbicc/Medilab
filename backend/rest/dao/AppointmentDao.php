<?php
require_once 'BaseDao.php';

class AppointmentDao extends BaseDao {
    public function __construct() {
        parent::__construct("Appointments");
    }

    public function getByPatientId($patient_id) {
        $stmt = $this->connection->prepare("SELECT * FROM Appointments WHERE patient_id = :patient_id");
        $stmt->bindParam(':patient_id', $patient_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByDoctorId($doctor_id) {
        $stmt = $this->connection->prepare("SELECT * FROM Appointments WHERE doctor_id = :doctor_id");
        $stmt->bindParam(':doctor_id', $doctor_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUpcomingAppointments($date) {
        $stmt = $this->connection->prepare("SELECT * FROM Appointments WHERE appointment_date >= :date ORDER BY appointment_date ASC");
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        return $stmt->fetchAll();

    }
    public function partial_update($id, $data){
        return $this->update($id, $data);
    }

    public function addAppointment($data){
         $this->insert($data);
        return $datat;
    }

    public function deleteAppointment($id){
        return $this->delete($id);
    }
}
?>
