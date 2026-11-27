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

  <nav class="navbar navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="/index.html">Petshop</a>
      <a class="nav-link text-white" href="/index.html">Início</a>
      <a class="nav-link text-white" href="/pages/cliente/cadastro.html">Clientes</a>
      <a class="nav-link text-white" href="/pages/funcionario/cadastro.html">Funcionários</a>
      <a class="nav-link text-white" href="/pages/animal/cadastro.html">Animais</a>
      <a class="nav-link text-white" href="/api/index.php?pagina=atendimento_cadastro">Atendimentos</a>
    </div>
  </nav>

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
          <td colspan="5">Total: <?php echo $total; ?> clientes</td>
        </tr>
      </tfoot>
    </table>

    <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <footer class="text-center mt-5">
    <p>Programação de Sistemas Web - Software para Gerenciamento de Petshop</p>
  </footer>

</body>
</html>
