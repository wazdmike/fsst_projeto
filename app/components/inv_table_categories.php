<div class="card" style="width: 40%;">
    <div class="card-header bg-info text-white">
        <h3 class="card-title">Resumo por Categoria</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Produtos Vinculados</th>
                    <th>Total em Estoque</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($categoriasResumo as $cat): ?>
                    <tr>
                        <td><?= htmlspecialchars($cat['nome']) ?></td>
                        <td><?= $cat['total_produtos'] ?></td>
                        <td><?= $cat['total_estoque'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-end mt-3 mb-2 mr-3">
        <nav>
            <ul class="pagination pagination-sm">

                <li class="page-item <?= $paginaCat <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina_cat=<?= $paginaCat - 1 ?>">«</a>
                </li>

                <?php for ($i = 1; $i <= $totalPaginasCat; $i++): ?>
                    <li class="page-item <?= $i == $paginaCat ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina_cat=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $paginaCat >= $totalPaginasCat ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina_cat=<?= $paginaCat + 1 ?>">»</a>
                </li>

            </ul>
        </nav>
    </div>
</div>