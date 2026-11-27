<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar Animal - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Alterar Animal</h1>

    <p>
      <a href="/pages/animal/cadastro.html">Cadastro</a>
      <a href="/pages/animal/consulta.html">Consulta</a>
      <a href="/pages/animal/alteracao.html">Alteração</a>
      <a href="/pages/animal/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=animal_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_REQUEST["busca"])) {
      $sql = $db->prepare("select * from animal where nome = ?");
      $sql->execute(array($_REQUEST["busca"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        echo "<form action='/api/index.php' method='post' onsubmit='return validarAnimal()'>";
        echo "<div class='mb-3'>";
        echo "<label for='nome' class='form-label'>Nome</label>";
        echo "<input type='text' class='form-control' id='nome' name='nome' value='" . htmlspecialchars($linha->nome) . "' readonly>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='peso' class='form-label'>Peso (kg)</label>";
        echo "<input type='number' class='form-control' id='peso' name='peso' step='0.01' min='0.01' value='" . htmlspecialchars($linha->peso) . "' required>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='altura' class='form-label'>Altura (cm)</label>";
        echo "<input type='number' class='form-control' id='altura' name='altura' step='0.01' min='0.01' value='" . htmlspecialchars($linha->altura) . "' required>";
        echo "</div>";
        echo "<button type='submit' name='pagina' value='animal_alterar' class='btn btn-primary'>Salvar</button> ";
        echo "<a href='/pages/animal/alteracao.html' class='btn btn-secondary'>Voltar</a>";
        echo "</form>";
      }
      else {
        echo "<p class='text-danger'>Nenhum animal encontrado com o nome " . htmlspecialchars($_REQUEST["busca"]) . ".</p>";
        echo "<a href='/pages/animal/alteracao.html' class='btn btn-secondary'>Voltar</a>";
      }
    }
    else {
      echo "<p class='text-danger'>Informe o nome na página de alteração.</p>";
    }
    ?>
  </div>

  <?php require("rodape.php"); ?>

  <script>
    function validarAnimal() {
      var peso = document.getElementById("peso").value;
      var altura = document.getElementById("altura").value;

      if (peso <= 0 || altura <= 0) {
        alert("O peso e a altura devem ser maiores que zero!");
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
