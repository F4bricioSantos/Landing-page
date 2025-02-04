<?php
$email = $_SESSION['email'];

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "admin") {
    header("location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral Fixo</title>
    <link rel="stylesheet" href="../css/styleMenu.css">
</head>
<body>
<nav class="nav-topo">
        <div class="div-logo">
            <img src="../img/logo.jpg" alt="">
            <div>
               <p style="margin-left: 5px; font-size: 17px;font-weight: bold;">CREATY</p>
               <P style="margin-left: 23px; font-size: 14px;font-weight: bold;">COMUNICAÇÃO</P> 
            </div>
            
        </div>
        <div>
            <h2 id="adm">ADMINISTRADOR</h2>
        </div>
    </nav>

    <!-- Menu lateral fixo -->
    <div class="menu-lateral">
        <ul>
            <li><a href="gerenciarPosts.php">Gerenciar Posts</a></li>
            <li><a href="addPosts.php">Adicionar Post</a></li>
            <li><a href="addFiltro.php">Adicionar Filtros</a></li>
            <li><a href="form.php">Formularios</a></li>
            <li><a href="trocarsenha.php">Trocar Senha</a></li>
            <li><a href="../logout.php">Sair</a></li>
        </ul>
    </div>
</body>
</html>
