<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="modalClienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formCliente">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="feedbackCliente" class="mb-2"></div>

                    <div class="form-group">
                        <label>Nome do Estabelecimento</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" name="cep" id="cep" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Logradouro</label>
                        <input type="text" name="logradouro" id="logradouro" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" name="numero" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" name="complemento" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>UF</label>
                        <input type="text" name="estado" id="estado" class="form-control" maxlength="2" required>
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Cliente</button>
                </div>
            </div>
        </form>
    </div>
</div>