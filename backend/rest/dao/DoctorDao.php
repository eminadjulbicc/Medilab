<?php
require_once 'BaseDao.php';

class DoctorDao extends BaseDao {
    public function __construct() {
        parent::__construct("Doctors");
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM Doctors WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getByDepartment($department_id) {
        $stmt = $this->connection->prepare("SELECT * FROM Doctors WHERE department_id = :department_id");
        $stmt->bindParam(':department_id', $department_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function partial_update($id, $data){
        return $this->update($id, $data);
    }

    public function addDoctor($data){
         $this->insert($data);
        return $datat;
    }

    public function deleteDoctor($id){
        return $this->delete($id);
    }
}
?>

