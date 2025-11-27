<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php
            if ($paginaAtual === 'dashboard.php') {
                echo 'Dashboard';
            } elseif ($paginaAtual === 'inventory.php') {
                echo 'Estoque';
            } else {
                echo 'Clientes';
            }
            ?>
        - Inventory Manager</title>

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="../../assets/style/dashboard.css">
</head>