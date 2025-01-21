<?php
declare (strict_types = 1);
namespace MyApp\Model;

use MyApp\Entity\Type;
use PDO;

class TypeModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getAllTypes(): array
    {
        $sql = "SELECT * FROM Type";
        $stmt = $this->db->query($sql);
        $types = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $types[] = new Type($row['id'], $row['label']);
        }
        return $types;
    }
}
