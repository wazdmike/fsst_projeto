<?php
session_start();
require '../conn.php';
$paginaAtual = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['usuario'])) {
    header("Location: ../auth/login.php");
    exit;
}

$limite = 5;
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
if ($pagina < 1) $pagina = 1;
$offset = ($pagina - 1) * $limite;

$stmt = $pdo->prepare("
    SELECT id, nome, email, telefone, cep, logradouro, numero, complemento, bairro, cidade, estado, criado_em
    FROM clientes
    ORDER BY criado_em DESC
    LIMIT :limite OFFSET :offset
");
$stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();
$totalPaginas = ceil($total / $limite);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<?php include 'components/header.php' ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'components/navbar.php' ?>
        <!-- Sidebar -->
        <?php include 'components/sidebar.php' ?>
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content pt-3">
                <div class="container-fluid">
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalCliente">
                            Adicionar Cliente
                        </button>
                    </div>
                    <?php include 'components/add_customer_modal.php'; ?>
                    <!-- Tabela -->
                    <?php include 'components/customers_table.php'; ?>
                </div>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- Usei o viaCep para puxar os endereços -->
    <script>
        $(document).ready(function() {

            $("#cep").on("blur", function() {
                let cep = $(this).val().replace(/\D/g, '');
                if (cep.length === 8) {
                    $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                        if (!("erro" in data)) {
                            $("#logradouro").val(data.logradouro);
                            $("#bairro").val(data.bairro);
                            $("#cidade").val(data.localidade);
                            $("#estado").val(data.uf);
                        } else {
                            alert("CEP não encontrado!");
                        }
                    });
                }
            });

            $("#formCliente").submit(async function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                const res = await fetch("../api/customer/create.php", {
                    method: "POST",
                    body: formData
                });

                const data = await res.json();
                let box = $("#feedbackCliente");

                if (!data.erro) {
                    box.html(`<div class="alert alert-success">${data.mensagem}</div>`);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    box.html(`<div class="alert alert-danger">${data.mensagem}</div>`);
                }
            });
        });
    </script>
</body>

</html>