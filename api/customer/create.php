<?php
session_start();
require '../../conn.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["erro" => true, "mensagem" => "Método não permitido"]);
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$cep = trim($_POST['cep'] ?? '');
$logradouro = trim($_POST['logradouro'] ?? '');
$numero = trim($_POST['numero'] ?? '');
$complemento = trim($_POST['complemento'] ?? '');
$bairro = trim($_POST['bairro'] ?? '');
$cidade = trim($_POST['cidade'] ?? '');
$estado = trim($_POST['estado'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$email = trim($_POST['email'] ?? '');

if (!$nome || !$cep || !$logradouro || !$numero || !$bairro || !$cidade || !$estado) {
    echo json_encode(["erro" => true, "mensagem" => "Preencha todos os campos obrigatórios."]);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO clientes 
(nome, cep, logradouro, numero, complemento, bairro, cidade, estado, telefone, email) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$nome, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $estado, $telefone, $email]);

echo json_encode(["erro" => false, "mensagem" => "Cliente cadastrado com sucesso!"]);
