## Visão Geral

O Sistema de Gestão Escolar foi desenvolvido para otimizar a administração de alunos em instituições de ensino. Ele oferece uma interface simples e funcional, permitindo que os gestores cadastrem, editem e excluam informações dos alunos de maneira rápida e eficiente.

### Principais Funcionalidades
- Cadastro de alunos

- Edição de informações dos alunos

- Exclusão de registros

- Pesquisa de alunos cadastrados

- Validação de entrada de dados

## Demonstração

Para uma visualização rápida do projeto, você pode assistir aos vídeos abaixo. Eles mostram uma demonstração das principais funcionalidades da aplicação.

![Demonstração do Projeto - Cadastro de Alunos](assets/images/demo.gif)

## 💻 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- PHP 8.4.3

- JavaScript (jQuery e Bootstrap)

- PostgreSQL

- HTML/CSS

## Como Executar o Projeto
Clone o repositório:

git clone https://github.com/EnilsonNeto/CrudAlunosPHP.git

Configure o banco de dados PostgreSQL:

Crie um banco de dados chamado crud_php

Crie um script sql

```sql
CREATE TABLE alunos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(15),
    data_nascimento DATE,
    ativo BOOLEAN DEFAULT TRUE
);
```

Edite o arquivo config/db.php com as credenciais corretas

Instale o servidor local (XAMPP, WAMP ou equivalente) e inicie o Apache e o PostgreSQL.

Execute a aplicação acessando http://localhost/SeuServidor, EX: http://localhost/8000

