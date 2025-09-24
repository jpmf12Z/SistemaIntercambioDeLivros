<?php include __DIR__ . '/../templates/header.php'; ?>
<h2>My Trade Proposals</h2>

<?php if(empty($trades)): ?>
  <p>No trades yet.</p>
<?php else: ?>
  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Target Book</th>
      <th>Offered Books</th>
      <th>Status</th>
      <th>Message</th>
      <th>Actions</th>
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
        <a href="/bb/index.php?route=trade/accept&id=<?= $t['id'] ?>">Accept</a> |
        <a href="/bb/index.php?route=trade/reject&id=<?= $t['id'] ?>">Reject</a>
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
