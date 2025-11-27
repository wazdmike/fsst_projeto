<div class="row">
    <div class="col-md-6">
        <div class="card card-info" style="width: 400px; height: 460px;">
            <div class="card-header">
                <h3 class="card-title">Produtos por Categoria</h3>
            </div>
            <div class="card-body">
                <canvas id="categoryPieChart"></canvas>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('categoryPieChart').getContext('2d');

    const categorias = <?= json_encode($categorias) ?>;
    const quantidades = <?= json_encode($quantidades) ?>;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: categorias,
            datasets: [{
                data: quantidades,
                backgroundColor: [
                    '#17a2b8',
                    '#ffc107',
                    '#28a745',
                    '#dc3545',
                    '#6c757d',
                    '#6610f2',
                    '#fd7e14'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>