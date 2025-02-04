<?php
include "../controlls/conexao.php";
session_start(); 

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "admin") {
    header("location: ../login.php");
    exit;
}

$search = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
}
$search = mysqli_real_escape_string($conn, $search);

$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$offset = ($page - 1) * $limit; 

$total_query = "SELECT COUNT(*) as total FROM formulario WHERE nome_completo LIKE '%$search%'";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total']; 
$total_pages = ceil($total_records / $limit); 

$sql = "SELECT * FROM formulario WHERE nome_completo LIKE '%$search%' LIMIT $limit OFFSET $offset";
$dados = mysqli_query($conn, $sql);

if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    $dell = "DELETE FROM formulario WHERE id = $id";
    if (mysqli_query($conn, $dell)) {
        header("location: form.php");
        exit;
    } else {
        echo "Erro ao excluir o produto: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informações do Cliente e Serviços</title>
  <link rel="stylesheet" href="../css/styleForm.css">
</head>
<body>
    <?php include "menu.php"; ?>
    <section class="section-content">
    <div class="pesquisa">
        <form action='form.php' method='POST' class='buscar-form'>
            <input type='text' name='search' placeholder='Pesquise' id='buscar-input' value="<?= htmlspecialchars($search) ?>">
            <button type='submit' class='buscar-button'>Buscar</button>
        </form>
    </div>
        <?php
            while ($linha = mysqli_fetch_assoc($dados)) {
                $id = $linha['id'];
                $nome_completo = $linha['nome_completo'];
                $servicos_desejados = $linha['servicos_desejados'];
                $prazo_esperado = date('d/m/Y', strtotime($linha['prazo_esperado']));
                $orcamento_disponivel = $linha['orcamento_disponivel'];
                echo "
                <div class='card'>
                    <div class='card-content'>
                        <h2>Informações do Cliente</h2>
                        <p><strong>Nome Completo:</strong> $nome_completo</p>
                        <p><strong>Serviço Desejado:</strong> $servicos_desejados</p>
                        <p><strong>Prazo:</strong> $prazo_esperado</p>
                        <p><strong>Orçamento:</strong> $orcamento_disponivel</p>
                    </div>
                    <div class='buttons'>
                    <form action='info.php' method='GET'>
                            <input type='hidden' name='id' value='$id'>
                            <button type='submit' class='view'>Ver</button>
                        </form>

                        <button class='delete' onclick='openModal($id)'>Excluir</button>
                    </div>
                </div>";
            }
        ?>
    <div class="pagination">
    <?php if ($total_pages > 1): ?>
        <a href="?page=1&search=<?= urlencode($search) ?>" class="<?= $page === 1 ? 'disabled' : ''; ?>">Primeira</a>

        <?php 
        // Define a faixa de páginas para exibição
        $start_page = max(1, $page - 1); // Página inicial (atual - 1, mas no mínimo 1)
        $end_page = min($total_pages, $page + 1); // Página final (atual + 1, mas no máximo total de páginas)

        if ($end_page - $start_page < 2) {
            if ($start_page === 1) {
                $end_page = min(3, $total_pages); // Se a página inicial é 1, mostre até 3
            } else {
                $start_page = max(1, $end_page - 2); // Se a página final é 1, ajuste o início
            }
        }

        // Exibe as páginas
        for ($i = $start_page; $i <= $end_page; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" class="<?= $i === $page ? 'active' : ''; ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <a href="?page=<?= $total_pages ?>&search=<?= urlencode($search) ?>" class="<?= $page === $total_pages ? 'disabled' : ''; ?>">Última</a>
    <?php endif; ?>
</div>
    </section>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Você tem certeza que deseja excluir este formulário?</p>
            <button id="confirmDelete" style="background-color: #dc3545;">Confirmar</button>
            <button onclick="closeModal()" style="background-color: #28a745;">Cancelar</button>
        </div>
    </div>
    <script>
        function openModal(id) {
            document.getElementById("myModal").style.display = "block";
            document.getElementById("confirmDelete").onclick = function() {
                window.location.href = 'form.php?id=' + id + '&action=delete';
            };
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</body>
</html>
