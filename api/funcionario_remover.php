<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Remover Funcionário - Petshop</title>
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
    <h1>Remover Funcionário</h1>

    <p>
      <a href="/pages/funcionario/cadastro.html">Cadastro</a>
      <a href="/pages/funcionario/consulta.html">Consulta</a>
      <a href="/pages/funcionario/alteracao.html">Alteração</a>
      <a href="/pages/funcionario/remocao.html">Remoção</a>
      <a href="/api/funcionario_relatorio.php">Relatório</a>
    </p>

    <?php
    if (isset($_POST["matricula"])) {
      $sql = $db->prepare("select * from funcionario where matricula = ?");
      $sql->execute(array($_POST["matricula"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        $sql = $db->prepare("select * from atendimento where matricula_funcionario = ?");
        $sql->execute(array($_POST["matricula"]));
        if ($sql->fetch()) {
          echo "<p>O funcionário " . htmlspecialchars($linha->nome) . " possui atendimentos cadastrados e não pode ser removido.</p>";
        }
        else {
          $sql = $db->prepare("delete from funcionario where matricula = ?");
          $res = $sql->execute(array($_POST["matricula"]));
          if ($res)
            echo "<p>Funcionário " . htmlspecialchars($linha->nome) . " removido com sucesso!</p>";
          else
            echo "<p>Falha ao remover o funcionário.</p>";
        }
      }
      else {
        echo "<p>Nenhum funcionário encontrado com a matrícula " . htmlspecialchars($_POST["matricula"]) . ".</p>";
      }
    }
    else {
      echo "<p>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <a href="/pages/funcionario/remocao.html" class="btn btn-primary">Nova remoção</a>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <footer class="text-center mt-5">
    <p>Programação de Sistemas Web - Software para Gerenciamento de Petshop</p>
  </footer>

</body>
</html>
