<?php

require_once 'Baza.php';
require_once 'UserManager.php';

class Order
{
    protected $userId;
    protected $flavour;
    protected $extras;
    protected $occasion;
    protected $weight;
    protected $text;
    protected $date;
    protected $status;
    protected $price;

    public function __construct($userId, $flavour, $extras, $occasion, $weight, $text, $price)
    {
        $this->userId = $userId;
        $this->flavour = $flavour;
        $this->extras = isset($extras) ? implode(", ", $extras) : "";
        $this->occasion = $occasion;
        $this->weight = $weight;
        $this->text = $text;
        $this->date = (new DateTime())->format('Y-m-d');
        $this->status = "Złożone";
        $this->price = $price;
    }

    public function saveToDB($db)
    {
        $sql = "INSERT INTO orders (user_id, flavour, extras, occasion, weight, text, price, date, status)
                VALUES ('$this->userId', '$this->flavour', '$this->extras', '$this->occasion','$this->weight', '$this->text','$this->price', '$this->date', '$this->status')";
        return $db->insert($sql);
    }

    public static function getAllOrders($db, $userId)
    {
        if ($userId == -1) {
            return [];
        }

        $sql = "SELECT id, flavour, extras, occasion, weight, text, DATE_FORMAT(`date`, '%d-%m-%Y') AS formatted_date, status, price
            FROM orders 
            WHERE user_id = $userId
            ORDER BY `date` DESC";

        $fields = ['id', 'flavour', 'extras', 'occasion', 'weight', 'text', 'formatted_date', 'status', 'price'];

        $result = $db->select($sql, $fields);

        if (empty($result)) {
            return [];
        }

        return $result;
    }

    public static function deleteOrder($db, $id)
    {
        $sql = "DELETE FROM orders WHERE id=$id";
        return $db->delete($sql);
    }

    public static function deleteAllOrders($db)
    {
        $sql = "DELETE FROM orders";
        return $db->delete($sql);
    }

    public static function getAllOrdersForAdmin($db)
    {
        $sql = "SELECT id, user_id, flavour, extras, occasion, weight, text, DATE_FORMAT(`date`, '%d-%m-%Y') AS formatted_date, status, price 
        FROM orders 
        ORDER BY `date` DESC";

        $fields = ['id', 'user_id', 'flavour', 'extras', 'occasion', 'weight', 'text', 'formatted_date', 'status', 'price'];

        $result = $db->select($sql, $fields);

        if (empty($result)) {
            return [];
        }

        return $result;
    }
}
