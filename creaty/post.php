<?php 
include "controlls/conexao.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT * FROM blog WHERE id = $id";
    $dados = mysqli_query($conn, $sql);

    if (mysqli_num_rows($dados) > 0) {
        $linha = mysqli_fetch_assoc($dados); 

        $title = $linha["titulo"];
        $img = $linha["img"];
        $date = $linha["data"];
        $text = $linha["texto"];
        $textAdaptado = nl2br(htmlspecialchars($text));

        $search = $linha['titulo']; 
        $limit = 5; 
        $offset = 0; 

        $sqlSugestoes = "SELECT * FROM blog 
                          WHERE (titulo LIKE '%$search%' OR MATCH(titulo) AGAINST('$search' IN NATURAL LANGUAGE MODE)) 
                          AND id != $id 
                          LIMIT $limit OFFSET $offset"; 
        $dadosSugestoes = mysqli_query($conn, $sqlSugestoes);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postagem do Blog</title>
    <link rel="stylesheet" href="css/styleAdmblog.css">
    <link rel="shortcut icon" type="imagex/png" href="img/logo.jpg">
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
            <a href="https://wa.me/5585991637206">CONTATO</a>
        </div>
    </nav>
</section>

    <header>
        <h1>Blog de MARKETING</h1>
    </header>

    <main class="blog-content">
        <article class="post">
            <?php 
            echo"
            <h2>$title</h2>
            <img src='admin/$img' alt='Imagem'>
            <p>$textAdaptado</p>
             ";
            ?>
        </article>

        <section class="suggestions">
            <h3>Você Também Pode Gostar</h3>
            <?php
            if (mysqli_num_rows($dadosSugestoes) > 0) {
                while ($linhaSugestoes = mysqli_fetch_assoc($dadosSugestoes)) {
                    $titleSugestoes = $linhaSugestoes["titulo"];
                    $imgSugestoes = $linhaSugestoes["img"];
                    $textSugestoes = $linhaSugestoes["texto"];
                    $textSugestoesAdaptado = nl2br(htmlspecialchars($textSugestoes));

                    echo "
                    <div class='suggestion-card'>
                        <img src='creaty/$imgSugestoes' alt='$titleSugestoes'>
                        <h4><a href='post.php?id={$linhaSugestoes['id']}'>$titleSugestoes</a></h4>
                    </div>";
                }
            }
            ?>
        </section>
    </main>

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
