<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nome_completo = $_POST['nome-completo'];
$empresa = $_POST['empresa'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$website = $_POST['website'];
$redes_sociais = $_POST['redes-sociais'];
$servicos_desejados = implode(", ", $_POST['servico']); // Transformar array de serviços em string
$publico_alvo = $_POST['publico-alvo'];
$objetivos_projeto = $_POST['objetivos-projeto'];
$prazo_esperado = $_POST['prazo-esperado'];
$orcamento_disponivel = $_POST['orcamento-disponivel'];
$descricao_detalhada = $_POST['descricao-detalhada'];

$sql = "INSERT INTO formulario (nome_completo, empresa, email, telefone, website, redes_sociais, servicos_desejados, publico_alvo, objetivos_projeto, prazo_esperado, orcamento_disponivel, descricao_detalhada)
VALUES ('$nome_completo', '$empresa', '$email', '$telefone', '$website', '$redes_sociais', '$servicos_desejados', '$publico_alvo', '$objetivos_projeto', '$prazo_esperado', '$orcamento_disponivel', '$descricao_detalhada')";

if ($conn->query($sql) === TRUE) {
  header("Location: ../orcamento.php");
  echo "<script>alert('Novo registro criado com sucesso!');</script>";
    exit();
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
