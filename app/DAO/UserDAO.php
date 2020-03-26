<?php
declare(strict_types = 1);

use Phalcon\Mvc\Controller;
use Phalcon\Db\Adapter\Pdo\Mysql;

class UserDAO extends Controller {
    private $pdo;
    
    public function getLastId() {
        $sql = "SELECT id FROM user ORDER BY id DESC LIMIT 1";
        $this->pdo = $this->di->getDb();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $lastId = $stmt->fetch(PDO::FETCH_ASSOC);
        return $lastId;
    }
    
    public function selectReg($param) {
        $sql = "SELECT * FROM user WHERE id = :id";
        $this->pdo = $this->di->getDb();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $param['id'], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function updateReg($param) {
        $sql = "
            UPDATE user SET 
            first_name = :first_name,
            last_name = :last_name,
            username = :username,
            email_address = :email_address,
            password = :password,
            status_id = :status_id, 
            update_by_user_id = :update_by_user_id, 
            updated_at = :updated_at
            WHERE 
            id = :id
        ";
        $this->pdo = $this->di->getDb();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $param['id'], PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $param['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $param['last_name'], PDO::PARAM_STR);
        $stmt->bindParam(':username', $param['username'], PDO::PARAM_STR);
        $stmt->bindParam(':email_address', $param['email_address'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $param['password'], PDO::PARAM_STR);
        $stmt->bindParam(':status_id', $param['status_id'], PDO::PARAM_INT);
        $stmt->bindParam(':update_by_user_id', $param['update_by_user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':updated_at', $param['updated_at'], PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteReg($param) {
        $sql = "
            UPDATE user SET 
            status_id = :status_id, update_by_user_id = :update_by_user_id, updated_at = :updated_at
            WHERE 
            id = :id
        ";
        $this->pdo = $this->di->getDb();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $param['id'], PDO::PARAM_INT);
        $stmt->bindParam(':status_id', $param['status_id'], PDO::PARAM_INT);
        $stmt->bindParam(':update_by_user_id', $param['update_by_user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':updated_at', $param['updated_at'], PDO::PARAM_STR);
        $stmt->execute();
    }
    
    public function deleteRegUser($param) {
        $sql = "DELETE FROM user WHERE id = :id";
        $this->pdo = $this->di->getDb();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $param['id'], PDO::PARAM_INT);   
        $stmt->execute();
    }
    
    public function deleteRegUserAccess($param) {
        $sql = "DELETE FROM user_access WHERE user_id = :id";
        $this->pdo = $this->di->getDb();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $param['id'], PDO::PARAM_INT);   
        $stmt->execute();
    }
}
?>