<?php
require_once '/../dao/BaseService.php';
require_once '/../dao/DoctorDao.php';

class DoctorService extends BaseService {

    public function __construct() {
        $dao = new DoctorDao();
        parent::__construct($dao);
    }

    public function getByEmail($email) {
        return $this->dao->getByEmail($email);
    }

    public function getByDepartment($department_id) {
        return $this->dao->getByDepartment($department_id);
    }

    public function updatePartial($id, $data) {
        return $this->dao->partial_update($id, $data);
    }

    public function createDoctor($data) {
        if (empty($data['email'])) {
            throw new Exception("Doctor email is required.");
        }

        return $this->create($data);
    }

    public function deleteDoctor($id) {
        return $this->dao->deleteDoctor($id);
    }
}
?>
