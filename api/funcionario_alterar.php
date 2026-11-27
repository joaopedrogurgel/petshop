<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar Funcionário - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Alterar Funcionário</h1>

    <p>
      <a href="/pages/funcionario/cadastro.html">Cadastro</a>
      <a href="/pages/funcionario/consulta.html">Consulta</a>
      <a href="/pages/funcionario/alteracao.html">Alteração</a>
      <a href="/pages/funcionario/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=funcionario_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_POST["matricula"])) {
      $sql = $db->prepare("update funcionario set nome = ?, qualificacao = ?, descricao = ?, carga_horaria = ? where matricula = ?");
      $res = $sql->execute(array($_POST["nome"], $_POST["qualificacao"], $_POST["descricao"], $_POST["carga"], $_POST["matricula"]));
      if ($res)
        echo "<p class='text-success'>Funcionário " . htmlspecialchars($_POST["nome"]) . " alterado com sucesso!</p>";
      else
        echo "<p class='text-danger'>Falha ao alterar o funcionário.</p>";
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/funcionario/alteracao.html" class="btn btn-primary">Nova alteração</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
