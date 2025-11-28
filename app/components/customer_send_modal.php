<!-- Modal Enviar Produto -->
<div class="modal fade" id="modalEnviar<?= $cliente['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalEnviarLabel<?= $cliente['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../api/customer/send.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEnviarLabel<?= $cliente['id'] ?>">Enviar Produto para <?= htmlspecialchars($cliente['nome']) ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_cliente" value="<?= $cliente['id'] ?>">

                    <div class="form-group">
                        <label for="produto">Produto</label>
                        <select name="id_produto" class="form-control" required>
                            <?php foreach ($produtos as $produto): ?>
                                <option value="<?= $produto['id'] ?>"><?= htmlspecialchars($produto['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" name="quantidade" class="form-control" min="1" value="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>