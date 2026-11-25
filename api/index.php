<?php
// Ponto de entrada único na Vercel.
// O plano gratuito (Hobby) aceita no máximo 12 funções; por isso todas as
// URLs /api/*.php caem aqui (ver "routes" no vercel.json) e o script pedido
// é incluído com require (Aula 23).
$script = basename(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

if ($script != "index.php" && $script != "conexao.php" && file_exists(__DIR__ . "/" . $script)) {
    require __DIR__ . "/" . $script;
} else {
    http_response_code(404);
    echo "Página não encontrada.";
}
?>
