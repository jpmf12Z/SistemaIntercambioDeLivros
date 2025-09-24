<?php
namespace App\Services;
use App\DAO\TradeDAO;

class TradeService {
    private $dao;

    public function __construct() {
        $this->dao = new TradeDAO();
    }

    public function proposeTrade($data) {
        if (empty($data['offered_books'])) {
            throw new \Exception("You must select at least one book to offer.");
        }
        return $this->dao->createProposal($data);
    }

    public function listUserTrades($userId) {
        return $this->dao->findByUser($userId);
    }

    public function acceptTrade($id) {
        return $this->dao->updateStatus($id, 'accepted');
    }

    public function rejectTrade($id) {
        return $this->dao->updateStatus($id, 'rejected');
    }

    public function getTrade($id) {
        return $this->dao->findById($id);
    }
}
