<?php
require_once 'BaseDao.php';

class DepartmentDao extends BaseDao {
    public function __construct() {
        parent::__construct("Departments");
    }

    public function getByName($department_name) {
        $stmt = $this->connection->prepare("SELECT * FROM Departments WHERE department_name = :department_name");
        $stmt->bindParam(':department_name', $department_name);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
