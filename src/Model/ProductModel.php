<?php
declare (strict_types = 1);

namespace MyApp\Model;

use MyApp\Entity\Product;
use PDO;

class ProductModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getAllProducts(): array
    {
        $sql = "SELECT * FROM Product";
        $stmt = $this->db->query($sql);
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product($row['id'], $row['name'], $row['price']);
        }
        return $products;
    }
}
