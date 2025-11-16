<?php
require_once '/../dao/BaseService.php';
require_once '/../dao/DepartmentDao.php';

class DepartmentService extends BaseService {

    public function __construct() {
        $dao = new DepartmentDao();
        parent::__construct($dao);
    }

    public function getByName($name) {
        return $this->dao->getByName($name);
    }

    
    public function createDepartment($data) {
        if (empty($data['department_name'])) {
            throw new Exception("Department name is required.");
        }

        return $this->create($data);
    }
}
?>
