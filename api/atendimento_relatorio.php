<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Relatório de Atendimentos - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Relatório de Atendimentos</h1>

    <p>
      <a href="/api/index.php?pagina=atendimento_cadastro">Cadastro</a>
      <a href="/pages/atendimento/consulta.html">Consulta</a>
      <a href="/pages/atendimento/alteracao.html">Alteração</a>
      <a href="/pages/atendimento/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=atendimento_relatorio">Relatório</a>
    </p>

    <p>Lista dos atendimentos realizados:</p>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Código</th>
          <th>Data</th>
          <th>CPF do cliente</th>
          <th>Animal</th>
          <th>Matrícula do funcionário</th>
          <th>Alterar</th>
          <th>Remover</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        $tabela = $db->query("select * from atendimento");
        $tabela->setFetchMode(PDO::FETCH_OBJ);
        while ($linha = $tabela->fetch()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($linha->codigo) . "</td>";
          echo "<td>" . htmlspecialchars($linha->data) . "</td>";
          echo "<td>" . htmlspecialchars($linha->cpf_cliente) . "</td>";
          echo "<td>" . htmlspecialchars($linha->nome_animal) . "</td>";
          echo "<td>" . htmlspecialchars($linha->matricula_funcionario) . "</td>";
          echo "<td><form action='/api/index.php?pagina=atendimento_alteracao' method='post'>";
          echo "<button type='submit' name='busca' value='" . htmlspecialchars($linha->codigo) . "' class='btn btn-primary btn-sm'>Alterar</button>";
          echo "</form></td>";
          echo "<td><form action='/api/index.php?pagina=atendimento_remover' method='post'>";
          echo "<button type='submit' name='codigo' value='" . htmlspecialchars($linha->codigo) . "' class='btn btn-danger btn-sm'>Remover</button>";
          echo "</form></td>";
          echo "</tr>";
          $total++;
        }
        if ($total == 0) {
          echo "<tr><td colspan='7'>Nenhum atendimento cadastrado.</td></tr>";
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="7">Total: <?php if ($total == 1) echo "1 atendimento"; else echo $total . " atendimentos"; ?></td>
        </tr>
      </tfoot>
    </table>

    <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
