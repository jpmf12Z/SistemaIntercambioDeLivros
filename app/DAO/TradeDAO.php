<?php
namespace App\DAO;
use App\Core\Database;
use PDO;

class TradeDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function createProposal($data) {
        $stmt = $this->db->prepare("INSERT INTO trade_proposals 
            (proposer_id, target_user_id, target_book_id, message) 
            VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['proposer_id'], 
            $data['target_user_id'], 
            $data['target_book_id'], 
            $data['message']
        ]);
        $proposalId = $this->db->lastInsertId();

        foreach ($data['offered_books'] as $bookId) {
            $stmt = $this->db->prepare("INSERT INTO trade_proposal_items (proposal_id, book_id) VALUES (?, ?)");
            $stmt->execute([$proposalId, $bookId]);
        }
        return $proposalId;
    }

    public function findByUser($userId) {
        $stmt = $this->db->prepare("
            SELECT tp.*, b.title as target_book 
            FROM trade_proposals tp
            JOIN books b ON tp.target_book_id = b.id
            WHERE proposer_id = ? OR target_user_id = ?
            ORDER BY created_at DESC
        ");
        $stmt->execute([$userId, $userId]);
        $trades = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Buscar livros oferecidos em cada trade
        foreach ($trades as &$trade) {
            $stmtItems = $this->db->prepare("
                SELECT b.title 
                FROM trade_proposal_items tpi
                JOIN books b ON tpi.book_id = b.id
                WHERE tpi.proposal_id = ?
            ");
            $stmtItems->execute([$trade['id']]);
            $trade['offered_books'] = $stmtItems->fetchAll(PDO::FETCH_COLUMN);
        }

        return $trades;
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE trade_proposals SET status=? WHERE id=?");
        return $stmt->execute([$status, $id]);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM trade_proposals WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
