<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Relatório de Animais - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Relatório de Animais</h1>

    <p>
      <a href="/pages/animal/cadastro.html">Cadastro</a>
      <a href="/pages/animal/consulta.html">Consulta</a>
      <a href="/pages/animal/alteracao.html">Alteração</a>
      <a href="/pages/animal/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=animal_relatorio">Relatório</a>
    </p>

    <p>Lista dos animais cadastrados:</p>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Peso (kg)</th>
          <th>Altura (cm)</th>
          <th>Alterar</th>
          <th>Remover</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        $tabela = $db->query("select * from animal");
        $tabela->setFetchMode(PDO::FETCH_OBJ);
        while ($linha = $tabela->fetch()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($linha->nome) . "</td>";
          echo "<td>" . htmlspecialchars($linha->peso) . "</td>";
          echo "<td>" . htmlspecialchars($linha->altura) . "</td>";
          echo "<td><form action='/api/index.php?pagina=animal_alteracao' method='post'>";
          echo "<button type='submit' name='busca' value='" . htmlspecialchars($linha->nome) . "' class='btn btn-primary btn-sm'>Alterar</button>";
          echo "</form></td>";
          echo "<td><form action='/api/index.php?pagina=animal_remover' method='post'>";
          echo "<button type='submit' name='nome' value='" . htmlspecialchars($linha->nome) . "' class='btn btn-danger btn-sm'>Remover</button>";
          echo "</form></td>";
          echo "</tr>";
          $total++;
        }
        if ($total == 0) {
          echo "<tr><td colspan='5'>Nenhum animal cadastrado.</td></tr>";
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">Total: <?php if ($total == 1) echo "1 animal"; else echo $total . " animais"; ?></td>
        </tr>
      </tfoot>
    </table>

    <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
