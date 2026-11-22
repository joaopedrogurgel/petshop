<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar Cliente - Petshop</title>
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
      <a class="nav-link text-white" href="/api/atendimento_cadastro.php">Atendimentos</a>
    </div>
  </nav>

  <div class="container mt-4">
    <h1>Alterar Cliente</h1>

    <p>
      <a href="/pages/cliente/cadastro.html">Cadastro</a>
      <a href="/pages/cliente/consulta.html">Consulta</a>
      <a href="/pages/cliente/alteracao.html">Alteração</a>
      <a href="/pages/cliente/remocao.html">Remoção</a>
      <a href="/api/cliente_relatorio.php">Relatório</a>
    </p>

    <?php
    if (isset($_POST["cpf"])) {
      $sql = $db->prepare("update cliente set nome = ?, telefone = ?, email = ?, rg = ? where cpf = ?");
      $res = $sql->execute(array($_POST["nome"], $_POST["telefone"], $_POST["email"], $_POST["rg"], $_POST["cpf"]));
      if ($res)
        echo "<p>Cliente " . htmlspecialchars($_POST["nome"]) . " alterado com sucesso!</p>";
      else
        echo "<p>Falha ao alterar o cliente.</p>";
    }
    else {
      echo "<p>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/cliente/alteracao.html" class="btn btn-primary">Nova alteração</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <footer class="text-center mt-5">
    <p>Programação de Sistemas Web - Software para Gerenciamento de Petshop</p>
  </footer>

</body>
</html>
