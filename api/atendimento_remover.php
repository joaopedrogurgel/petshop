<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Remover Atendimento - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Remover Atendimento</h1>

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
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        if (isset($_REQUEST["confirmar"])) {
          $sql = $db->prepare("delete from atendimento where codigo = ?");
          $res = $sql->execute(array($_POST["codigo"]));
          if ($res)
            echo "<p class='text-success'>Atendimento " . htmlspecialchars($_POST["codigo"]) . " removido com sucesso!</p>";
          else
            echo "<p class='text-danger'>Falha ao remover o atendimento.</p>";
        }
        else {
          echo "<p>Confira os dados antes de remover:</p>";
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
          echo "<form action='/api/index.php?pagina=atendimento_remover&amp;confirmar=sim' method='post'>";
          echo "<button type='submit' name='codigo' value='" . htmlspecialchars($linha->codigo) . "' class='btn btn-danger'>Confirmar remoção</button> ";
          echo "<a href='/pages/atendimento/remocao.html' class='btn btn-secondary'>Cancelar</a>";
          echo "</form>";
        }
      }
      else {
        echo "<p class='text-danger'>Nenhum atendimento encontrado com o código " . htmlspecialchars($_POST["codigo"]) . ".</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/atendimento/remocao.html" class="btn btn-primary">Nova remoção</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
