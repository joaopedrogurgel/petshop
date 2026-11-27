<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar Atendimento - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Alterar Atendimento</h1>

    <p>
      <a href="/api/index.php?pagina=atendimento_cadastro">Cadastro</a>
      <a href="/pages/atendimento/consulta.html">Consulta</a>
      <a href="/pages/atendimento/alteracao.html">Alteração</a>
      <a href="/pages/atendimento/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=atendimento_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_POST["codigo"])) {
      $sql = $db->prepare("update atendimento set data = ?, cpf_cliente = ?, nome_animal = ?, matricula_funcionario = ? where codigo = ?");
      $res = $sql->execute(array($_POST["data"], $_POST["cliente"], $_POST["animal"], $_POST["funcionario"], $_POST["codigo"]));
      if ($res)
        echo "<p class='text-success'>Atendimento " . htmlspecialchars($_POST["codigo"]) . " alterado com sucesso!</p>";
      else
        echo "<p class='text-danger'>Falha ao alterar o atendimento.</p>";
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/atendimento/alteracao.html" class="btn btn-primary">Nova alteração</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
