<?php include __DIR__ . '/../templates/header.php'; ?>

<h2>Add Book</h2>

<form method="post" action="/bb/index.php?route=book/save">
  <p>
    <label>Title: <input type="text" name="title" required></label>
  </p>
  <p>
    <label>Author: <input type="text" name="author" required></label>
  </p>
  <p>
    <label>Description:<br>
      <textarea name="description"></textarea>
    </label>
  </p>
  <p>
    <label>Condition:
      <select name="condition">
        <option value="new">New</option>
        <option value="used">Used</option>
      </select>
    </label>
  </p>

  <!-- usuário fixo só para teste -->
  <input type="hidden" name="user_id" value="1">

  <button type="submit">Save</button>
</form>

<p><a href="/bb/index.php?route=book/list">Back to list</a></p>

<?php include __DIR__ . '/../templates/footer.php'; ?>
