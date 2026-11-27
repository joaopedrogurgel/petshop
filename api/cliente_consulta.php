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

  <nav class="navbar navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="/index.html">Petshop</a>
      <a class="nav-link text-white" href="/index.html">Início</a>
      <a class="nav-link text-white" href="/pages/cliente/cadastro.html">Clientes</a>
      <a class="nav-link text-white" href="/pages/funcionario/cadastro.html">Funcionários</a>
      <a class="nav-link text-white" href="/pages/animal/cadastro.html">Animais</a>
      <a class="nav-link text-white" href="/api/index.php?pagina=atendimento_cadastro">Atendimentos</a>
    </div>
  </nav>

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
        echo "<p>Nenhum cliente encontrado com o CPF " . htmlspecialchars($_GET["busca"]) . ".</p>";
      }
    }
    else {
      echo "<p>Informe o CPF na página de consulta.</p>";
    }
    ?>

    <a href="/pages/cliente/consulta.html" class="btn btn-primary">Nova consulta</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <footer class="text-center mt-5">
    <p>Programação de Sistemas Web - Software para Gerenciamento de Petshop</p>
  </footer>

</body>
</html>
