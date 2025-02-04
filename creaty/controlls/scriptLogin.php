<?php  
session_start();
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT senha FROM administrador WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $senhabd = $result->fetch_assoc()['senha'];

        if (!password_verify($senha, $senhabd)) {
            $mensagem = "Email ou senha incorreto";
            $_SESSION['LoginMensagem'] = $mensagem;
            header("location: ../login.php");
            
            exit;
        } else {
            $_SESSION['usertype'] = "admin";
            $_SESSION['email'] = $email;
            header("location: ../admin/gerenciarPosts.php");
            exit;
        }
    } else {
        $mensagem = "Email ou senha incorreto";
        $_SESSION['LoginMensagem'] = $mensagem;

        header("location: ../login.php");
        exit;
    }
}


