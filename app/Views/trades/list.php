<?php include __DIR__ . '/../templates/header.php'; ?>
<h2>Minhas Propostas de Troca</h2>

<?php if(empty($trades)): ?>
  <p>Nenhuma troca ainda.</p>
<?php else: ?>
  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Livro Alvo</th>
      <th>Livros Oferecidos</th>
      <th>Status</th>
      <th>Mensagem</th>
      <th>Ações</th>
    </tr>
    <?php foreach($trades as $t): ?>
    <tr>
      <td><?= $t['id'] ?></td>
      <td><?= htmlspecialchars($t['target_book']) ?></td>
      <td>
        <?php foreach($t['offered_books'] as $ob): ?>
          <?= htmlspecialchars($ob) ?><br>
        <?php endforeach; ?>
      </td>
      <td><?= $t['status'] ?></td>
      <td><?= htmlspecialchars($t['message']) ?></td>
      <td>
        <?php if ($t['status'] === 'pending'): ?>
        <a href="/SistemaIntercambioDeLivros/index.php?route=trade/accept&id=<?= $t['id'] ?>">Aceitar</a> |
        <a href="/SistemaIntercambioDeLivros/index.php?route=trade/reject&id=<?= $t['id'] ?>">Rejeitar</a>
        <?php elseif ($t['status'] === 'accepted'): ?>
        ✅ Accepted
        <?php elseif ($t['status'] === 'rejected'): ?>
        ❌ Rejected
        <?php endif; ?>
    </td>
    </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

<?php include __DIR__ . '/../templates/footer.php'; ?>
