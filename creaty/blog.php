<?php
include "controlls/conexao.php";

$search = "";
$limit = 8; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
}

$search = mysqli_real_escape_string($conn, $search);

$totalPostsQuery = "SELECT COUNT(*) AS total FROM blog WHERE titulo LIKE '%$search%' OR MATCH(titulo) AGAINST('$search' IN NATURAL LANGUAGE MODE)";
$totalPostsResult = mysqli_query($conn, $totalPostsQuery);
$totalPosts = mysqli_fetch_assoc($totalPostsResult)['total'];
$totalPages = ceil($totalPosts / $limit); 

$slq = "SELECT * FROM blog WHERE titulo LIKE '%$search%' OR MATCH(titulo) AGAINST('$search' IN NATURAL LANGUAGE MODE) ORDER BY id DESC LIMIT $limit OFFSET $offset";
$dados = mysqli_query($conn, $slq);

$slqFiltro = "SELECT * FROM filtro";
$dadosFiltro = mysqli_query($conn, $slqFiltro);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog com Mini Cards</title>
    <link rel="stylesheet" href="css/styleBlog.css">
    <link rel="stylesheet" href="css/styleResponsivoblog.css">
    <link rel="shortcut icon" type="imagex/png" href="img/logo.jpg">
    <style>
        .nenhum{
            margin: 2rem;
            font-size: 1rem;
            background-color: #ffffff;
            border-radius: 3px;
            height: 10rem;
            padding: 0 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<section class="header" id="home">
    <div class="nav-left">
        <img src="img/logo.jpg" class="logo" alt="creaty">
        <div class="branding">
            <p class="creaty">creaty</p>
            <p class="comunicacao">comunicação</p>
        </div>
    </div>
    <nav class="navbar">
        <div class="menu-icon" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="nav-links" id="navLinks">
            <a href="index.php">HOME</a>
            <a href="blog.php">BLOG</a>
            <a href="orcamento.php">ORÇAMENTO</a>
            <a href="https://wa.me/5585991637206">CONTATO</a>
        </div>
    </nav>
</section>
<section class="section-blog">
    <h1>Blog de Marketing</h1>

    <div class="pesquisa">
        <div id="categorias">
            <p class="titulo">CATEGORIAS</p>
            <form class='filtro' action='blog.php' method='POST'>
                <input type='hidden' name='search'>
                <button type='submit'>Limpar Filtro</button>
            </form>
            <?php 
            if ($dadosFiltro) {
                while ($linha= mysqli_fetch_assoc($dadosFiltro)) {
                    $id = $linha["id"];
                    $filtro = $linha["nome"];
                    echo "<div>
                             
                             <form class='filtro' action='blog.php' method='POST'>
                                    <input type='hidden' name='search' value='$filtro'>
                                    <button type='submit'>$filtro</button>
                                </form>
                          </div>";
                }
            }
            ?>
        </div>
        <form action='blog.php' method='POST' class='buscar-form'>
            <input type='text' name='search' placeholder='Buscar...' class='buscar-input'>
            <button type='submit' class='buscar-button'>Buscar</button>
        </form>
    </div>

    <div class="blog-container">
        <?php
        if ($dados->num_rows > 0) {
            while ($linha = mysqli_fetch_assoc($dados)) {
                $id = $linha["id"];
                $img = $linha["img"];
                $title = $linha["titulo"];
                $date = $linha["data"];
                $text = $linha["texto"];
                
                echo "<div class='card'>
                <img src='creaty/$img' alt='Imagem do Post'>
                <div class='card-content'>
                    <div class='card-title'>$title</div>
                    <div class='card-text'>" . substr($text, 0, 100) . "...</div>
                    <div class='card-more'>
                    <div class='card-date'>Publicado em: $date</div>
                        <form action='post.php' method='GET'>
                            <input type='hidden' name='id' value='$id'>
                            <button type='submit'>Ver mais</button>
                        </form>
                    </div>
                </div>
            </div>";
            }
        } else {
            echo "<p class='nenhum'>Nenhum post encontrado.</p>";
        }
        ?>
    </div>

    <div class="pagination">
    <?php if ($totalPages > 1): ?>
        <a href="?page=1&search=<?= urlencode($search) ?>" class="<?= $page === 1 ? 'disabled' : ''; ?>">Primeira</a>

        <?php 
        $start_page = max(1, $page - 1); 
        $end_page = min($totalPages, $page + 1); 

        if ($end_page - $start_page < 2) {
            if ($start_page === 1) {
                $end_page = min(3, $totalPages); 
            } else {
                $start_page = max(1, $end_page - 2); 
            }
        }

        for ($i = $start_page; $i <= $end_page; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" class="<?= $i === $page ? 'active' : ''; ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <a href="?page=<?= $totalPages ?>&search=<?= urlencode($search) ?>" class="<?= $page === $totalPages ? 'disabled' : ''; ?>">Última</a>
    <?php endif; ?>
</div>
    
</section>
<footer>
        <div class="footer-content">
            <div class="footer-info">
                <p id="creaty-footer">CREATY</p>
                <p id="comunicacao-footer">COMUNICAÇÃO</p>
            </div>
            <hr id="hr">
            <div class="social-media">
                <p>REDES SOCIAIS</p>
                <div class="social-icons">
                    <a href="https://wa.me/5585991637206"><img src="icons/whatsapp.png" alt="Icone 1"></a>
                    <a href="https://www.instagram.com/creatycomunicacao/"><img src="icons/instagram.png" alt="Icone 2"></a>
                    <a href="https://www.linkedin.com/company/creatycomunicacao/"><img src="icons/linkedin.png" alt="Icone 3"></a>
                    <a href="https://www.behance.net/creatycomunicacao"><img src="icons/behance.png" alt="Icone 4"></a>
                    <a href="https://br.pinterest.com/creatycomunicacao/"><img src="icons/pinterest.png" alt="Icone 5"></a>    
                </div>
            </div>
        </div>
    </footer>
    <script src="controlls/scriptmenu.js"></script>
</body>
</html>
