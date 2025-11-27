<div class="tab-pane fade" id="register" role="tabpanel">
    <form action="" method="POST" id="registerForm">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="nome" class="form-control" placeholder="Nome completo" required>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
        </div>

        <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
    </form>

    <div id="registerFeedback" class="mt-3 text-center"></div>

</div>

<script>
    document.querySelector("#registerForm").addEventListener("submit", async (e) => {
        e.preventDefault();

        const form = new FormData(e.target);

        const req = await fetch("../api/auth/register.php", {
            method: "POST",
            body: form
        });

        const res = await req.json();

        const box = document.querySelector("#registerFeedback");

        if (!res.erro) {
            box.innerHTML = `<div class="alert alert-success">${res.mensagem}</div>`;

            setTimeout(() => {
                document.querySelector('[href="#login"]').click();
            }, 800);

        } else {
            box.innerHTML = `<div class="alert alert-danger">${res.mensagem}</div>`;
        }
    });
</script>