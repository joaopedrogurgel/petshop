<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consultar Atendimento - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Consultar Atendimento</h1>

    <p>
      <a href="/api/index.php?pagina=atendimento_cadastro">Cadastro</a>
      <a href="/pages/atendimento/consulta.html">Consulta</a>
      <a href="/pages/atendimento/alteracao.html">Alteração</a>
      <a href="/pages/atendimento/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=atendimento_relatorio">Relatório</a>
    </p>

    <h2>Resultado</h2>

    <?php
    if (isset($_GET["busca"])) {
      $sql = $db->prepare("select * from atendimento where codigo = ?");
      $sql->execute(array($_GET["busca"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        echo "<table class='table table-bordered'>";
        echo "<tr><th>Código</th><th>Data</th><th>CPF do cliente</th><th>Animal</th><th>Matrícula do funcionário</th></tr>";
        echo "<tr>";
        echo "<td>" . htmlspecialchars($linha->codigo) . "</td>";
        echo "<td>" . htmlspecialchars($linha->data) . "</td>";
        echo "<td>" . htmlspecialchars($linha->cpf_cliente) . "</td>";
        echo "<td>" . htmlspecialchars($linha->nome_animal) . "</td>";
        echo "<td>" . htmlspecialchars($linha->matricula_funcionario) . "</td>";
        echo "</tr>";
        echo "</table>";
      }
      else {
        echo "<p class='text-danger'>Nenhum atendimento encontrado com o código " . htmlspecialchars($_GET["busca"]) . ".</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Informe o código na página de consulta.</p>";
    }
    ?>

    <a href="/pages/atendimento/consulta.html" class="btn btn-primary">Nova consulta</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
