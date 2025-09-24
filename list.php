<?php include __DIR__ . '/../templates/header.php'; ?>
<h2>Livros disponíveis</h2>
<form method="GET" action="/books/search">
  <input name="q" placeholder="buscar por título, autor ou tag">
  <button>Buscar</button>
</form>
<ul>
<?php foreach($books as $b): ?>
  <li>
    <a href="/books/show?id=<?= $b['id'] ?>">
      <?= htmlspecialchars($b['title']) ?> — <?= htmlspecialchars($b['author']) ?>
    </a>
    <small>por <?= htmlspecialchars($b['owner_name']) ?></small>
  </li>
<?php endforeach; ?>
</ul>
<?php include __DIR__ . '/../templates/footer.php'; ?>
