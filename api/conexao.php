<?php
// Conexão com o banco (slide Aula 24 - PDO).
// Os dados vêm das variáveis de ambiente cadastradas na Vercel (ver INFORMACOES.txt).
$db = new PDO("pgsql:host=" . getenv("DB_HOST") . ";port=" . getenv("DB_PORTA") . ";dbname=" . getenv("DB_NOME"),
              getenv("DB_USUARIO"), getenv("DB_SENHA"));
?>
