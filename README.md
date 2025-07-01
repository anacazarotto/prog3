# 🛠️ Gestor de Projetos de Arquitetura - Yii2

Este é um sistema de controle de projetos desenvolvido com o framework PHP **Yii2**. A aplicação foi criada com base no template básico do Yii2, mas recebeu diversas personalizações voltadas ao gerenciamento de projetos de arquitetura, incluindo:

- Cadastro e visualização de projetos
- Acompanhamento de status e etapas
- Upload e download de arquivos por projeto
- Área de comentários com nome do usuário
- Interface com Bootstrap e ícones

Cada projeto pode receber comentários, que são registrados com o nome de usuário logado e exibidos em ordem cronológica na visualização do projeto.

**Permissões de Role:**

**Admin:** Pode ver e editar todos os projetos, pode comentar em todos, além de poder criar novos usuários.

**User:** Pode ver e editar apenas seus próprios projetos, pode comentar apenas em seu projeto, além de não poder fazer cadastro de novos usuários.

## 📂 Estrutura de Diretórios

```
assets/         → Definições de assets (JS, CSS, etc.)
commands/       → Comandos de console (opcional)
config/         → Arquivos de configuração da aplicação
controllers/    → Controllers web
models/         → Modelos (regras de negócio, DB)
views/          → Arquivos de visualização (HTML/PHP)
web/            → Entrada da aplicação (index.php e recursos web)
uploads/        → (Adicionado) Arquivos enviados pelos usuários
```

## ✅ Requisitos

- PHP >= 8.2
- Composer
- Servidor MySQL/MariaDB
- Extensões do PHP habilitadas: `pdo`, `mbstring`, `openssl`, etc.

** Caso instale o XAMPP, ao utilizar a versão mais recente é possível instalar o composer utilizando o php do mesmo, assim 
facilitando o setup no Windows.

## 🚀 Instalação

### 1. Clonar o Repositório

```bash
git clone https://github.com/seu-usuario/seu-repo.git
cd seu-repo
```

### 2. Instalar Dependências

```bash
composer install
```

### 3. Configurar o Banco de Dados

Edite `config/db.php` com os dados corretos:

```php
return [
    'class' => 'yii\\db\\Connection',
    'dsn' => 'mysql:host=localhost;dbname=geezthor',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

Crie o banco de dados manualmente utilizando um cliente MySQL ou ferramenta de sua preferência.

### 4. Configurar a chave de validação de cookies

No arquivo `config/web.php`, defina uma chave aleatória:

```php
'request' => [
    'cookieValidationKey' => 'insira_uma_chave_secreta_aqui',
],
```

### 5. Rodar o servidor local

```bash
php yii serve
```

Acesse: [http://localhost:8080](http://localhost:8080)

## 📦 Uploads de Arquivos

Os arquivos são enviados para a pasta `web/uploads/`. Certifique-se de que esta pasta tem permissão de escrita:

```bash
chmod -R 775 web/uploads
```

## 🗣️ Comentários

**Usuário Administrativo Base no arquivo geezthor.sql:**

```
Login: admin
Senha: 123456
```

## 🖼️ Interface

O frontend utiliza **Bootstrap 5** e ícones (como os do Bootstrap Icons ou FontAwesome). A interface é responsiva e pensada para facilitar a leitura e acompanhamento dos projetos.

## 👥 Equipe de Desenvolvimento

- Ana Carla Londero Cazarotto
- João Vitor Machado

## 📄 Licença

Este projeto é acadêmico e foi desenvolvido como parte de uma disciplina da graduação. Uso livre para fins educacionais.