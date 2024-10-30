<?php
require_once __DIR__ . '/../models/Space.php';
require_once __DIR__ . '/../config/database.php';

class SpaceController {
    public function occupySpace($id_space) {
        $database = new Database();
        $db = $database->getConnection();

        $query = "UPDATE Espacios SET disponible = FALSE WHERE id = ? AND disponible = TRUE";
        $stmt = $db->prepare($query);
        return $stmt->execute([$id_space]);
    }

    public function freeSpace($id_space) {
        $database = new Database();
        $db = $database->getConnection();

        $query = "UPDATE Espacios SET disponible = TRUE WHERE id = ? AND disponible = FALSE";
        $stmt = $db->prepare($query);
        return $stmt->execute([$id_space]);
    }

    public function getAvailableSpaces($id_zona) {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT * FROM Espacios WHERE id_zona = ? AND disponible = TRUE";
        $stmt = $db->prepare($query);
        $stmt->execute([$id_zona]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

