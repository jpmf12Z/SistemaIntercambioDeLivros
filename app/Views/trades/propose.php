<?php include __DIR__ . '/../templates/header.php'; ?>
<h2>Propor Troca para: <?= htmlspecialchars($targetBook['title']) ?></h2>

<?php if(isset($error)): ?>
  <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="post" action="/bb/index.php?route=trade/propose">
  <input type="hidden" name="target_book_id" value="<?= $targetBook['id'] ?>">
  <input type="hidden" name="target_user_id" value="<?= $targetBook['user_id'] ?? 2 ?>">
  
  <p>Mensagem:<br><textarea name="message"></textarea></p>

  <h3>Selecione seus livros para oferecer:</h3>
  <?php foreach($myBooks as $b): ?>
    <label>
      <input type="checkbox" name="offered_books[]" value="<?= $b['id'] ?>">
      <?= htmlspecialchars($b['title']) ?>
    </label><br>
  <?php endforeach; ?>

  <button type="submit">Enviar Proposta</button>
</form>

<?php include __DIR__ . '/../templates/footer.php'; ?>
