<?php
namespace App\Services;
use App\DAO\BookDAO;

class BookService {
    private $dao;

    public function __construct() {
        $this->dao = new BookDAO();
    }

    public function listAll() {
        return $this->dao->findAll();
    }

    public function listByUser($userId) {
        return $this->dao->findByUser($userId);
    }

    public function get($id) {
        return $this->dao->findById($id);
    }

    public function create($data) {
        return $this->dao->insert($data);
    }

    public function update($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
