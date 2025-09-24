<?php
namespace App\Services;
use App\DAO\BookDAO;

class BookService {
    private $dao;
    public function __construct(){ $this->dao = new BookDAO(); }

    public function listAll(){ return $this->dao->all(); }
    public function get($id){ return $this->dao->findById($id); }

    public function createBook($data){
        // validações simples
        if(empty($data['title'])) throw new \Exception("Título é obrigatório");
        return $this->dao->create($data);
    }

    public function updateBook($id,$data){ return $this->dao->update($id,$data); }
    public function deleteBook($id){ return $this->dao->delete($id); }

    public function search($term){ return $this->dao->search($term); }
}
