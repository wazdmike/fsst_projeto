<div class="tab-pane fade show active" id="login" role="tabpanel">
    <form action="" method="POST" id="loginForm">
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

        <button type="submit" class="btn btn-primary btn-block">Acessar Sistema</button>
    </form>

    <div id="feedback" class="mt-3 text-center"></div>

</div>
<script>
    document.querySelector("#loginForm").addEventListener("submit", async (e) => {
        e.preventDefault();

        const form = new FormData(e.target);

        const req = await fetch("../api/auth/login.php", {
            method: "POST",
            body: form
        });

        const res = await req.json();

        const box = document.querySelector("#feedback");

        if (!res.erro) {
            box.innerHTML = `<div class="alert alert-success">${res.mensagem}</div>`;
            setTimeout(() => {
                window.location.href = "../app/dashboard.php"; // caminho correto
            }, 500);
        } else {
            box.innerHTML = `<div class="alert alert-danger">${res.mensagem}</div>`;
        }
    });
</script>