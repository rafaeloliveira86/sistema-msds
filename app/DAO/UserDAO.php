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
    
    public function deleteData($param) {
        $sql = "DELETE FROM user WHERE id = :id";
        $this->pdo = $this->di->getDb();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $param, PDO::PARAM_INT);   
        $stmt->execute();
    }
}
?>