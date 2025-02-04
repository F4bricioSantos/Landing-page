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
        $linha = mysqli_fetch_assoc($dados); // Obtém os dados do post

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $date = date('d/m/Y', strtotime($_POST["date"]));
            $text = $_POST["text"];
            $id = intval($_POST["id"]);


            $sql_post = "UPDATE `blog` SET `titulo`='$title', `data`='$date', `texto`='$text'";

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = "../imgPost/" . basename($_FILES["image"]["name"]);
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
                    $sql_post .= ", `img`='$image'";
                } else {
                    echo "Erro ao enviar a foto.<br>";
                    exit;
                }
            }

            $sql_post .= " WHERE `id`='$id'";

            if (mysqli_query($conn, $sql_post)) {
                header('Location: gerenciarPosts.php');
                exit;
            } else {
                echo "Erro ao atualizar a postagem: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Post não encontrado.";
    }
} else {
    //echo "ID inválido.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Post</title>
    <link rel="stylesheet" href="../css/stylePost.css">
    <link rel="shortcut icon" type="imagex/png" href="../img/logo.jpg">
</head>
<body>
    <?php include "menu.php"; ?>
    <section class="section-content">
    <div class="contain">
        <h2>Editar Post</h2>
        <form action="editPost.php?id=<?php echo $id; ?>" id="postForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($linha['id']); ?>"> <!-- Campo escondido para ID -->
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($linha['titulo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="date">Data:</label>
                <?php
                $data_formatada = date('Y-m-d', strtotime($linha['data']));
                ?>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($data_formatada); ?>" required>
            </div>
            <div class="form-group">
                <label for="text">Texto:</label>
                <textarea id="text" name="text" rows="5" required><?php echo htmlspecialchars($linha['texto']); ?></textarea>
            </div>
            <div style="display: flex; justify-content: center;">
                <button type="submit">Atualizar</button> <!-- Alterado de "Adicionar" para "Atualizar" -->
            </div>
        </form>
    </div>
</section>
</body>
</html>
