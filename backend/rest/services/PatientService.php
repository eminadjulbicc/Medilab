<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/PatientDao.php";

class PatientService extends BaseService {

    public function __construct() {
        $dao = new PatientDao();
        parent::__construct($dao);
    }

    public function getByEmail($email) {
        return $this->dao->getByEmail($email);
    }

    public function getByPhone($phone) {
        return $this->dao->getByPhone($phone);
    }

    public function createPatient($data) {
        if (empty($data['email']) || empty($data['phone'])) {
            throw new Exception("Patient must have an email and phone number.");
        }

        return $this->create($data);
    }
}
?>
