<?php foreach ($produtos as $produto): ?>
    <div class="modal fade" id="modalEditar<?= $produto['id'] ?>" tabindex="-1"
        role="dialog" aria-labelledby="modalEditarLabel<?= $produto['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel<?= $produto['id'] ?>">Editar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                    <input type="hidden" name="editar_produto" value="1">
                    <div class="form-group">
                        <label>Categoria</label>
                        <select name="categoria" class="form-control" required>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nome do Produto</label>
                        <input type="text" name="nome" class="form-control"
                            value="<?= htmlspecialchars($produto['nome']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Quantidade</label>
                        <input type="number" name="quantidade" class="form-control"
                            value="<?= $produto['quantidade'] ?>" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>Preço de Venda</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" name="preco" class="form-control preco-edit"
                                value="<?= number_format($produto['preco'], 2, ',', '.') ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<script>
    function formatarMoedaReal(input) {
        let valor = input.value.replace(/\D/g, "");
        valor = (valor / 100).toFixed(2) + "";
        valor = valor.replace(".", ",");
        valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        input.value = valor;
    }

    document.querySelectorAll('.preco-edit, #preco').forEach(function(input) {
        input.addEventListener('input', function() {
            formatarMoedaReal(this);
        });
    });
</script>