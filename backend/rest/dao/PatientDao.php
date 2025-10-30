<?php
require_once 'BaseDao.php';

class PatientDao extends BaseDao {
    public function __construct() {
        parent::__construct("Patients");
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM Patients WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getByPhone($phone) {
        $stmt = $this->connection->prepare("SELECT * FROM Patients WHERE phone = :phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
