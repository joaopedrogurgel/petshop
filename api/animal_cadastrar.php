<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastrar Animal - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Cadastrar Animal</h1>

    <p>
      <a href="/pages/animal/cadastro.html">Cadastro</a>
      <a href="/pages/animal/consulta.html">Consulta</a>
      <a href="/pages/animal/alteracao.html">Alteração</a>
      <a href="/pages/animal/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=animal_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_POST["nome"])) {
      $sql = $db->prepare("select * from animal where nome = ?");
      $sql->execute(array($_POST["nome"]));
      if ($sql->fetch()) {
        echo "<p class='text-danger'>Já existe um animal cadastrado com o nome " . htmlspecialchars($_POST["nome"]) . ".</p>";
      }
      else {
        $sql = $db->prepare("insert into animal (nome, peso, altura) values (?, ?, ?)");
        $res = $sql->execute(array($_POST["nome"], $_POST["peso"], $_POST["altura"]));
        if ($res)
          echo "<p class='text-success'>Animal " . htmlspecialchars($_POST["nome"]) . " cadastrado com sucesso!</p>";
        else
          echo "<p class='text-danger'>Falha ao cadastrar o animal.</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/animal/cadastro.html" class="btn btn-primary">Novo cadastro</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
