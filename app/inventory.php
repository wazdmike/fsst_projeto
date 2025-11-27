<?php
session_start();
require '../conn.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inserir_produto'])) {
    $nome = trim($_POST['nome']);
    $id_categoria = (int) $_POST['categoria'];
    $quantidade = (int) $_POST['quantidade'];
    $preco = str_replace(['.', ','], ['', '.'], $_POST['preco']);
    $preco = (float) $preco;

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, id_categoria, quantidade, preco) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $id_categoria, $quantidade, $preco]);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_produto'])) {
    $id = (int) $_POST['id'];
    $nome = trim($_POST['nome']);
    $id_categoria = (int) $_POST['categoria'];
    $quantidade = (int) $_POST['quantidade'];
    $preco = str_replace(['.', ','], ['', '.'], $_POST['preco']);
    $preco = (float) $preco;

    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, id_categoria = ?, quantidade = ?, preco = ? WHERE id = ?");
    $stmt->execute([$nome, $id_categoria, $quantidade, $preco, $id]);
}



if (isset($_GET['excluir'])) {
    $id = (int) $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: inventory.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['criar_categoria'])) {
    $novaCategoria = trim($_POST['nova_categoria']);

    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM categoria WHERE nome = ?");
    $stmtCheck->execute([$novaCategoria]);
    $existe = $stmtCheck->fetchColumn();

    if ($existe > 0) {
        $_SESSION['erro_categoria'] = "Categoria já existe!";
        header("Location: inventory.php");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO categoria (nome) VALUES (?)");
    $stmt->execute([$novaCategoria]);

    header("Location: inventory.php");
    exit;
}

$limite = 5;
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
if ($pagina < 1) $pagina = 1;

$offset = ($pagina - 1) * $limite;

$total = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
$totalPaginas = ceil($total / $limite);


$stmt = $pdo->prepare("
    SELECT p.*, c.nome AS categoria_nome
    FROM produtos p
    LEFT JOIN categoria c ON c.id = p.id_categoria
    ORDER BY p.id DESC
    LIMIT :limite OFFSET :offset
");

$stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtCat = $pdo->query("SELECT * FROM categoria ORDER BY nome");
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<?php include 'components/header.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <?php include 'components/navbar.php'; ?>
        <?php include 'components/sidebar.php'; ?>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['erro_categoria'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['erro_categoria'] ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php unset($_SESSION['erro_categoria']);
                    endif; ?>

                    <!-- Card de resumo -->
                    <?php include 'components/inv_summary_cards.php' ?>

                    <!-- Botão adicionar produto -->
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success mb-3 mr-2" data-toggle="modal" data-target="#modalProduto">Adicionar Produto</button>
                        <button class="btn btn-info mb-3" data-toggle="modal" data-target="#modalCategoria"> Criar Categoria </button>
                    </div>


                    <!-- Tabela de produtos -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Lista de Produtos</h3>
                        </div>
                        <?php include 'components/inv_table_products.php'; ?>
                    </div>

                </div>
            </section>
        </div>

    </div>

    <!-- Modal Adicionar Produto -->
    <?php include 'components/inv_add_modal.php'; ?>
    <!-- Modal Adicionar categoria -->
    <?php include 'components/inv_add_category.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>

</html>