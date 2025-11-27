<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">
                <?php
                if ($paginaAtual === 'dashboard.php'){
                    echo 'Dashboard';
                }elseif($paginaAtual === 'inventory.php'){
                    echo 'Estoque';
                } else {
                    echo 'Clientes';
                }
                ?>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</nav>