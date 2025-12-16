<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/ServiceDao.php";


class ServiceService extends BaseService {

    public function __construct() {
        $dao = new ServiceDao();
        parent::__construct($dao);
    }

    public function getByDepartment($department_id) {
        return $this->dao->getByDepartment($department_id);
    }

    public function getByName($service_name) {
        return $this->dao->getByName($service_name);
    }

    // Example business logic
    public function createService($data) {
        if (empty($data['service_name'])) {
            throw new Exception("Service name is required.");
        }

        return $this->create($data);
    }
}
?>
