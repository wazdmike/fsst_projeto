<?php require '../conn.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../auth/login.php");
    exit;
}

$stmtTotal = $pdo->query("SELECT SUM(quantidade) AS total_estoque FROM produtos");
$totalEstoque = $stmtTotal->fetchColumn();

$stmtPouco = $pdo->query("SELECT COUNT(*) AS produtos_pouco FROM produtos WHERE quantidade BETWEEN 1 AND 20");
$produtosPouco = $stmtPouco->fetchColumn();

$stmt = $pdo->query("
    SELECT c.nome AS categoria, SUM(p.quantidade) AS total
    FROM produtos p
    LEFT JOIN categoria c ON p.id_categoria = c.id
    GROUP BY c.nome
");

$stmtCategorias = $pdo->query("SELECT COUNT(*) FROM categoria");
$totalCategorias = $stmtCategorias->fetchColumn();

$categorias = [];
$quantidades = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $categorias[] = $row['categoria'];
    $quantidades[] = $row['total'];
}   

?>

<!DOCTYPE html>
<html lang="pt-BR">

<?php include 'components/header.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'components/navbar.php' ?>

        <!-- Sidebar -->
        <?php include 'components/sidebar.php' ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Produtos em Estoque -->
                        <?php include 'components/dashboard_summary_cards.php' ?>
                    </div>

                    <!-- Gráfico Pizza + Tabela -->
                    <?php include 'components/pie_chart.php' ?>

                </div>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>