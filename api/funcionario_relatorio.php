<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Relatório de Funcionários - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Relatório de Funcionários</h1>

    <p>
      <a href="/pages/funcionario/cadastro.html">Cadastro</a>
      <a href="/pages/funcionario/consulta.html">Consulta</a>
      <a href="/pages/funcionario/alteracao.html">Alteração</a>
      <a href="/pages/funcionario/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=funcionario_relatorio">Relatório</a>
    </p>

    <p>Lista dos funcionários cadastrados:</p>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Matrícula</th>
          <th>Qualificação</th>
          <th>Descrição da função</th>
          <th>Carga horária (h)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        $tabela = $db->query("select * from funcionario");
        $tabela->setFetchMode(PDO::FETCH_OBJ);
        while ($linha = $tabela->fetch()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($linha->nome) . "</td>";
          echo "<td>" . htmlspecialchars($linha->matricula) . "</td>";
          echo "<td>" . htmlspecialchars($linha->qualificacao) . "</td>";
          echo "<td>" . htmlspecialchars($linha->descricao) . "</td>";
          echo "<td>" . htmlspecialchars($linha->carga_horaria) . "</td>";
          echo "</tr>";
          $total++;
        }
        if ($total == 0) {
          echo "<tr><td colspan='5'>Nenhum funcionário cadastrado.</td></tr>";
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">Total: <?php if ($total == 1) echo "1 funcionário"; else echo $total . " funcionários"; ?></td>
        </tr>
      </tfoot>
    </table>

    <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
