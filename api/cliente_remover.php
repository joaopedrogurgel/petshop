<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Remover Cliente - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Remover Cliente</h1>

    <p>
      <a href="/pages/cliente/cadastro.html">Cadastro</a>
      <a href="/pages/cliente/consulta.html">Consulta</a>
      <a href="/pages/cliente/alteracao.html">Alteração</a>
      <a href="/pages/cliente/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=cliente_relatorio">Relatório</a>
    </p>


    <?php
    if (isset($_POST["cpf"])) {
      $sql = $db->prepare("select * from cliente where cpf = ?");
      $sql->execute(array($_POST["cpf"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        $sql = $db->prepare("select * from atendimento where cpf_cliente = ?");
        $sql->execute(array($_POST["cpf"]));
        if ($sql->fetch()) {
          echo "<p class='text-danger'>O cliente " . htmlspecialchars($linha->nome) . " possui atendimentos cadastrados e não pode ser removido.</p>";
        }
        else {
          if (isset($_REQUEST["confirmar"])) {
            $sql = $db->prepare("delete from cliente where cpf = ?");
            $res = $sql->execute(array($_POST["cpf"]));
            if ($res)
              echo "<p class='text-success'>Cliente " . htmlspecialchars($linha->nome) . " removido com sucesso!</p>";
            else
              echo "<p class='text-danger'>Falha ao remover o cliente.</p>";
          }
          else {
            echo "<p>Confira os dados antes de remover:</p>";
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
            echo "<form action='/api/index.php?pagina=cliente_remover&amp;confirmar=sim' method='post'>";
            echo "<button type='submit' name='cpf' value='" . htmlspecialchars($linha->cpf) . "' class='btn btn-danger'>Confirmar remoção</button> ";
            echo "<a href='/pages/cliente/remocao.html' class='btn btn-secondary'>Cancelar</a>";
            echo "</form>";
          }
        }
      }
      else {
        echo "<p class='text-danger'>Nenhum cliente encontrado com o CPF " . htmlspecialchars($_POST["cpf"]) . ".</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/cliente/remocao.html" class="btn btn-primary">Nova remoção</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
