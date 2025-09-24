<?php
namespace App\Controllers;
use App\Services\TradeService;
use App\Services\BookService;

class TradeController {
    private $service;
    private $bookService;

    public function __construct() {
        $this->service = new TradeService();
        $this->bookService = new BookService();
    }

    public function proposeForm() {
        $targetBookId = $_GET['book_id'];
        $targetBook = $this->bookService->get($targetBookId);

        // List user books (fake login for now: user_id=1)
        $userId = $_SESSION['user_id'] ?? 1;
        $myBooks = $this->bookService->listAll(); // Ideally filter only user's books

        include __DIR__ . '/../Views/trades/propose.php';
    }

    public function propose() {
    $data = [
        'proposer_id'   => 1, // usuário fixo de teste
        'target_user_id'=> $_POST['target_user_id'],
        'target_book_id'=> $_POST['target_book_id'],
        'message'       => $_POST['message'] ?? '',
        'offered_books' => $_POST['offered_books'] ?? []
    ];

    $service = new \App\Services\TradeService();
    $service->proposeTrade($data);

    header("Location: /bb/index.php?route=trade/list");
}

    public function list() {
        $userId = $_SESSION['user_id'] ?? 1;
        $trades = $this->service->listUserTrades($userId);
        include __DIR__ . '/../Views/trades/list.php';
    }

   public function accept($id = null) {
    // tenta usar o parâmetro, senão pega do querystring
    $id = $id ?? ($_GET['id'] ?? null);

    if (!$id) {
        // id inválido → volta para a lista
        header("Location: /bb/index.php?route=trade/list");
        exit;
    }

    // chama o service para aceitar
    $this->service->acceptTrade($id);

    // redireciona de volta
    header("Location: /bb/index.php?route=trade/list");
    exit;
}

public function reject($id = null) {
    $id = $id ?? ($_GET['id'] ?? null);

    if (!$id) {
        header("Location: /bb/index.php?route=trade/list");
        exit;
    }

    $this->service->rejectTrade($id);

    header("Location: /bb/index.php?route=trade/list");
    exit;
}

}
