<div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Preço de Venda</th>
                    <th>Quantidade</th>
                    <th>Disponibilidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto):
                    $status = $produto['quantidade'] > 20 ? 'Disponível' : ($produto['quantidade'] > 0 ? 'Pouco Estoque' : 'Esgotado');
                    $badge = $produto['quantidade'] > 20 ? 'bg-success' : ($produto['quantidade'] > 0 ? 'bg-warning' : 'bg-danger');
                ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td><?= htmlspecialchars($produto['categoria_nome']) ?></td>
                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td><?= $produto['quantidade'] ?></td>
                        <td><span class="badge <?= $badge ?>"><?= $status ?></span></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditar<?= $produto['id'] ?>">Editar</button>
                            <a href="?excluir=<?= $produto['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir este produto?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include 'components/inv_edit_modal.php'; ?>
    </div>
    <!-- PAGINAÇÃO -->
    <div class="d-flex justify-content-end mt-3 mb-2 mr-3">
        <nav>
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
        </nav>
    </div>
</div>