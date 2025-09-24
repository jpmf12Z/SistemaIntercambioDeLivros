<?php include __DIR__ . '/../templates/header.php'; ?>

<h2>Livros cadastrados</h2>
<a href="/bb/index.php?route=book/form">Adicionar livro</a>

<table border="1" cellpadding="5">
<tr><th>ID</th><th>Título</th><th>Autor</th><th>Ações</th></tr>
<?php foreach($books as $b): ?>
<tr>
  <td><?= $b['id'] ?></td>
  <td><?= htmlspecialchars($b['title']) ?></td>
  <td><?= htmlspecialchars($b['author']) ?></td>
  <td>
    <a href="/bb/index.php?route=book/detail&id=<?= $b['id'] ?>">Ver</a> |
    <a href="/bb/index.php?route=book/form&id=<?= $b['id'] ?>">Editar</a> |
    <a href="/bb/index.php?route=book/delete&id=<?= $b['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
  </td>
</tr>
<?php endforeach; ?>
</table>

<?php include __DIR__ . '/../templates/footer.php'; ?>
