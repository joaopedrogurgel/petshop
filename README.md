# Software para Gerenciamento de Petshop

Sistema web para gerenciar um petshop, com cadastro de clientes, funcionários, animais e atendimentos.

Trabalho da disciplina de Programação de Sistemas Web (UEM) - Parte 02.

**Link:** https://petshop-ashy-eight.vercel.app

## Integrantes

- Amanda da Silva Palacio - RA 133649
- João Pedro Medeiros Gurgel - RA 145118

## Tecnologias

- HTML
- CSS
- Bootstrap 5.3.3 (via CDN)
- JavaScript (validação dos formulários)
- PHP com PDO
- PostgreSQL (Supabase)
- Hospedagem na Vercel (runtime vercel-php)

## Funcionalidades

Cada entidade (Cliente, Funcionário, Animal e Atendimento) tem:

- Cadastro
- Consulta
- Alteração
- Remoção
- Relatório

Os dados ficam salvos no banco. Não é possível remover um cliente, funcionário ou animal que tenha atendimentos cadastrados.

## Estrutura

- `index.html` e `pages/`: páginas com os formulários
- `css/style.css`: estilos próprios
- `api/index.php`: entrada única do PHP, que inclui o script da página pedida
- `api/conexao.php`: conexão com o banco (dados lidos das variáveis de ambiente)
- `api/criar_tabelas.php`: comandos de criação das tabelas (não fica acessível pelo site)
- `api/*_cadastrar.php`, `*_consulta.php`, `*_alterar.php`, `*_remover.php`, `*_relatorio.php`: operações de cada entidade

## Como executar

Basta acessar o link acima. As instruções de instalação estão em `INFORMACOES.txt`.
