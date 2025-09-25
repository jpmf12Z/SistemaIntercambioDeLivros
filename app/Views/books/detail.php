<?php include __DIR__ . '/../templates/header.php'; ?>
<h2><?= htmlspecialchars($book['book_condition']) ?>
<p><b>Author:</b> <?= htmlspecialchars($book['author']) ?></p>
<p><b>Description:</b> <?= nl2br(htmlspecialchars($book['description'])) ?></p>
<p><b>Condition:</b> <?= htmlspecialchars($book['book_condition'] ?? 'Not informed') ?></p>

<p>
  <a href="/SistemaIntercambioDeLivros/index.php?route=trade/proposeForm&book_id=<?= $book['id'] ?>">Propor Troca</a>
</p>

<p><a href="/SistemaIntercambioDeLivros/index.php?route=book/list">Voltar para a lista</a></p>
<?php include __DIR__ . '/../templates/footer.php'; ?>
