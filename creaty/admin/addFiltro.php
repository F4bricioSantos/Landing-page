<?php
include "../controlls/conexao.php";
session_start(); 

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "admin") {
    header("location: ../login.php");
    exit;
}

$sql = "SELECT * FROM filtro";
$dados = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filtro = $_POST["filtro"];

    $sql_post = "INSERT INTO `filtro`(`nome`) VALUES ('$filtro')";
    if (mysqli_query($conn, $sql_post)) {
        header('Location: addFiltro.php');
        exit; 
    } else {
        echo "Erro ao cadastrar a postagem: " . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $dell = "DELETE FROM filtro WHERE id = $id";
    if (mysqli_query($conn, $dell)) {
        header("location: addFiltro.php");
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
    <title>Adicionar filtro</title>
    <link rel="stylesheet" href="../css/styleFiltro.css">
    <link rel="shortcut icon" type="imagex/png" href="../img/logo.jpg">
</head>
<body>
  <?php include "menu.php"; ?>
  <div class="filtro-categorias">
    <div class="contain">
        <h2>Adicionar Filtro</h2>
        <form action="addFiltro.php" id="postForm" method="POST">
            <div class="form-group">
                <label for="Filtro">Filtro:</label>
                <input type="text" id="filtro" name="filtro" required>
            </div>
            <div style="display: flex; justify-content: center;">
            <button type="submit">Adicionar</button>
          </div>
        </form>
    </div>
    
    <div id="categorias">
    <p class="titulo">CATEGORIAS</p>
    <?php 
     while ($linha= mysqli_fetch_assoc($dados)) {
        $id = $linha["id"];
        $filtro = $linha["nome"];
    
    echo "<div>
             <p class='filtro'>$filtro</p>
             <button class='excluir' value='$id' onclick='enviarId(this.value)'>Excluir</button>
          </div>";
     }
    ?>
    </div>
   </div><div>
    <script>
        function enviarId(id) {
            window.location.href = 'addFiltro.php?id=' + id;
        }
    </script>
</body>
</html>
