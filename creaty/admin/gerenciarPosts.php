<?php 
include "../controlls/conexao.php";
session_start(); 

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "admin") {
    header("location: ../login.php");
    exit;
}

$search = "";
$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
}

$search = mysqli_real_escape_string($conn, $search);

$total_query = "SELECT COUNT(*) as total FROM blog WHERE titulo LIKE '%$search%'";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_posts = $total_row['total'];
$total_pages = ceil($total_posts / $limit);

$sql = "SELECT * FROM blog WHERE titulo LIKE '%$search%' ORDER BY id DESC LIMIT $limit OFFSET $offset";
$dados = mysqli_query($conn, $sql);

if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    $dell = "DELETE FROM blog WHERE id = $id";
    if (mysqli_query($conn, $dell)) {
        header("location: gerenciarPosts.php");
        exit;
    } else {
        echo "Erro ao excluir o produto: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar</title>
    <link rel="stylesheet" href="../css/styleGerenciar.css">
    <link rel="shortcut icon" type="imagex/png" href="../img/logo.jpg">
    <script>
        function openModal(id) {
            document.getElementById("myModal").style.display = "block";
            document.getElementById("confirmDelete").onclick = function() {
                window.location.href = 'gerenciarPosts.php?id=' + id + '&action=delete';
            };
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</head>
<body>
        <section class="blog-section">
        <form action='gerenciarPosts.php' method='POST' class='buscar-form'>
            <input type='text' name='search' placeholder='Pesquise' id='buscar-input'>
            <button type='submit' class='buscar-button'>Buscar</button>
        </form>
        <div class="blog-container">
            <?php 
            include "menu.php";
            
            while ($linha= mysqli_fetch_assoc($dados)) {
                $id = $linha["id"];
                $img = $linha["img"];
                $title = $linha ["titulo"];
                $date = $linha ["data"];
                $text = $linha ["texto"];
            
                echo "<div class='card'>
                    <img src='$img' alt='Imagem do Post'>
                    <div class='card-content'>
                        <div class='card-title'>$title</div>
                        <div class='card-text'>" . substr($text, 0, 100) . "...</div>
                        <div class='card-date'>Publicado em: $date</div>
                        <div class='card-more'>
                            <div>
                                <form action='editPost.php' method='GET'>
                                    <input type='hidden' name='id' value='$id'>
                                    <button type='submit'>Editar</button>
                                </form>
                                <button onclick='openModal($id)' style='margin-left: 5px;'>Excluir</button>
                            </div>
                            <form action='blog.php' name='id' method='GET'>
                                <input type='hidden' name='id' value='$id'>
                                <button type='submit'>Ver mais</button>
                            </form>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </section>

    <!-- Paginação -->
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
<div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Você tem certeza que deseja excluir este post?</p>
            <button id="confirmDelete" style="background-color: #dc3545;">Confirmar</button>
            <button onclick="closeModal()" style="background-color: #28a745;">Cancelar</button>
        </div>
    </div>
</body>
</html>
