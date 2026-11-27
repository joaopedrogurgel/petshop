<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastrar Atendimento - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Cadastrar Atendimento</h1>

    <p>
      <a href="/api/index.php?pagina=atendimento_cadastro">Cadastro</a>
      <a href="/pages/atendimento/consulta.html">Consulta</a>
      <a href="/pages/atendimento/alteracao.html">Alteração</a>
      <a href="/pages/atendimento/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=atendimento_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_POST["codigo"])) {
      $sql = $db->prepare("select * from atendimento where codigo = ?");
      $sql->execute(array($_POST["codigo"]));
      if ($sql->fetch()) {
        echo "<p class='text-danger'>Já existe um atendimento cadastrado com o código " . htmlspecialchars($_POST["codigo"]) . ".</p>";
      }
      else {
        $sql = $db->prepare("insert into atendimento (codigo, data, cpf_cliente, nome_animal, matricula_funcionario) values (?, ?, ?, ?, ?)");
        $res = $sql->execute(array($_POST["codigo"], $_POST["data"], $_POST["cliente"], $_POST["animal"], $_POST["funcionario"]));
        if ($res)
          echo "<p class='text-success'>Atendimento " . htmlspecialchars($_POST["codigo"]) . " cadastrado com sucesso!</p>";
        else
          echo "<p class='text-danger'>Falha ao cadastrar o atendimento.</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/api/index.php?pagina=atendimento_cadastro" class="btn btn-primary">Novo cadastro</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
