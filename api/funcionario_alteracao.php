<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alterar Funcionário - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Alterar Funcionário</h1>

    <p>
      <a href="/pages/funcionario/cadastro.html">Cadastro</a>
      <a href="/pages/funcionario/consulta.html">Consulta</a>
      <a href="/pages/funcionario/alteracao.html">Alteração</a>
      <a href="/pages/funcionario/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=funcionario_relatorio">Relatório</a>
    </p>

    <?php
    if (isset($_GET["busca"])) {
      $sql = $db->prepare("select * from funcionario where matricula = ?");
      $sql->execute(array($_GET["busca"]));
      $sql->setFetchMode(PDO::FETCH_OBJ);
      if ($linha = $sql->fetch()) {
        echo "<form action='/api/index.php' method='post' onsubmit='return validarFuncionario()'>";
        echo "<div class='mb-3'>";
        echo "<label for='matricula' class='form-label'>Matrícula</label>";
        echo "<input type='text' class='form-control' id='matricula' name='matricula' value='" . htmlspecialchars($linha->matricula) . "' readonly>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='nome' class='form-label'>Nome</label>";
        echo "<input type='text' class='form-control' id='nome' name='nome' value='" . htmlspecialchars($linha->nome) . "' required>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='qualificacao' class='form-label'>Qualificação</label>";
        echo "<input type='text' class='form-control' id='qualificacao' name='qualificacao' value='" . htmlspecialchars($linha->qualificacao) . "' required>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='descricao' class='form-label'>Descrição da função</label>";
        echo "<textarea class='form-control' id='descricao' name='descricao' rows='3' required>" . htmlspecialchars($linha->descricao) . "</textarea>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='carga' class='form-label'>Carga horária semanal (h)</label>";
        echo "<input type='number' class='form-control' id='carga' name='carga' min='1' max='44' value='" . htmlspecialchars($linha->carga_horaria) . "' required>";
        echo "</div>";
        echo "<button type='submit' name='pagina' value='funcionario_alterar' class='btn btn-primary'>Salvar</button> ";
        echo "<a href='/pages/funcionario/alteracao.html' class='btn btn-secondary'>Voltar</a>";
        echo "</form>";
      }
      else {
        echo "<p class='text-danger'>Nenhum funcionário encontrado com a matrícula " . htmlspecialchars($_GET["busca"]) . ".</p>";
        echo "<a href='/pages/funcionario/alteracao.html' class='btn btn-secondary'>Voltar</a>";
      }
    }
    else {
      echo "<p class='text-danger'>Informe a matrícula na página de alteração.</p>";
    }
    ?>
  </div>

  <?php require("rodape.php"); ?>

  <script>
    function validarFuncionario() {
      var carga = document.getElementById("carga").value;

      if (carga < 1 || carga > 44) {
        alert("A carga horária semanal deve ser de 1 a 44 horas!");
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
