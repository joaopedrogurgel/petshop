<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consultar Cliente - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Consultar Cliente</h1>

    <p>
      <a href="/pages/cliente/cadastro.html">Cadastro</a>
      <a href="/pages/cliente/consulta.html">Consulta</a>
      <a href="/pages/cliente/alteracao.html">Alteração</a>
      <a href="/pages/cliente/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=cliente_relatorio">Relatório</a>
    </p>

    <h2>Resultado</h2>

    <?php
    if (isset($_GET["busca"])) {
      $sql = $db->prepare("select * from cliente where cpf = ?");
      $sql->execute(array($_GET["busca"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        echo "<table class='table table-bordered'>";
        echo "<tr><th>Nome</th><th>Telefone</th><th>E-mail</th><th>RG</th><th>CPF</th></tr>";
        echo "<tr>";
        echo "<td>" . htmlspecialchars($linha->nome) . "</td>";
        echo "<td>" . htmlspecialchars($linha->telefone) . "</td>";
        echo "<td>" . htmlspecialchars($linha->email) . "</td>";
        echo "<td>" . htmlspecialchars($linha->rg) . "</td>";
        echo "<td>" . htmlspecialchars($linha->cpf) . "</td>";
        echo "</tr>";
        echo "</table>";
      }
      else {
        echo "<p class='text-danger'>Nenhum cliente encontrado com o CPF " . htmlspecialchars($_GET["busca"]) . ".</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Informe o CPF na página de consulta.</p>";
    }
    ?>

    <a href="/pages/cliente/consulta.html" class="btn btn-primary">Nova consulta</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
