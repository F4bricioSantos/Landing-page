<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário de Orçamento</title>
  <link rel="stylesheet" href="css/styleOrcamentos.css">
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
            <a href="orcamento.php">ORÇAMENTO</a>
            <a href="https://wa.me/5585991637206">CONTATO</a>
        </div>
    </nav>
</section>
<section class="section-form">
    <form action="controlls/scriptOrcamento.php" method="POST">
        <h1>Formulário de Orçamento</h1>
  <!-- Informações do Cliente -->
  <div class="form-group">
    <label for="nome-completo">Nome Completo:</label>
    <input type="text" id="nome-completo" name="nome-completo" required>
  </div>
  
  <div class="form-group">
    <label for="empresa">Empresa:</label>
    <input type="text" id="empresa" name="empresa">
  </div>
  
  <div class="form-group">
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>
  </div>
  
  <div class="form-group">
    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone" name="telefone" required>
  </div>
  
  <div class="form-group">
    <label for="website">Website:</label>
    <input type="url" id="website" name="website">
  </div>
  
  <div class="form-group">
    <label for="redes-sociais">Redes Sociais:</label>
    <input type="text" id="redes-sociais" name="redes-sociais">
  </div>
  
  <!-- Serviço Desejado -->
  <div class="form-group">
    <h2>Serviço Desejado:</h2>
    <div class="checkbox-group">
      <div>
          <label for="identidade-visual">Criação de Identidade Visual</label>
        <input type="checkbox" id="identidade-visual" name="servico[]" value="Criação de Identidade Visual">
      </div>
      <div class="cinza">
          <label for="cartao-visita">Cartão de Visita</label>
        <input type="checkbox" id="cartao-visita" name="servico[]" value="Cartão de Visita">
      </div>
      <div>
          <label for="papel-timbrado">Papel Timbrado</label>
        <input type="checkbox" id="papel-timbrado" name="servico[]" value="Papel Timbrado">
      </div>
      <div class="cinza">
          <label for="envelope">Envelope</label>
        <input type="checkbox" id="envelope" name="servico[]" value="Envelope">
      </div>
      <div>
          <label for="folder-portfolio">Folder/Portfólio</label>
        <input type="checkbox" id="folder-portfolio" name="servico[]" value="Folder/Portfólio">
      </div>
      <div class="cinza">
          <label for="bloco-notas">Bloco de Notas</label>
        <input type="checkbox" id="bloco-notas" name="servico[]" value="Bloco de Notas">
      </div>
      <div>
          <label for="pastas-personalizadas">Pastas Personalizadas</label>
        <input type="checkbox" id="pastas-personalizadas" name="servico[]" value="Pastas Personalizadas">
      </div>
      <div class="cinza">
          <label for="criacao-site">Criação de Site</label>
        <input type="checkbox" id="criacao-site" name="servico[]" value="Criação de Site">
      </div>
      <div>
          <label for="landing-page">Landing Page</label>
        <input type="checkbox" id="landing-page" name="servico[]" value="Landing Page">
      </div>
      <div class="cinza">
          <label for="gestao-redes-sociais">Gestão de Redes Sociais</label>
        <input type="checkbox" id="gestao-redes-sociais" name="servico[]" value="Gestão de Redes Sociais">
      </div>
      <div>
          <label for="campanhas-redes-sociais">Gestão de Campanhas em Redes Sociais</label>
        <input type="checkbox" id="campanhas-redes-sociais" name="servico[]" value="Gestão de Campanhas em Redes Sociais">
      </div>
      <div class="cinza">
          <label for="campanhas-google">Gestão de Campanhas no Google</label>
        <input type="checkbox" id="campanhas-google" name="servico[]" value="Gestão de Campanhas no Google">
      </div>
    </div>
  </div>
  
  <!-- Detalhes do Projeto -->
  <div class="form-group">
    <label for="publico-alvo">Público-Alvo:</label>
    <input type="text" id="publico-alvo" name="publico-alvo" placeholder="ex.: B2B, B2C, faixa etária, localização, etc.">
  </div>
  
  <div class="form-group">
    <label for="objetivos-projeto">Objetivos com o Projeto:</label>
    <input type="text" id="objetivos-projeto" name="objetivos-projeto" placeholder="ex.: aumento de vendas, engajamento nas redes sociais, gerar leads, etc.">
  </div>
  
  <div class="form-group">
    <label for="prazo-esperado">Prazo Esperado:</label>
    <?php  $data_atual = date('d/m/Y'); ?>
    <input type="date" id="prazo-esperado" name="prazo-esperado" min="$data_atual" required>
  </div>
  
  <div class="form-group">
    <label for="orcamento-disponivel">Orçamento Disponível:</label>
    <input type="text" id="orcamento-disponivel" name="orcamento-disponivel" placeholder="Faixa de valores para alinhamento" required>
  </div>
  
  <div class="form-group">
    <label for="descricao-detalhada">Descreva suas necessidades de forma detalhada aqui:</label>
    <textarea id="descricao-detalhada" name="descricao-detalhada" rows="5" required></textarea>
  </div>
  <div class="form-button">
    <button type="submit">Enviar</button>
  </div>
</form>
</section>
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
