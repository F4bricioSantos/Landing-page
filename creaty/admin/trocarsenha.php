<?php
include "../controlls/conexao.php";
session_start();

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Você precisa estar logado para alterar a senha.'); window.location.href='../login.php';</script>";
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT senha FROM administrador WHERE email = '$email'";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senha_antiga = $_POST['senha_antiga'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($result->num_rows > 0) {
        $senhabd = $result->fetch_assoc()['senha'];

        if (!password_verify($senha_antiga, $senhabd)) {
            echo "<script>alert('A senha antiga está errada.'); window.history.back();</script>";
            exit();
        } else {
            if ($nova_senha !== $confirmar_senha) {
                echo "<script>alert('As novas senhas não coincidem.'); window.history.back();</script>";
                exit();
            } else {
                $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                $sql_upload = "UPDATE administrador SET senha = '$senha_hash' WHERE email = '$email'";

                if ($conn->query($sql_upload) === TRUE) {
                    echo "<script>alert('Senha alterada com sucesso.');window.history.back();</script>";
                } else {
                    echo "<script>alert('Erro ao atualizar a senha.'); window.history.back();</script>";
                }
                exit();
            }
        }
    } else {
        echo "<script>alert('Nenhum usuário encontrado com este email.'); window.history.back();</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar Senha</title>
    <link rel="stylesheet" href="../css/styleSenha.css">
    <link rel="shortcut icon" type="imagex/png" href="../img/logo.jpg">
</head>
<body>
<?php include "menu.php"; ?>
<section class="section-body">
    <div class="container">
        <h1>Trocar Senha</h1>
        <form action= "trocarsenha.php" method="POST">
            <div class="input-group">
                <label for="senha_antiga">Senha Antiga:</label>
                <input type="password" id="senha_antiga" name="senha_antiga" required>
            </div>
            <div class="input-group">
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" id="nova_senha" name="nova_senha" required>
            </div>
            <div class="input-group">
                <label for="confirmar_senha">Confirmar Nova Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <button type="submit">Atualizar Senha</button>
        </form>
    </div>
</section>
</body>
</html>
