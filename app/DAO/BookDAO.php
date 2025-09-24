<?php
namespace App\DAO;
use App\Core\Database;
use PDO;

class BookDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
    $stmt = $this->db->prepare("INSERT INTO books (title, author, description, book_condition, user_id) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([
        $data['title'],
        $data['author'],
        $data['description'],
        $data['condition'],   // ainda pode usar 'condition' no PHP, sem problema
        $data['user_id']
    ]);
}

public function update($id, $data) {
    $stmt = $this->db->prepare("UPDATE books SET title=?, author=?, description=?, book_condition=? WHERE id=?");
    return $stmt->execute([
        $data['title'],
        $data['author'],
        $data['description'],
        $data['condition'],
        $id
    ]);
}

    public function delete($id) {
    // verifica se o livro está em propostas
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM trade_proposal_items WHERE book_id = ?");
    $stmt->execute([$id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        throw new \Exception("Este livro não pode ser excluído pois já faz parte de propostas de troca.");
    }

    $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
    return $stmt->execute([$id]);
    }
}
