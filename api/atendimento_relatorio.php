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
    <h1>Relatório de Atendimentos</h1>

    <p>
      <a href="/api/atendimento_cadastro.php">Cadastro</a>
      <a href="/pages/atendimento/consulta.html">Consulta</a>
      <a href="/pages/atendimento/alteracao.html">Alteração</a>
      <a href="/pages/atendimento/remocao.html">Remoção</a>
      <a href="/api/atendimento_relatorio.php">Relatório</a>
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
          echo "</tr>";
          $total++;
        }
        ?>
      </tbody>
    </table>

    <p>Total: <?php echo $total; ?> atendimentos</p>

    <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
    <a href="/index.html" class="btn btn-secondary">Voltar</a>
  </div>

  <footer class="text-center mt-5">
    <p>Programação de Sistemas Web - Software para Gerenciamento de Petshop</p>
  </footer>

</body>
</html>
