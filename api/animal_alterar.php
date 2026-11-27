<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar Animal - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Alterar Animal</h1>

    <p>
      <a href="/pages/animal/cadastro.html">Cadastro</a>
      <a href="/pages/animal/consulta.html">Consulta</a>
      <a href="/pages/animal/alteracao.html">Alteração</a>
      <a href="/pages/animal/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=animal_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_POST["nome"])) {
      $sql = $db->prepare("update animal set peso = ?, altura = ? where nome = ?");
      $res = $sql->execute(array($_POST["peso"], $_POST["altura"], $_POST["nome"]));
      if ($res)
        echo "<p class='text-success'>Animal " . htmlspecialchars($_POST["nome"]) . " alterado com sucesso!</p>";
      else
        echo "<p class='text-danger'>Falha ao alterar o animal.</p>";
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/animal/alteracao.html" class="btn btn-primary">Nova alteração</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
