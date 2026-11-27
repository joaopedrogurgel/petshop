<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Remover Animal - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Remover Animal</h1>

    <p>
      <a href="/pages/animal/cadastro.html">Cadastro</a>
      <a href="/pages/animal/consulta.html">Consulta</a>
      <a href="/pages/animal/alteracao.html">Alteração</a>
      <a href="/pages/animal/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=animal_relatorio">Relatório</a>
    </p>

    <?php
    $confirmando = false;
    if (isset($_POST["nome"])) {
      $sql = $db->prepare("select * from animal where nome = ?");
      $sql->execute(array($_POST["nome"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        $sql = $db->prepare("select * from atendimento where nome_animal = ?");
        $sql->execute(array($_POST["nome"]));
        if ($sql->fetch()) {
          echo "<p class='text-danger'>O animal " . htmlspecialchars($linha->nome) . " possui atendimentos cadastrados e não pode ser removido.</p>";
        }
        else {
          if (isset($_REQUEST["confirmar"])) {
            $sql = $db->prepare("delete from animal where nome = ?");
            $res = $sql->execute(array($_POST["nome"]));
            if ($res)
              echo "<p class='text-success'>Animal " . htmlspecialchars($linha->nome) . " removido com sucesso!</p>";
            else
              echo "<p class='text-danger'>Falha ao remover o animal.</p>";
          }
          else {
            $confirmando = true;
            echo "<p>Confira os dados antes de remover:</p>";
            echo "<table class='table table-bordered'>";
            echo "<tr><th>Nome</th><th>Peso (kg)</th><th>Altura (cm)</th></tr>";
            echo "<tr>";
            echo "<td>" . htmlspecialchars($linha->nome) . "</td>";
            echo "<td>" . htmlspecialchars($linha->peso) . "</td>";
            echo "<td>" . htmlspecialchars($linha->altura) . "</td>";
            echo "</tr>";
            echo "</table>";
            echo "<form action='/api/index.php?pagina=animal_remover&amp;confirmar=sim' method='post'>";
            echo "<button type='submit' name='nome' value='" . htmlspecialchars($linha->nome) . "' class='btn btn-danger'>Confirmar remoção</button> ";
            echo "<a href='/api/index.php?pagina=animal_relatorio' class='btn btn-secondary'>Cancelar</a>";
            echo "</form>";
          }
        }
      }
      else {
        echo "<p class='text-danger'>Nenhum animal encontrado com o nome " . htmlspecialchars($_POST["nome"]) . ".</p>";
      }
    }
    else {
      echo "<p class='text-danger'>Nenhum dado recebido do formulário.</p>";
    }
    ?>

    <?php
    if ($confirmando == false) {
      echo "<a href='/pages/animal/remocao.html' class='btn btn-primary'>Nova remoção</a> ";
      echo "<a href='/index.html' class='btn btn-secondary'>Voltar</a>";
    }
    ?>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
