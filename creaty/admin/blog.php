<?php 
include "../controlls/conexao.php";
session_start(); 

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "admin") {
    header("location: ../login.php");
    exit;
}

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
    <link rel="stylesheet" href="../css/styleAdmblog.css">
    <link rel="shortcut icon" type="imagex/png" href="../img/logo.jpg">
</head>
<body>
    <header>
        <h1>Blog de MARKETING</h1>
    </header>

    <main class="blog-content">
        <article class="post">
            <?php 
            echo"
            <h2>$title</h2>
            <img src='$img' alt='Imagem'>
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
                        <img src='$imgSugestoes' alt='$titleSugestoes'>
                        <h4><a href='blog.php?id={$linhaSugestoes['id']}'>$titleSugestoes</a></h4>
                    </div>";
                }
            }
            ?>
        </section>
    </main>
</body>
</html>
