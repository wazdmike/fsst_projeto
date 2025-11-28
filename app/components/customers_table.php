<div class="card">
    <div class="card-header bg-info text-white">
        <h3 class="card-title">Clientes</h3>
    </div>
    <div class="px-1 table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Cidade/UF</th>
                    <th>Adicionado em</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['nome']) ?></td>
                        <td>
                            <?= htmlspecialchars($cliente['logradouro']) ?>, <?= htmlspecialchars($cliente['numero']) ?>
                            <?= $cliente['complemento'] ? '- ' . htmlspecialchars($cliente['complemento']) : '' ?>
                        </td>
                        <td><?= htmlspecialchars($cliente['cidade']) ?>/<?= htmlspecialchars($cliente['estado']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($cliente['criado_em'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="d-flex justify-content-end mt-3">
            <ul class="pagination">
                <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $pagina - 1 ?>">«</a>
                </li>
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $pagina + 1 ?>">»</a>
                </li>
            </ul>
        </div>
    </div>
</div>