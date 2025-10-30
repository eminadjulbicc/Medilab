<?php
require_once 'BaseDao.php';

class AppointmentServiceDao extends BaseDao {
    public function __construct() {
        parent::__construct("Appointment_Services");
    }

    public function getServicesByAppointment($appointment_id) {
        $stmt = $this->connection->prepare("
            SELECT s.* FROM Services s
            INNER JOIN Appointment_Services a ON s.id = a.service_id
            WHERE a.appointment_id = :appointment_id
        ");
        $stmt->bindParam(':appointment_id', $appointment_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
