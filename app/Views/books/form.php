<?php include __DIR__ . '/../templates/header.php'; ?>

<h2>Adicionar Livro</h2>

<form method="post" action="/SistemaIntercambioDeLivros/index.php?route=book/save">
  <p>
    <label>Titulo: <input type="text" name="title" required></label>
  </p>
  <p>
    <label>Autor: <input type="text" name="author" required></label>
  </p>
  <p>
    <label>Descrição:<br>
      <textarea name="description"></textarea>
    </label>
  </p>
  <p>
    <label>Condição:
      <select name="condition">
        <option value="new">Novo</option>
        <option value="used">Usado</option>
      </select>
    </label>
  </p>

  <!-- usuário fixo só para teste -->
  <input type="hidden" name="user_id" value="1">

  <button type="submit">Salvar</button>
</form>

<p><a href="/SistemaIntercambioDeLivros/index.php?route=book/list">Voltar para a lista</a></p>

<?php include __DIR__ . '/../templates/footer.php'; ?>
