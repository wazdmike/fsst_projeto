<?php
require '../../conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["erro" => true, "mensagem" => "Método não permitido"]);
    exit;
}

$nome  = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['senha'] ?? '');

if ($nome === '' || $email === '' || $senha === '') {
    echo json_encode(["erro" => true, "mensagem" => "Preencha todos os campos."]);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["erro" => true, "mensagem" => "Email já cadastrado."]);
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senhaHash]);

    echo json_encode([
        "erro" => false,
        "mensagem" => "Usuário cadastrado com sucesso!"
    ]);
} catch (Exception $e) {
    echo json_encode([
        "erro" => true,
        "mensagem" => "Erro ao cadastrar usuário."
    ]);
}

exit;
