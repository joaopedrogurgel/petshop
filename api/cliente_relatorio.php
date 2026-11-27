<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Relatório de Clientes - Petshop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>

  <?php require("menu.php"); ?>

  <div class="container mt-4">
    <h1>Relatório de Clientes</h1>

    <p>
      <a href="/pages/cliente/cadastro.html">Cadastro</a>
      <a href="/pages/cliente/consulta.html">Consulta</a>
      <a href="/pages/cliente/alteracao.html">Alteração</a>
      <a href="/pages/cliente/remocao.html">Remoção</a>
      <a href="/api/index.php?pagina=cliente_relatorio">Relatório</a>
    </p>

    <p>Lista dos clientes cadastrados:</p>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th>RG</th>
          <th>CPF</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        $tabela = $db->query("select * from cliente");
        $tabela->setFetchMode(PDO::FETCH_OBJ);
        while ($linha = $tabela->fetch()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($linha->nome) . "</td>";
          echo "<td>" . htmlspecialchars($linha->telefone) . "</td>";
          echo "<td>" . htmlspecialchars($linha->email) . "</td>";
          echo "<td>" . htmlspecialchars($linha->rg) . "</td>";
          echo "<td>" . htmlspecialchars($linha->cpf) . "</td>";
          echo "</tr>";
          $total++;
        }
        if ($total == 0) {
          echo "<tr><td colspan='5'>Nenhum cliente cadastrado.</td></tr>";
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">Total: <?php if ($total == 1) echo "1 cliente"; else echo $total . " clientes"; ?></td>
        </tr>
      </tfoot>
    </table>

    <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <?php require("rodape.php"); ?>

</body>
</html>
