<?php
/**
 * SQL.php - Operaciones de base de datos seguras
 * Autor: Google Gemini, adaptado para kwpd/sistema-varios[cite: 1, 2]
 * Repositorio: https://github.com/kwpd/sistema-varios/tree/main/MySql[cite: 2]
 */

require_once __DIR__ . '/config.php';

class DatabaseQueries {
    private $pdo;

    public function __construct($pdoConnection) {
        $this->pdo = $pdoConnection;
    }

    public function obtenerRegistroPorId($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM tu_tabla WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error en consulta: " . $e->getMessage());
            return false;
        }
    }
}

$db = new DatabaseQueries($pdo);
?>
