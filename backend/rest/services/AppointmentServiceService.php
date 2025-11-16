<?php
require_once '/../dao/BaseService.php';
require_once '/../dao/AppointmentServiceDao.php';

class AppointmentServiceService extends BaseService {

    public function __construct() {
        $dao = new AppointmentServiceDao();
        parent::__construct($dao);
    }

    public function getServicesByAppointment($appointment_id) {
        return $this->dao->getServicesByAppointment($appointment_id);
    }
}
?>
