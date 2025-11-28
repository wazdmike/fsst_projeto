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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($clientes) > 0): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['nome']) ?></td>
                            <td>
                                <?= htmlspecialchars($cliente['logradouro']) ?>, <?= htmlspecialchars($cliente['numero']) ?>
                                <?= $cliente['complemento'] ? '- ' . htmlspecialchars($cliente['complemento']) : '' ?>
                            </td>
                            <td><?= htmlspecialchars($cliente['cidade']) ?>/<?= htmlspecialchars($cliente['estado']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($cliente['criado_em'])) ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditar<?= $cliente['id'] ?>">Editar</button>
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEnviar<?= $cliente['id'] ?>">Enviar</button>
                                <a href="?excluir=<?= $cliente['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir este cliente?')">Remover</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Nenhum cliente registrado.</td>
                    </tr>
                <?php endif; ?>
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

<!-- Modais -->
<?php foreach ($clientes as $cliente): ?>
    <?php include 'components/customer_edit_modal.php'; ?>
    <?php include 'components/customer_send_modal.php'; ?>
<?php endforeach; ?>