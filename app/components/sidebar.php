<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <i class="fas fa-boxes brand-image img-circle elevation-3"></i>
        <span class="brand-text font-weight-light">Inventory Manager</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                <li class="nav-item">
                    <a href="./dashboard.php" class="nav-link <?= $paginaAtual === 'dashboard.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="./inventory.php" class="nav-link <?= $paginaAtual === 'inventory.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Inventory</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="./clientes.php" class="nav-link <?= $paginaAtual === 'clientes.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-shop"></i>
                        <p>Clientes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>