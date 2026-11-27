<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Remover Animal - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Remover Animal</h1>

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
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        $sql = $db->prepare("select * from atendimento where nome_animal = ?");
        $sql->execute(array($_POST["nome"]));
        if ($sql->fetch()) {
          echo "<p class='text-danger'>O animal " . htmlspecialchars($linha->nome) . " possui atendimentos cadastrados e não pode ser removido.</p>";
        }
        else {
          $sql = $db->prepare("delete from animal where nome = ?");
          $res = $sql->execute(array($_POST["nome"]));
          if ($res)
            echo "<p class='text-success'>Animal " . htmlspecialchars($linha->nome) . " removido com sucesso!</p>";
          else
            echo "<p class='text-danger'>Falha ao remover o animal.</p>";
        }
      }
      else {
        echo "<p class='text-danger'>Nenhum animal encontrado com o nome " . htmlspecialchars($_POST["nome"]) . ".</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/animal/remocao.html" class="btn btn-primary">Nova remoção</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
