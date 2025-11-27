<div class="card mb-3">
    <div class="card-body">
        <div class="row text-center">

            <!-- Total Produtos -->
            <div class="col-md-4 border-right">
                <h5>Total Produtos</h5>
                <h3><?= count($produtos) ?></h3>
            </div>

            <!-- Pouco Estoque -->
            <div class="col-md-4 border-right">
                <h5>Pouco Estoque</h5>
                <?php
                $stmtLow = $pdo->query("SELECT COUNT(*) FROM produtos WHERE quantidade BETWEEN 1 AND 20");
                $lowStock = $stmtLow->fetchColumn();
                ?>
                <h3><?= $lowStock ?></h3>
            </div>

            <!-- Categorias Registradas -->
            <div class="col-md-4">
                <h5>Categorias Registradas</h5>
                <?php
                $stmtCategorias = $pdo->query("SELECT COUNT(*) FROM categoria");
                $totalCategorias = $stmtCategorias->fetchColumn();
                ?>
                <h3><?= $totalCategorias ?></h3>
            </div>

        </div>
    </div>
</div>