# Guia de Configuração do Projeto Creaty

## 1. Colocar a pasta creaty no diretório htdocs:
- Abra a pasta onde o XAMPP ou o seu servidor local está instalado.
- Vá para o diretório `htdocs`, que é onde você deve colocar o projeto.
- Crie uma nova pasta chamada `creaty`.
- Copie todos os arquivos do projeto para essa pasta `creaty`.

## 2. Importar o banco de dados creaty.sql no phpMyAdmin:
- No painel de controle do XAMPP, inicie os serviços **Apache** e **MySQL**.
- Abra o navegador e vá até o endereço [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/) para acessar o phpMyAdmin.
- No phpMyAdmin, crie um banco de dados novo chamado **creaty**.
- Após criar o banco de dados, clique na aba **Importar** no topo da página.
- Selecione o arquivo **creaty.sql** do seu computador e clique em **Executar** para importar o banco de dados.

## 3. Ajustes no Sistema:

### Área do Administrador:
- **Página de Login (login.php):**  
  O administrador pode acessar a área administrativa com e-mail e senha. O e-mail e senha padrão para login são:
  - **E-mail:** `creaty@gmail.com`
  - **Senha:** `123`
  
  Acesse a página de login do administrador através do link: [http://localhost/creaty/login.php](http://localhost/creaty/login.php)

- **Painel de Administração (dashboard.php):**  
  Após um login bem-sucedido, o administrador será redirecionado para o painel de administração, onde ele poderá:
  - **Gerenciar Posts:** O administrador pode editar os posts existentes, incluindo título, conteúdo e tags, além de excluir posts.
  - **Gerenciar Filtros:** O administrador pode adicionar categorias ou tags para organizar os posts.
  - **Receber Formulários de Orçamento:** O administrador pode visualizar e gerenciar os formulários enviados pelos usuários para orçamento.
  - **Trocar Senha:** O administrador pode acessar uma página para alterar sua senha.

### Área do Blog:
- **Página de Exibição de Posts (creaty/blog.php):**  
  A página do blog exibirá os posts para os visitantes do site, ordenados de forma que os posts mais recentes sejam exibidos primeiro.

## 4. Teste Local:
- Para acessar o site localmente, abra o navegador e digite [http://localhost/creaty](http://localhost/creaty) para visualizar o projeto.
