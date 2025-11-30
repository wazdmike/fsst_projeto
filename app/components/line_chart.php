<?php
require '../conn.php';

$sqlPedidos = $pdo->query("
    SELECT MONTH(data_pedido) AS mes, SUM(quantidade) AS total
    FROM pedidos
    GROUP BY MONTH(data_pedido)
    ORDER BY MONTH(data_pedido)
");

$pedidosMes = array_fill(1, 12, 0);

while ($row = $sqlPedidos->fetch(PDO::FETCH_ASSOC)) {
    $pedidosMes[(int)$row['mes']] = (int)$row['total'];
}

$sqlDevolucoes = $pdo->query("
    SELECT MONTH(data_devolucao) AS mes, SUM(quantidade) AS total
    FROM devolucoes
    GROUP BY MONTH(data_devolucao)
    ORDER BY MONTH(data_devolucao)
");

$devolucoesMes = array_fill(1, 12, 0);

while ($row = $sqlDevolucoes->fetch(PDO::FETCH_ASSOC)) {
    $devolucoesMes[(int)$row['mes']] = (int)$row['total'];
}

$meses = [
    1 => "Jan",
    2 => "Fev",
    3 => "Mar",
    4 => "Abr",
    5 => "Mai",
    6 => "Jun",
    7 => "Jul",
    8 => "Ago",
    9 => "Set",
    10 => "Out",
    11 => "Nov",
    12 => "Dez"
];
?>

<div class="col-md-6 col-12">
    <div class="card card-info" style="width: 780px;">
        <div class="card-header">
            <h3 class="card-title">Pedidos x Devoluções (Mensal)</h3>
        </div>
        <div class="card-body">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode(array_values($meses)) ?>,
            datasets: [{
                    label: 'Pedidos',
                    data: <?= json_encode(array_values($pedidosMes)) ?>,
                    borderColor: 'blue',
                    borderWidth: 2,
                    tension: 0.2
                },
                {
                    label: 'Devoluções',
                    data: <?= json_encode(array_values($devolucoesMes)) ?>,
                    borderColor: 'red',
                    borderWidth: 2,
                    tension: 0.2
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>