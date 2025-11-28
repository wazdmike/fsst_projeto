<?php
$paginaEnvio = isset($_GET['pag_pedidos']) ? (int)$_GET['pag_pedidos'] : 1;
if ($paginaEnvio < 1) $paginaEnvio = 1;

$offset = ($paginaEnvio - 1) * $limite;

$stmt = $pdo->prepare("
    SELECT 
        p.id,
        c.nome AS cliente,
        pr.nome AS produto,
        ca.nome AS categoria,
        p.quantidade,
        p.data_pedido
    FROM pedidos p
    LEFT JOIN clientes c   ON p.id_cliente = c.id
    INNER JOIN produtos pr  ON p.id_produto = pr.id
    INNER JOIN categoria ca ON p.id_categoria = ca.id
    ORDER BY p.data_pedido DESC
    LIMIT :limite OFFSET :offset
");

$stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPedidos = $pdo->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();
$total_paginas = ceil($totalPedidos / $limite);
?>

<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Pedidos Realizados</h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php if (count($pedidos) > 0): ?>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido['id'] ?></td>
                            <td>
                                <?= $pedido['cliente'] ? htmlspecialchars($pedido['cliente']) : "<i>Cliente removido</i>" ?>
                            </td>
                            <td><?= htmlspecialchars($pedido['produto']) ?></td>
                            <td><?= htmlspecialchars($pedido['categoria']) ?></td>
                            <td><?= $pedido['quantidade'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></td>
                            <td>
                                <form action="../api/customer/return_product.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="id_pedido" value="<?= $pedido['id'] ?>">
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        Devolver
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Nenhum pedido registrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-end mt-3">
            <ul class="pagination">
                <li class="page-item <?= $paginaEnvio <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?paginaEnvio=<?= $paginaEnvio - 1 ?>">«</a>
                </li>
                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?= $i == $paginaEnvio ? 'active' : '' ?>">
                        <a class="page-link" href="?paginaEnvio=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $paginaEnvio >= $total_paginas ? 'disabled' : '' ?>">
                    <a class="page-link" href="?paginaEnvio=<?= $paginaEnvio + 1 ?>">»</a>
                </li>
            </ul>
        </div>
    </div>
</div>