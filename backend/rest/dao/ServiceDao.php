<?php
require_once 'BaseDao.php';

class ServiceDao extends BaseDao {
    public function __construct() {
        parent::__construct("Services");
    }

    public function getByDepartment($department_id) {
        $stmt = $this->connection->prepare("SELECT * FROM Services WHERE department_id = :department_id");
        $stmt->bindParam(':department_id', $department_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByName($service_name) {
        $stmt = $this->connection->prepare("SELECT * FROM Services WHERE service_name = :service_name");
        $stmt->bindParam(':service_name', $service_name);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
