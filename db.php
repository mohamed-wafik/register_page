<?php 
class DB {
    private $dsn = "mysql:host=localhost;dbname=iti_php_db";
    private $username = "root";  
    private $password = ""; 
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("database connection failed: " . $e->getMessage());
        }
    }
    public function selectAll($table) {
        $sql = $this->conn->prepare("SELECT * FROM {$table}");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function select($table,$condition) {
        $sql = $this->conn->prepare("SELECT * FROM {$table} WHERE {$condition}");
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);  
    }
    public function delete($table,$condition) {
        $sql = $this->conn->prepare("DELETE FROM {$table} WHERE {$condition}");
        $sql->execute();
        return $sql;  
    }
    public function update($table,$condition,$data = []) { 
        $set = implode("," , array_map(fn($key) => "$key = :$key" , array_keys($data)));
        $sql = $this->conn->prepare("UPDATE {$table} SET {$set} WHERE {$condition}");

        foreach($data as $key => $value) {
            $sql->bindValue(":$key",$value);
        }

        return $sql->execute();
    }
    public function create($table,$data = []) {
        $keys = implode("," , array_keys($data));
        $values = "'" . implode("','",array_values($data)) . "'";
        $sql = $this->conn->prepare("INSERT INTO {$table} ({$keys}) VALUES ({$values})");
        $sql->execute();
        return $sql;  
    }
}