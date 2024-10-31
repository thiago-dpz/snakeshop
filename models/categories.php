<?php

require_once("base.php");

class Categories extends Base
{

    public function get($id) {
        try {
            $query = $this->db->prepare("SELECT category_id, name FROM categories WHERE category_id = ?");
            $query->execute([$id]);
            return $query->fetch();
        } catch (PDOException $e) {
            die("Erro: " . $e->getMessage());
        }
    }
    public function getAll()
    {
        try {
            $query = $this->db->prepare("SELECT category_id, name FROM categories");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            die("Erro: " . $e->getMessage());
        }
    }

    public function getDetail($id)
    {
        $query = $this->db->prepare("SELECT category_id, name FROM categories WHERE category_id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }

    public function create($data)
    {
        $query = $this->db->prepare("INSERT INTO categories (name) VALUES (?)");
        $query->execute([$data["name"]]);
        $data["category_id"] = $this->db->lastInsertId();
        return $data;
    }

    public function update($data, $id)
    {
        $query = $this->db->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
        $query->execute([$data["name"], $id]);
        $data["category_id"] = $id;
        return $data;
    }

    public function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM categories WHERE category_id = ?");
        return $query->execute([$id]);
    }
}