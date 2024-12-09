# Sistema de Vagas de Estágio

Aluno: João Pedro de Oliveira Moraes
RA: 2524155

Este projeto, desenvolvido para a disciplina de Desenvolvimento Web-Servidor, é uma aplicação web voltada para a gestão de vagas de estágio. Nela, candidatos podem visualizar vagas e cadastrar seus currículos, enquanto empresas têm a possibilidade de visualizar candidatos e adicionar novas vagas.

A aplicação foi construída utilizando programação orientada a objetos, com PDO para interação com o banco de dados. O projeto também faz uso do Composer para gerenciamento de pacotes e bibliotecas, e conta com um sistema de rotas para garantir navegação com URLs amigáveis.

## Configuração

### Passo 1: Instalar e configurar o XAMPP

1. Baixe e instale o [XAMPP](https://www.apachefriends.org/index.html).
2. Abra o XAMPP e inicie os serviços de **Apache** e **MySQL**.

### Passo 2: Configurar o Projeto

1. Coloque os arquivos do projeto na pasta `C:\xampp\htdocs\estagio-main` (ou na pasta do seu diretório de servidores).
2. Acesse `http://localhost/estagio-main/` no navegador para acessar a aplicação.

### Passo 3: Configurar o Banco de Dados

1. Acesse o [phpMyAdmin](http://localhost/phpmyadmin/).
2. Crie um banco de dados.
3. Importe o script SQL localizado em `C:\xampp\htdocs\estagio-main\database\create_database.sql`.
