<?php

require("base.php");

class Orders extends Base {

    public function getALL() {
        $query = $this->db->prepare("
            SELECT
                orders.order_id, 
                orders.user_id, 
                users.name AS buyer_name, 
                orders.order_date
            FROM
                orders
            INNER JOIN 
                users USING(user_id)    
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getDetail($id) {
        $query = $this->db->prepare("
            SELECT
                o1.*,
                u1.name AS buyer_name,
                u1.street_address,
                u1.postal_code,
                u1.city,
                u1.country,
                u1.phone
            FROM
                orders AS o1
            INNER JOIN
                users AS u1 USING(user_id)
            WHERE
                o1.order_id = ?
        ");

        $query->execute([$id]);

        $order = $query->fetch();

        if (!empty($order)) {
            $query = $this->db->prepare("
                SELECT
                    od.product_id,
                    od.quantity,
                    od.price_each,
                    p.name AS product_name
                FROM
                    orderdetails AS od
                INNER JOIN
                    products AS p USING(product_id)
                WHERE
                    od.order_id = ?
            ");
            
            $query->execute([$order["order_id"]]);

            $order["products"] = $query->fetchAll();
        }
        return $order;
    }

    public function createHeader($user_id, $payment_reference) {
        $query = $this->db->prepare("
            INSERT INTO orders
            (user_id, payment_reference)
            VALUES(?, ?)
        ");

        $query->execute([
            $user_id,
            $payment_reference
        ]);

        return $this->db->lastInsertId();
    }

    public function createDetail($order_id, $item) {
        $query = $this->db->prepare("
            INSERT INTO orderdetails
            (order_id, product_id, quantity, price_each)
            VALUES(?, ?, ?, ?)
        ");
    
        return $query->execute([
            $order_id,
            $item["product_id"],
            $item["quantity"],
            $item["price"]
        ]);
    }

    public function getPaymentRef() {
        return mt_rand(10000000000000, 99999999999999);
    }

    public function create($data) {
        require("products.php");
        $modelProducts = new Products();
        
        $payment_ref = $this->getPaymentRef();
    
        $order_id = $this->createHeader(
            $data["user_id"],
            $payment_ref 
        );
    
        foreach ($data["products"] as $item) {
            $product = $modelProducts->getDetail($item["product_id"]);
            $item["price"] = $product["price"];
            
            if (!$modelProducts->updateStock($item["product_id"], $item["quantity"])) {
                throw new Exception("Estoque insuficiente para o produto ID: " . $item["product_id"]);
            }
    
            $this->createDetail($order_id, $item);
        }
    
        $data["order_id"] = $order_id;
        $data["payment_ref"] = $payment_ref;
    
        return $data;
    }

    public function delete($id) {
        $query = $this->db->prepare("
            DELETE FROM orderdetails
            WHERE order_id = ?
        ");
        $query->execute([$id]);

        $query = $this->db->prepare("
            DELETE FROM orders
            WHERE order_id = ?
        ");
    
        return $query->execute([$id]);
    }
}