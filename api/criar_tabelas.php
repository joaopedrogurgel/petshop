<?php
header('Content-Type: text/html; charset=utf-8');
require_once("conexao.php");

$res = $db->query("create table cliente(
  cpf char(11) primary key not null,
  nome varchar(100) not null,
  telefone varchar(20) not null,
  email varchar(100) not null,
  rg varchar(20) not null)");
if ($res)
  echo "Criação tabela cliente: OK <br>";
else
  echo "Criação tabela cliente: falha <br>";

$res = $db->query("create table funcionario(
  matricula varchar(20) primary key not null,
  nome varchar(100) not null,
  qualificacao varchar(100) not null,
  descricao varchar(255) not null,
  carga_horaria int not null)");
if ($res)
  echo "Criação tabela funcionario: OK <br>";
else
  echo "Criação tabela funcionario: falha <br>";

$res = $db->query("create table animal(
  nome varchar(100) primary key not null,
  peso decimal(6,2) not null,
  altura decimal(6,2) not null)");
if ($res)
  echo "Criação tabela animal: OK <br>";
else
  echo "Criação tabela animal: falha <br>";

$res = $db->query("create table atendimento(
  codigo char(4) primary key not null,
  data date not null,
  cpf_cliente char(11) not null,
  nome_animal varchar(100) not null,
  matricula_funcionario varchar(20) not null,
  foreign key(cpf_cliente) references cliente(cpf),
  foreign key(nome_animal) references animal(nome),
  foreign key(matricula_funcionario) references funcionario(matricula))");
if ($res)
  echo "Criação tabela atendimento: OK <br>";
else
  echo "Criação tabela atendimento: falha <br>";
?>
