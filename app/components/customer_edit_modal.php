<?php foreach ($clientes as $cliente):
    $id           = $cliente['id'] ?? '';
    $nome         = $cliente['nome'] ?? '';
    $email        = $cliente['email'] ?? '';
    $telefone     = $cliente['telefone'] ?? '';
    $cep          = $cliente['cep'] ?? '';
    $logradouro   = $cliente['logradouro'] ?? '';
    $numero       = $cliente['numero'] ?? '';
    $complemento  = $cliente['complemento'] ?? '';
    $bairro       = $cliente['bairro'] ?? '';
    $cidade       = $cliente['cidade'] ?? '';
    $estado       = $cliente['estado'] ?? '';
?>
    <div class="modal fade" id="modalEditar<?= $id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form class="modal-content" id="editarClienteForm<?= $id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id, ENT_QUOTES) ?>">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($nome, ENT_QUOTES) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email, ENT_QUOTES) ?>">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($telefone, ENT_QUOTES) ?>">
                    </div>
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" name="cep" class="form-control" value="<?= htmlspecialchars($cep, ENT_QUOTES) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Logradouro</label>
                        <input type="text" name="logradouro" class="form-control" value="<?= htmlspecialchars($logradouro, ENT_QUOTES) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" name="numero" class="form-control" value="<?= htmlspecialchars($numero, ENT_QUOTES) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" name="complemento" class="form-control" value="<?= htmlspecialchars($complemento, ENT_QUOTES) ?>">
                    </div>
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" name="bairro" class="form-control" value="<?= htmlspecialchars($bairro, ENT_QUOTES) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" name="cidade" class="form-control" value="<?= htmlspecialchars($cidade, ENT_QUOTES) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Estado (UF)</label>
                        <input type="text" name="estado" class="form-control" value="<?= htmlspecialchars($estado, ENT_QUOTES) ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelector("#editarClienteForm<?= $id ?>").addEventListener("submit", async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            try {
                const response = await fetch("../api/customer/update.php", {
                    method: "POST",
                    body: formData
                });

                const res = await response.json();

                if (!res.erro) {
                    alert("Cliente atualizado com sucesso!");
                    $('#modalEditar<?= $id ?>').modal('hide');
                    location.reload();
                } else {
                    alert("Erro: " + res.mensagem);
                }
            } catch (error) {
                alert("Erro inesperado: " + error);
            }
        });
    </script>
<?php endforeach; ?>