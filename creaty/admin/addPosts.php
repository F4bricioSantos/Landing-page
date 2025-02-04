<?php
include "../controlls/conexao.php";
session_start(); 

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "admin") {
    header("location: ../login.php");
    exit;
}

$sql = "SELECT * FROM blog";
$dados = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $text = $_POST["text"];
  $data_atual = date('d/m/Y');

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $image = "../imgPost/" . basename($_FILES["image"]["name"]);
      
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
          if (mysqli_num_rows($dados) > 0) {
              $sql_post = "INSERT INTO `blog` (`titulo`, `img`, `data`, `texto`) VALUES ('$title', '$image', '$data_atual', '$text')";
              if (mysqli_query($conn, $sql_post)) {
                  header('Location:gerenciarPosts.php');
                  exit; 
              } else {
                  echo "Erro ao cadastrar a postagem: " . mysqli_error($conn);
              }
          } else {
              echo "Nenhum dado encontrado no blog.";
          }
      } else {
          echo "Erro ao enviar a foto.<br>";
          exit;
      }
  }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Post</title>
    <link rel="stylesheet" href="../css/stylePost.css">
    <link rel="shortcut icon" type="imagex/png" href="../img/logo.jpg">
</head>
<body>
  <?php include "menu.php"; ?>
  <section class="section-content">
    <div class="contain">
        <h2 id="adp">Adicionar Post</h2>
        <form action="addPosts.php" id="postForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" id="image" name="image" placeholder="URL da Imagem" required>
            </div>
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="text">Texto:</label>
                <textarea id="text" name="text" rows="5" required></textarea>
            </div>
            <div style="display: flex; justify-content: center;">
            <button type="submit">Adicionar</button>
          </div>
        </form>
    </div>
</section>
</body>
</html>
