<div class="modal fade" id="modalCategoria" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Criar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome da Categoria</label>
                        <input type="text" name="nova_categoria" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="criar_categoria" class="btn btn-primary">Salvar</button>
                </div>
            </form>

        </div>
    </div>
</div>