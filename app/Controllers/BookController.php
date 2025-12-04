<?php
namespace App\Controllers;
use App\Services\BookService;

class BookController {
    private $service;

    public function __construct() {
        $this->service = new BookService();
    }

    public function list() {
        $books = $this->service->listAll();
        include __DIR__ . '/../Views/books/list.php';
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        $book = $this->service->get($id);
        include __DIR__ . '/../Views/books/detail.php';
    }

    public function form() {
        $id = $_GET['id'] ?? null;
        $book = $id ? $this->service->get($id) : null;
        include __DIR__ . '/../Views/books/form.php';
    }

    public function save() {
    $data = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'condition' => $_POST['condition'],
        'user_id' => $_POST['user_id'] ?? 1
    ];
    $this->service->create($data);
    header("Location: /SistemaIntercambioDeLivros/index.php?route=book/list");
}

    public function delete() {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header("Location: /SistemaIntercambioDeLivros/index.php?route=book/list");
        exit;
    }

    try {
        $this->service->delete($id);
        header("Location: /SistemaIntercambioDeLivros/index.php?route=book/list");
        exit;
    } catch (\Exception $e) {
        // Exibe erro de forma mais amigável
        echo "<p style='color:red;'>Erro: " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><a href='/SistemaIntercambioDeLivros/index.php?route=book/list'>Voltar para lista</a></p>";
    }

 }
}