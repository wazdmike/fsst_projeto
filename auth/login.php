<!DOCTYPE html>
<html lang="pt-BR">
<?php include 'components/header.php' ?>

<body>

  <div class="login-box" style="width: 400px;">
    <div class="card">
      <div class="card-header">
        <img src="../assets/images/logo.png" alt="Logo" width="100">
        <p class="text-muted">Acesse sua conta ou crie uma nova</p>
      </div>

      <div class="card-body">
        <!-- Tabs -->
        <?php include 'components/tabs.php' ?>

        <div class="tab-content">
          <!-- Login -->
          <?php include 'components/login.php' ?>


          <!-- Cadastro -->
          <?php include 'components/cadastro.php' ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>