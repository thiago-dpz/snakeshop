<?php

require_once("base.php");

class Users extends Base {

    public function login($data) {
        $query = $this->db->prepare("
            SELECT user_id, name, email, password
            FROM users
            WHERE email = ?
        ");
        
        $query->execute([$data["email"]]);
        $user = $query->fetch();
        
        if (empty($user) || !password_verify($data["password"], $user["password"])) {
            return null;  
        }

    }

    public function getAll() {
        $query = $this->db->prepare("
            SELECT user_id, name, email, state
            FROM users
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getDetail($id) {
        $query = $this->db->prepare("
            SELECT user_id, name, email, street_address, city, postal_code, state, phone
            FROM users
            WHERE user_id = ?
        ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function getByEmail($email) {
        $query = $this->db->prepare("
            SELECT user_id, password
            FROM users
            WHERE email = ?
        ");

        $query->execute([$email]);

        return $query->fetch();
    }

    public function create($data) {
        $api_key = bin2hex(random_bytes(16));

        $query = $this->db->prepare("
            INSERT INTO users
            (name, email, password, street_address, city, postal_code, state, phone, api_key)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $query->execute([
            $data["name"],
            $data["email"],
            password_hash($data["password"], PASSWORD_DEFAULT),
            $data["street_address"],
            $data["city"],
            $data["postal_code"],
            $data["state"],
            $data["phone"],
            $api_key
        ]);

        $data['user_id'] = $this->db->lastInsertId();
        $data["api_key"] = $api_key;

        return $data;
    }

    public function delete($id) {
        $query = $this->db->prepare("
            DELETE FROM users
            WHERE user_id = ?
        ");

        return $query->execute([$id]);
    }
}