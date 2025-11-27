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

                    <!-- Melhor Categoria por Venda -->
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title">Melhor Categoria por Venda</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Vendas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bebidas</td>
                                        <td>2,340</td>
                                    </tr>
                                    <tr>
                                        <td>Salgados</td>
                                        <td>1,780</td>
                                    </tr>
                                    <tr>
                                        <td>Fast Foods</td>
                                        <td>1,560</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Melhor Produto por Venda -->
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title">Melhor Produto por Venda</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>ID do Produto</th>
                                        <th>Categoria</th>
                                        <th>Quantidade Restante</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Coca-Cola</td>
                                        <td>PRD001</td>
                                        <td>Bebidas</td>
                                        <td>230</td>
                                    </tr>
                                    <tr>
                                        <td>Hambúrguer</td>
                                        <td>PRD002</td>
                                        <td>Fast Food</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Pão de Queijo</td>
                                        <td>PRD003</td>
                                        <td>Salgados</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Suco Natural</td>
                                        <td>PRD004</td>
                                        <td>Bebidas</td>
                                        <td>85</td>
                                    </tr>
                                    <tr>
                                        <td>Pizza Slice</td>
                                        <td>PRD005</td>
                                        <td>Fast Food</td>
                                        <td>45</td>
                                    </tr>
                                    <tr>
                                        <td>Pastel</td>
                                        <td>PRD006</td>
                                        <td>Salgados</td>
                                        <td>60</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Gráfico de vendas -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Vendas por Mês</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart.js Script -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        var ctx = document.getElementById('salesChart').getContext('2d');
                        var salesChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
                                datasets: [{
                                    label: 'Vendas',
                                    data: [1200, 1500, 1700, 1400, 1900, 2100],
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderWidth: 2,
                                    fill: true,
                                    tension: 0.3, // suaviza a linha
                                    pointBackgroundColor: 'rgba(54, 162, 235, 1)'
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>


                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>