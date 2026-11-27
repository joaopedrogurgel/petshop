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

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Alterar Cliente</h1>

    <p>
      <a href="/pages/cliente/cadastro.html">Cadastro</a>
      <a href="/pages/cliente/consulta.html">Consulta</a>
      <a href="/pages/cliente/alteracao.html">Alteração</a>
      <a href="/pages/cliente/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=cliente_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_REQUEST["busca"])) {
      $sql = $db->prepare("select * from cliente where cpf = ?");
      $sql->execute(array($_REQUEST["busca"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        echo "<form action='/api/index.php' method='post'>";
        echo "<div class='mb-3'>";
        echo "<label for='cpf' class='form-label'>CPF</label>";
        echo "<input type='text' class='form-control' id='cpf' name='cpf' value='" . htmlspecialchars($linha->cpf) . "' readonly>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='nome' class='form-label'>Nome</label>";
        echo "<input type='text' class='form-control' id='nome' name='nome' value='" . htmlspecialchars($linha->nome) . "' required>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='telefone' class='form-label'>Telefone</label>";
        echo "<input type='tel' class='form-control' id='telefone' name='telefone' value='" . htmlspecialchars($linha->telefone) . "' required>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='email' class='form-label'>E-mail</label>";
        echo "<input type='email' class='form-control' id='email' name='email' value='" . htmlspecialchars($linha->email) . "' required>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='rg' class='form-label'>RG</label>";
        echo "<input type='text' class='form-control' id='rg' name='rg' value='" . htmlspecialchars($linha->rg) . "' required>";
        echo "</div>";
        echo "<button type='submit' name='pagina' value='cliente_alterar' class='btn btn-primary'>Salvar</button> ";
        echo "<a href='/pages/cliente/alteracao.html' class='btn btn-secondary'>Voltar</a>";
        echo "</form>";
      }
      else {
        echo "<p class='text-danger'>Nenhum cliente encontrado com o CPF " . htmlspecialchars($_REQUEST["busca"]) . ".</p>";
        echo "<a href='/pages/cliente/alteracao.html' class='btn btn-secondary'>Voltar</a>";
      }
    }
    else {
      echo "<p class='text-danger'>Informe o CPF na página de alteração.</p>";
    }
    ?>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
