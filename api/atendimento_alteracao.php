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
    if (isset($_REQUEST["busca"])) {
      $sql = $db->prepare("select * from atendimento where codigo = ?");
      $sql->execute(array($_REQUEST["busca"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($atendimento = $sql->fetch()) {
        echo "<form action='/api/index.php' method='post'>";
        echo "<div class='mb-3'>";
        echo "<label for='codigo' class='form-label'>Código</label>";
        echo "<input type='text' class='form-control' id='codigo' name='codigo' value='" . htmlspecialchars($atendimento->codigo) . "' readonly>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='data' class='form-label'>Data</label>";
        echo "<input type='date' class='form-control' id='data' name='data' value='" . htmlspecialchars($atendimento->data) . "' required>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='cliente' class='form-label'>Cliente</label>";
        echo "<select class='form-control' id='cliente' name='cliente' required>";
        $tabela = $db->query("select * from cliente");
        $tabela->setFetchMode(PDO::FETCH_OBJ);
        while ($linha = $tabela->fetch()) {
          if ($linha->cpf == $atendimento->cpf_cliente)
            echo "<option value='" . htmlspecialchars($linha->cpf) . "' selected>" . htmlspecialchars($linha->nome) . " (CPF " . htmlspecialchars($linha->cpf) . ")" . "</option>";
          else
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
          if ($linha->nome == $atendimento->nome_animal)
            echo "<option value='" . htmlspecialchars($linha->nome) . "' selected>" . htmlspecialchars($linha->nome) . "</option>";
          else
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
          if ($linha->matricula == $atendimento->matricula_funcionario)
            echo "<option value='" . htmlspecialchars($linha->matricula) . "' selected>" . htmlspecialchars($linha->nome) . " (matrícula " . htmlspecialchars($linha->matricula) . ")" . "</option>";
          else
            echo "<option value='" . htmlspecialchars($linha->matricula) . "'>" . htmlspecialchars($linha->nome) . " (matrícula " . htmlspecialchars($linha->matricula) . ")" . "</option>";
        }
        echo "</select>";
        echo "</div>";
        echo "<button type='submit' name='pagina' value='atendimento_alterar' class='btn btn-primary'>Salvar</button> ";
        echo "<a href='/pages/atendimento/alteracao.html' class='btn btn-secondary'>Voltar</a>";
        echo "</form>";
      }
      else {
        echo "<p class='text-danger'>Nenhum atendimento encontrado com o código " . htmlspecialchars($_REQUEST["busca"]) . ".</p>";
        echo "<a href='/pages/atendimento/alteracao.html' class='btn btn-secondary'>Voltar</a>";
      }
    }
    else {
      echo "<p class='text-danger'>Informe o código na página de alteração.</p>";
    }
    ?>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
