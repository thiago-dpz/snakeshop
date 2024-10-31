<?php

require_once("base.php");

class Admins extends Base
{
    public function login($data) {
        
        $query = $this->db->prepare("
            SELECT admin_id, password
            FROM admins
            WHERE email = ?
        ");
        
        $query->execute([$data["email"]]);
        $admin = $query->fetch();

        if (empty($admin) || !password_verify($data["password"], $admin["password"])) {
            return null;
        }
        
        return $admin;
    }

    public function create($data) {
        $query = $this->db->prepare("
            INSERT INTO admins (name, email, password)
            VALUES (?, ?, ?)
        ");

        $query->execute([
            $data["name"],
            $data["email"],
            password_hash($data["password"], PASSWORD_DEFAULT)
        ]);

        $data['admin_id'] = $this->db->lastInsertId();

        return $data;
    }
}