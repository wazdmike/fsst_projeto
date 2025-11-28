<?php
require '../../conn.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["erro" => true, "mensagem" => "Método não permitido"]);
    exit;
}
$id_cliente   = $_POST['id_cliente'];
$id_produto   = $_POST['id_produto'];
$quantidade   = $_POST['quantidade'];

$pdo->beginTransaction();

try {
    $stmt = $pdo->prepare("SELECT id_categoria, quantidade FROM produtos WHERE id = ?");
    $stmt->execute([$id_produto]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        throw new Exception("Produto não encontrado.");
    }

    $id_categoria = $produto['id_categoria'];
    $estoque_atual = $produto['quantidade'];

    if ($estoque_atual < $quantidade) {
        throw new Exception("Estoque insuficiente! Só tem $estoque_atual unidades.");
    }

    $stmt = $pdo->prepare("
        INSERT INTO pedidos (id_cliente, id_produto, id_categoria, quantidade)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$id_cliente, $id_produto, $id_categoria, $quantidade]);

    $stmt = $pdo->prepare("
        UPDATE produtos 
        SET quantidade = quantidade - ? 
        WHERE id = ?
    ");
    $stmt->execute([$quantidade, $id_produto]);

    $pdo->commit();

    header("Location: ../../app/customer.php");
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    die("Erro ao enviar produto: " . $e->getMessage());
}
