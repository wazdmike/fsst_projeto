<?php
session_start(); // garante que session está ativa, se necessário
require '../../conn.php';

header('Content-Type: application/json');

// Permitir apenas POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["erro" => true, "mensagem" => "Método não permitido"]);
    exit;
}

// Recebendo dados
$id           = (int)($_POST['id'] ?? 0);
$nome         = trim($_POST['nome'] ?? '');
$email        = trim($_POST['email'] ?? '');
$telefone     = trim($_POST['telefone'] ?? '');
$cep          = trim($_POST['cep'] ?? '');
$logradouro   = trim($_POST['logradouro'] ?? '');
$numero       = trim($_POST['numero'] ?? '');
$complemento  = trim($_POST['complemento'] ?? '');
$bairro       = trim($_POST['bairro'] ?? '');
$cidade       = trim($_POST['cidade'] ?? '');
$estado       = trim($_POST['estado'] ?? '');

if (!$id || !$nome || !$cep || !$estado) {
    echo json_encode(["erro" => true, "mensagem" => "Preencha todos os campos obrigatórios."]);
    exit;
}

$stmt = $pdo->prepare("
    UPDATE clientes SET
        nome = ?, email = ?, telefone = ?, cep = ?, logradouro = ?, numero = ?,
        complemento = ?, bairro = ?, cidade = ?, estado = ?
    WHERE id = ?
");

$sucesso = $stmt->execute([
    $nome,
    $email,
    $telefone,
    $cep,
    $logradouro,
    $numero,
    $complemento,
    $bairro,
    $cidade,
    $estado,
    $id
]);

if ($sucesso) {
    echo json_encode(["erro" => false, "mensagem" => "Cliente atualizado com sucesso!"]);
} else {
    echo json_encode(["erro" => true, "mensagem" => "Erro ao atualizar cliente."]);
}
exit;
