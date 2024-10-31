<?php

require_once("base.php");

class Products extends Base
{
    public function getAll()
    {
        $query = $this->db->prepare("
            SELECT p.*, c.name AS category_name 
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.category_id
            ORDER BY 
                FIELD(p.category_id, 1, 2, 3),  -- Ordena pela ordem desejada dos IDs
                p.product_id ASC  -- Depois ordena os produtos dentro da categoria
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public function getDetail($id)
    {
        $query = $this->db->prepare("SELECT * FROM products WHERE product_id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }

    public function create($data)
    {
        $query = $this->db->prepare("INSERT INTO products (name, category_id, price, description, gender, is_hatchling, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([
            $data["name"],
            $data["category_id"],
            $data["price"],
            $data["description"],     
            $data["gender"],
            $data["is_hatchling"],
            $data["stock"],
            $data["image"]
        ]);

        return true;
    }

    public function update($data, $id)
    {
        $query = $this->db->prepare("UPDATE products SET name = ?, category_id = ?, price = ?, description = ?, gender = ?, is_hatchling = ?, stock = ?, image = ? WHERE product_id = ?");
        $query->execute([
            $data["name"],
            $data["category_id"],
            $data["price"],
            $data["description"], 
            $data["gender"],
            $data["is_hatchling"],
            $data["stock"],
            $data["image"],
            $id
        ]);
    }

    public function delete($id)
    {
        $query = $this->db->prepare("DELETE FROM products WHERE product_id = ?");
        return $query->execute([$id]);
    }

    public function getByCategoryAndFilter($categoryId, $filter = '')
    {
        $query = "SELECT * FROM products WHERE category_id = :category_id";

        switch ($filter) {
            case 'male':
                $query .= " AND gender = 'male'";
                break;
            case 'female':
                $query .= " AND gender = 'female'";
                break;
            case 'hatchlings':
                $query .= " AND is_hatchling = '1'";
                break;
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStock($productId, $quantity)
    {
        $query = $this->db->prepare("UPDATE products SET stock = stock - ? WHERE product_id = ? AND stock >= ?");
        $query->execute([$quantity, $productId, $quantity]);

        return $query->rowCount() > 0;
    }
}