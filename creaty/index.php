<?php
include "controlls/conexao.php";

$categoriaSelecionada  = '';
$textoBlog = '';
$limit = 1;  
$busca = ''; 

if (isset($_POST['busca'])) {
    $busca = $_POST['busca'];
}

$sqlpost = "SELECT titulo, img, data, texto FROM blog"; 
$resultado = mysqli_query($conn, $sqlpost);


$sql = "SELECT * FROM projetos";
if ($categoriaSelecionada) {
    $sql .= " WHERE categoria LIKE '%$categoriaSelecionada%'";
}
$dados = mysqli_query($conn, $sql);

$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;  
$sqlBlog = "SELECT titulo, img, data, texto FROM blog WHERE titulo LIKE '%$busca%' ORDER BY data DESC LIMIT $limit OFFSET $offset"; 
$dadosBlog = mysqli_query($conn, $sqlBlog);

if (isset($_POST['loadMore'])) {
    while ($linha = mysqli_fetch_assoc($dadosBlog)) {
        echo renderBlogPost($linha);
    }
    exit;  
}

function renderBlogPost($linha) { 
    $titulo = $linha['titulo'];
    $img = $linha['img'];
    $data = $linha['data'];
    $texto = $linha['texto'];
    $categoria = ''; 

    return "
    <div class='artigo' data-categoria='$categoria'>
        <p class='titulo'>$titulo</p>
        <img src='$img' alt='Imagem do post'>
        <p class='data'>$data</p>
        <p class='texto'>
            <span class='short-text'>" . substr($texto, 0, 400) . "...</span>
            <span class='full-text' style='display:none;'>$texto</span>
            <button class='ler-mais'>Ler Mais</button>
        </p>
    </div>";
}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATY</title>
    <link rel="shortcut icon" type="imagex/png" href="img/logo.jpg">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+2:wght@100;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styleHome.css">
    <link rel="stylesheet" href="css/styleResponsivohome.css">
</head>
<body>
    <!-- Header Section -->
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
        <a href="#home">HOME</a>
        <a href="#serviços">NOSSOS SERVIÇOS</a>
        <a href="#projetos">PROJETOS</a>
        <a href="blog.php">BLOG</a>
        <a href="orcamento.php">ORÇAMENTO</a>
    </div>
</nav>

    </section>

    <section class="inicial" id="home">
        <p id="ideias">IDEIAS INOVADORAS E CRIATIVAS</p>
        <p id="subtext">para Impulsionar o Seu Negócio</p>
        <div id="contato">
            <a href="https://wa.me/5585991637206"><button class="contato">ENTRE EM CONTATO</button></a>
        </div>
    </section>

    <section class="servicos" id="serviços">
        <p class="destaque">NOSSOS SERVIÇOS</p>
        <h3 id="title"></h3>
        <div class="carrosel-container">
            <button class="prev-btn">❮</button>
            <div class="carrosel">
                <div class="carrosel-item" data-title="DESENVOLVIMENTO DE SITE" data-description="Um site te permite estar disponível para seu público durante 24h por dia, 7 dias por semana, sem ter o ônus de fazer isso presencialmente. O site é um canal de informação, comunicação e vendas, sempre aberto para os seus clientes">
                    <img src="img/images_9353691196_61dcaf6dca1c1-Renderizacao-do-lado-do-servidor-versus-renderizacao-do-lado-do 2.png" alt="Imagem 1">
                </div>
                <div class="carrosel-item" data-title="DESING" data-description="O ser humano é totalmente visual então traços, cores, elementos e símbolos têm forte apelo diante do público, trazendo credibilidade e confiabilidade para seu negócio.">
                    <img src="img/Designer-Grafico 2.png" alt="Imagem 2">
                </div>
                <div class="carrosel-item" data-title="UI|UX" data-description="É sabido que a experiência do usuário é fundamental em todos os aspectos de uma produto ou serviço, e isso interligado com a interface e a facilidade que o usuário tem com sua aplicação, auxilia ainda mais no sucesso do seu negócio">
                    <img src="img/UI.png" alt="Imagem 2">
                </div>
                <div class="carrosel-item" data-title="MARKETING DIGITAL" data-description="O serviço de marketing digital envolve o uso estratégico de canais online e ferramentas digitais para promover produtos, serviços ou marcas a um público-alvo específico. Ele abrange uma ampla gama de atividades e táticas, visando aumentar a visibilidade, engajamento e conversões de uma empresa ou organização na internet">
                    <img src="img/digital-marketing-2 1.png" alt="Imagem 2">
                </div>
                <div class="carrosel-item" data-title="BRAND E IDENTIDADE VISUAL" data-description="Definir de objetivos, o planejamento e executar de atividades , e medir o progresso em direção a sua realização. Tudo isso ligado com a comunicação visual de uma marca agregam valor e te colocam no caminho certo do sucesso.">
                    <img src="img/Designer-Grafico 2.png" alt="Imagem 2">
                </div>
                <div class="carrosel-item" data-title="CONSULTORIA" data-description="Aprenda e esteja a frente da sua concorrência.">
                    <img src="img/consultoria.png" alt="Imagem 2">
                </div>
            </div>
            <button class="next-btn">❯</button>
            <div class="indicators">
            </div>
        </div>
        <p id="description"></p>
    </section>

    <section class="orcamento" id="projetos">
        <p class="destaque">PROJETOS FINALIZADOS</p>
        <div class="filter-buttons">
           <button>TODOS</button>
           <button>BRAND DESING</button>
           <button>DESING</button>
           <button>MARKETING DIGITAL</button>
           <button>UI</button>
           <button>SITES</button>
        </div>

        <div class="cards">
            <?php
            while ($linha = mysqli_fetch_assoc($dados)) {
                $foto = $linha['foto'];
                $titulo = $linha['titulo'];
                $categoria = $linha['categoria'];
                $descricao = $linha['descricao'];
                $link = $linha['link'];

                echo "
                <div class='card'>
                    <img src='$foto'>
                    <p style='font-size: 17px; margin-top: 28px; font-weight: bold;'>$titulo</p>
                    <p style='font-size: 10px; opacity: 70%; margin-top: 5px;'>$categoria</p>
                    <p style='font-size: 14px; opacity: 80%; margin-top: 18px; width: 280px; text-align: justify;'>$descricao</p>
                    <a href='$link'><button>ver mais</button></a>
                </div>";
            }
            ?>
        </div>

        <a href="https://wa.me/5585991637206"><button class="projetoaqui">SEU PROJETO AQUI</button> </a>
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

    <script src="controlls/scriptHome.js"></script>
    <script src="controlls/scriptMenu.js"></script>
</body>
</html>
