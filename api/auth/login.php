<?php
session_start();
require '../../conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["erro" => true, "mensagem" => "Método não permitido"]);
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['senha'] ?? '');

if ($email === '' || $senha === '') {
    echo json_encode(["erro" => true, "mensagem" => "Preencha todos os campos."]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($senha, $user['senha'])) {

    $_SESSION['usuario'] = [
        "id"    => $user['id'],
        "nome"  => $user['nome'],
        "email" => $user['email']
    ];

    echo json_encode(["erro" => false, "mensagem" => "Login realizado com sucesso!"]);
    exit;
}

echo json_encode(["erro" => true, "mensagem" => "Email ou senha incorretos."]);
exit;
