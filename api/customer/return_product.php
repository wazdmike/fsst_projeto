<?php
require '../../conn.php';

if (!isset($_POST['id_pedido'])) {
    die("ID do pedido não encontrado.");
}

$id_pedido = $_POST['id_pedido'];

$stmt = $pdo->prepare("
    SELECT 
        p.id_cliente, 
        p.id_produto, 
        p.quantidade,
        c.nome AS cliente_nome,
        pr.nome AS produto_nome
    FROM pedidos p
    INNER JOIN clientes c ON p.id_cliente = c.id
    INNER JOIN produtos pr ON p.id_produto = pr.id
    WHERE p.id = :id_pedido
");
$stmt->execute([':id_pedido' => $id_pedido]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    die("Pedido não encontrado.");
}

$quantidade      = $pedido['quantidade'];
$cliente_nome    = $pedido['cliente_nome'];
$produto_nome    = $pedido['produto_nome'];
$id_produto      = $pedido['id_produto'];

$update = $pdo->prepare("
    UPDATE produtos
    SET quantidade = quantidade + :quantidade
    WHERE id = :id_produto
");
$update->execute([
    ':quantidade' => $quantidade,
    ':id_produto' => $id_produto
]);

$insert = $pdo->prepare("
    INSERT INTO devolucoes (nome_cliente, nome_produto, quantidade)
    VALUES (:cliente_nome, :produto_nome, :quantidade)
");
$insert->execute([
    ':cliente_nome' => $cliente_nome,
    ':produto_nome' => $produto_nome,
    ':quantidade'   => $quantidade
]);

$delete = $pdo->prepare("DELETE FROM pedidos WHERE id = :id_pedido");
$delete->execute([':id_pedido' => $id_pedido]);

header("Location: ../../app/customer.php?msg=devolvido");
exit;
