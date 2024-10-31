<?php

class Base
{
    public $db;

    public function __construct() {
        try {
            $this->db = new PDO(
                "mysql:host=" .ENV["DB_HOST"]. ";dbname=" .ENV["DB_NAME"]. ";charset=utf8mb4", 
                ENV["DB_USER"],
                ENV["DB_PASSWORD"],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_STRINGIFY_FETCHES => false
                ]
            );

        } catch (PDOException $e) {
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function isValidKey($api_key){
        $query = $this->db->prepare("
            SELECT user_id
            FROM users
            WHERE api_key = ? 
        ");
        $query->execute([$api_key]);
        $user = $query->fetch();
        return !empty($user);
    }
}