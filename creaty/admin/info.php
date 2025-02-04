<?php
include "../controlls/conexao.php";
session_start(); 

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "admin") {
    header("location: ../login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
  $sql = "SELECT * FROM formulario WHERE id = $id";
  $dados = mysqli_query($conn, $sql);

  if (mysqli_num_rows($dados) > 0) {
    $linha = mysqli_fetch_assoc($dados); 

    $nome_completo = $linha['nome_completo'];
    $empresa = $linha['empresa'];
    $email = $linha['email'];
    $telefone = $linha['telefone'];
    $website = $linha['website'];
    $redes_sociais = $linha['redes_sociais'];
    $servicos_desejados = $linha['servicos_desejados'];
    $publico_alvo = $linha['publico_alvo'];
    $objetivos_projeto = $linha['objetivos_projeto'];
    $prazo_esperado = date('d-m-Y', strtotime($linha['prazo_esperado']));
    $orcamento_disponivel = $linha['orcamento_disponivel'];
    $descricao_detalhada = $linha['descricao_detalhada'];
  }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informações do Cliente e Serviços</title>
  <link rel="stylesheet" href="../css/styleInfo.css">
</head>
<body>
    <secion class="section-content">
  <div class="container">
    <h1>Informações do Cliente e Serviços</h1>
    <?php
    echo"
    <section class='informacoes-cliente'>
    <h2>Informações do Cliente</h2>
    <p><strong>Nome Completo:</strong> $nome_completo</p>
    <p><strong>Empresa:</strong> $empresa</p>
    <p><strong>E-mail:</strong> $email</p>
    <p><strong>Telefone:</strong> $telefone</p>
    <p><strong>Website:</strong> $website</p>
    <p><strong>Redes Sociais:</strong> $redes_sociais</p>
</section>

<section class='servico-desejado'>
    <h2>Serviço Desejado</h2>
    <ul>
        <li>$servicos_desejados</li>
    </ul>
</section>

<section class='detalhes-projeto'>
    <h2>Detalhes do Projeto</h2>
    <p><strong>Público-Alvo:</strong> $publico_alvo</p>
    <p><strong>Objetivos com o Projeto:</strong> $objetivos_projeto</p>
    <p><strong>Prazo Esperado:</strong>$prazo_esperado</p>
    <p><strong>Orçamento Disponível:</strong>$orcamento_disponivel</p>
    <p><strong>Descrição Detalhada:</strong>$descricao_detalhada</p>
</section>

    ";
    ?><div class="div-button">
    <a href="form.php"><button>OK</button></a>
  </div>
  </div>
</secion>
</body>
</html>
