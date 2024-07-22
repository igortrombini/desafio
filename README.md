# Desafio

utilizar o cakephp com mysql para fazer um sistema de login e um cadastro de usuários com: nome, email, login, senha e um upload de foto. 
Cada usuário cadastrado precisa conseguir logar no sistema e ter um painel para ele editar sua senha e sua foto. 
Na área de login precisa ter um lembrar senha mandando um email para o usuário com o link para trocar sua senha!

# Projeto de Autenticação e Dashboard com CakePHP

Este projeto é uma aplicação básica de autenticação e gerenciamento de perfil de usuário utilizando o framework CakePHP.

## Funcionalidades

- Registro de usuário
- Login e Logout
- Esqueci minha senha e redefinição de senha
- Editar perfil do usuário
- Alterar senha do usuário
- Dashboard do usuário

## Estrutura do Projeto

### Controladores

- `UsersController.php`: Controlador principal para ações de usuário como login, registro, esqueci a senha, redefinir senha, editar perfil e alterar senha.

### Modelos

- `User.php`: Entidade de usuário.
- `UsersTable.php`: Tabela de usuários com validações e regras.

### Visualizações

- `add.php`: Formulário de registro de novo usuário.
- `edit_profile.php`: Formulário para editar perfil de usuário.
- `edit_password.php`: Formulário para alterar senha do usuário.
- `forgot_password.php`: Formulário para solicitar redefinição de senha.
- `login.php`: Formulário de login do usuário.
- `reset_password.php`: Formulário para redefinir a senha do usuário.
- `dashboard.php`: Dashboard do usuário.

### Arquivos de Configuração

- `app.php`: Configurações principais da aplicação, incluindo configurações de email.
- `routes.php`: Configurações de rotas da aplicação.
- `application.php`: Configuração de middleware e serviços de autenticação.

### Arquivos CSS

- `register.css`: Estilos para formulários de registro e similares.
- `login.css`: Estilos para o formulário de login.
- `form.css`: Estilos gerais para formulários.
- `dashboard.css`: Estilos para o dashboard do usuário.

### Arquivo JavaScript

- `script.js`: Função JavaScript para alternar a exibição de seções no dashboard.

## Instalação

1. Clone o repositório para sua máquina local.
   ```sh
   git clone https://github.com/seu-usuario/seu-repositorio.git

## Instalação

1. Navegue até o diretório do projeto.
    cd seu-repositorio


2. Instale as dependências do projeto.
    composer install


3. Configure o arquivo `.env` com as credenciais do banco de dados e outras configurações necessárias.

4. Execute as migrações do banco de dados.
    bin/cake migrations migrate

## Uso

1. Inicie o servidor CakePHP.
    bin/cake server


2. Acesse a aplicação no navegador.
    http://localhost:8765
 
