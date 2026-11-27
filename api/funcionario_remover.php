<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Remover Funcionário - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Remover Funcionário</h1>

    <p>
      <a href="/pages/funcionario/cadastro.html">Cadastro</a>
      <a href="/pages/funcionario/consulta.html">Consulta</a>
      <a href="/pages/funcionario/alteracao.html">Alteração</a>
      <a href="/pages/funcionario/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=funcionario_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_POST["matricula"])) {
      $sql = $db->prepare("select * from funcionario where matricula = ?");
      $sql->execute(array($_POST["matricula"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        $sql = $db->prepare("select * from atendimento where matricula_funcionario = ?");
        $sql->execute(array($_POST["matricula"]));
        if ($sql->fetch()) {
          echo "<p class='text-danger'>O funcionário " . htmlspecialchars($linha->nome) . " possui atendimentos cadastrados e não pode ser removido.</p>";
        }
        else {
          $sql = $db->prepare("delete from funcionario where matricula = ?");
          $res = $sql->execute(array($_POST["matricula"]));
          if ($res)
            echo "<p class='text-success'>Funcionário " . htmlspecialchars($linha->nome) . " removido com sucesso!</p>";
          else
            echo "<p class='text-danger'>Falha ao remover o funcionário.</p>";
        }
      }
      else {
        echo "<p class='text-danger'>Nenhum funcionário encontrado com a matrícula " . htmlspecialchars($_POST["matricula"]) . ".</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/funcionario/remocao.html" class="btn btn-primary">Nova remoção</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
