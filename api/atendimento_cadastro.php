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
    <h1>Cadastrar Atendimento</h1>

    <p>
      <a href="/api/index.php?pagina=atendimento_cadastro">Cadastro</a>
      <a href="/pages/atendimento/consulta.html">Consulta</a>
      <a href="/pages/atendimento/alteracao.html">Alteração</a>
      <a href="/pages/atendimento/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=atendimento_relatorio">Relatório</a>
    </p>

    <?php
    $falta = false;
    $tabela = $db->query("select * from cliente");
    if (!$tabela->fetch()) {
      echo "<p class='text-danger'>Nenhum cliente cadastrado. <a href='/pages/cliente/cadastro.html'>Cadastre antes de criar um atendimento.</a></p>";
      $falta = true;
    }
    $tabela = $db->query("select * from animal");
    if (!$tabela->fetch()) {
      echo "<p class='text-danger'>Nenhum animal cadastrado. <a href='/pages/animal/cadastro.html'>Cadastre antes de criar um atendimento.</a></p>";
      $falta = true;
    }
    $tabela = $db->query("select * from funcionario");
    if (!$tabela->fetch()) {
      echo "<p class='text-danger'>Nenhum funcionário cadastrado. <a href='/pages/funcionario/cadastro.html'>Cadastre antes de criar um atendimento.</a></p>";
      $falta = true;
    }
    if ($falta) {
      echo "<a href='/index.html' class='btn btn-secondary'>Voltar</a>";
    }
    else {
      echo "<form action='/api/index.php' method='post' onsubmit='return validarAtendimento()'>";
      echo "<div class='mb-3'>";
      echo "<label for='codigo' class='form-label'>Código</label>";
      echo "<input type='text' class='form-control' id='codigo' name='codigo' pattern='[0-9]{4}' placeholder='4 dígitos (ex.: 0001)' required>";
      echo "</div>";
      echo "<div class='mb-3'>";
      echo "<label for='data' class='form-label'>Data</label>";
      echo "<input type='date' class='form-control' id='data' name='data' required>";
      echo "</div>";
      echo "<div class='mb-3'>";
      echo "<label for='cliente' class='form-label'>Cliente</label>";
      echo "<select class='form-control' id='cliente' name='cliente' required>";
      $tabela = $db->query("select * from cliente");
      $tabela->setFetchMode(PDO::FETCH_OBJ);
      while ($linha = $tabela->fetch()) {
        echo "<option value='" . htmlspecialchars($linha->cpf) . "'>" . htmlspecialchars($linha->nome) . " (CPF " . htmlspecialchars($linha->cpf) . ")" . "</option>";
      }
      echo "</select>";
      echo "</div>";
      echo "<div class='mb-3'>";
      echo "<label for='animal' class='form-label'>Animal</label>";
      echo "<select class='form-control' id='animal' name='animal' required>";
      $tabela = $db->query("select * from animal");
      $tabela->setFetchMode(PDO::FETCH_OBJ);
      while ($linha = $tabela->fetch()) {
        echo "<option value='" . htmlspecialchars($linha->nome) . "'>" . htmlspecialchars($linha->nome) . "</option>";
      }
      echo "</select>";
      echo "</div>";
      echo "<div class='mb-3'>";
      echo "<label for='funcionario' class='form-label'>Funcionário</label>";
      echo "<select class='form-control' id='funcionario' name='funcionario' required>";
      $tabela = $db->query("select * from funcionario");
      $tabela->setFetchMode(PDO::FETCH_OBJ);
      while ($linha = $tabela->fetch()) {
        echo "<option value='" . htmlspecialchars($linha->matricula) . "'>" . htmlspecialchars($linha->nome) . " (matrícula " . htmlspecialchars($linha->matricula) . ")" . "</option>";
      }
      echo "</select>";
      echo "</div>";
      echo "<button type='submit' name='pagina' value='atendimento_cadastrar' class='btn btn-primary'>Cadastrar</button> ";
      echo "<a href='/index.html' class='btn btn-secondary'>Voltar</a>";
      echo "</form>";
    }
    ?>
  </div>

  <footer class="text-center mt-5">
    <p>Programação de Sistemas Web - Software para Gerenciamento de Petshop</p>
  </footer>

  <script>
    function validarAtendimento() {
      var codigo = document.getElementById("codigo").value;

      if (codigo.length != 4) {
        alert("O código deve ter 4 dígitos (ex.: 0001)!");
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
