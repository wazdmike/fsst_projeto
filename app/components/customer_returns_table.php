<?php
$limite = 5;

$pagina_dev = isset($_GET['pag_dev']) ? (int)$_GET['pag_dev'] : 1;
if ($pagina_dev < 1) $pagina_dev = 1;

$offset = ($pagina_dev - 1) * $limite;

$stmt = $pdo->prepare("
    SELECT 
        id,
        nome_cliente,
        nome_produto,
        quantidade,
        data_devolucao
    FROM devolucoes
    ORDER BY data_devolucao DESC
    LIMIT :limite OFFSET :offset
");

$stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$devolucoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totaldev = $pdo->query("SELECT COUNT(*) FROM devolucoes")->fetchColumn();
$total_paginasdev = ceil($totaldev / $limite);
?>


<div class="card mt-4">
    <div class="card-header bg-warning text-dark">
        <h3 class="card-title">Devoluções</h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>
                <?php if (count($devolucoes) > 0): ?>
                    <?php foreach ($devolucoes as $dev): ?>
                        <tr>
                            <td><?= $dev['id'] ?></td>
                            <td><?= htmlspecialchars($dev['nome_cliente']) ?></td>
                            <td><?= htmlspecialchars($dev['nome_produto']) ?></td>
                            <td><?= $dev['quantidade'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($dev['data_devolucao'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma devolução registrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- PAGINAÇÃO -->
        <div class="d-flex justify-content-end mt-3">
            <ul class="pagination">
                <li class="page-item <?= $pagd <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina_dev=<?= $pagina_dev - 1 ?>">«</a>
                </li>
                <?php for ($i = 1; $i <= $total_paginasdev; $i++): ?>
                    <li class="page-item <?= $i == $pagina_dev ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina_dev=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $pagina_dev >= $total_paginasdev ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina_dev=<?= $pagina_dev + 1 ?>">»</a>
                </li>
            </ul>
        </div>
    </div>
</div>