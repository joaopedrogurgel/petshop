<?php
// Entrada única do sistema na Vercel.
// O plano gratuito (Hobby) aceita no máximo 12 funções; por isso só este
// arquivo é uma função (ver vercel.json). Cada link e cada formulário informa
// a página desejada em "pagina" ($_REQUEST, Aula 22) e o script
// correspondente é incluído com require (Aula 23).
if (isset($_REQUEST["pagina"])) {
    $pagina = $_REQUEST["pagina"];
} else {
    $pagina = "";
}

// Os case sem break caem todos no mesmo require (switch, Aula 20).
switch ($pagina) {
    case "cliente_cadastrar":
    case "cliente_consulta":
    case "cliente_alteracao":
    case "cliente_alterar":
    case "cliente_remover":
    case "cliente_relatorio":
    case "funcionario_cadastrar":
    case "funcionario_consulta":
    case "funcionario_alteracao":
    case "funcionario_alterar":
    case "funcionario_remover":
    case "funcionario_relatorio":
    case "animal_cadastrar":
    case "animal_consulta":
    case "animal_alteracao":
    case "animal_alterar":
    case "animal_remover":
    case "animal_relatorio":
    case "atendimento_cadastro":
    case "atendimento_cadastrar":
    case "atendimento_consulta":
    case "atendimento_alteracao":
    case "atendimento_alterar":
    case "atendimento_remover":
    case "atendimento_relatorio":
        require($pagina . ".php");
        break;
    default:
        echo "Página não encontrada.";
}
?>
