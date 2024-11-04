# Projeto Backend - SNAKESHOP

Meu projeto backend feito no contexto do curso de Desenvolvimento Web Full Stack que estou realizando na [FLAG](https://flag.pt/curso/full-stack-web-developer).

## Índice

- [Uso](#uso) 
  - [Ferramentas necessárias](#ferramentas-necessárias) 
  - [Configuração](#configuração) 
  - [Instalação de dependências](#instalação-de-dependências)
- [Visão Geral](#visão-geral)
  - [Contexto](#contexto)
  - [O desafio](#o-desafio)
  - [Tecnologias utilizadas](#tecnologias-utilizadas) 
- [Melhorias e Futuro](#melhorias-e-futuro)

## Uso

Passos para iniciar o projeto. 
Este projeto utiliza XAMPP.

Clone ou baixe este repositório para começar.

### Ferramentas necessárias

Baixe e instale o XAMPP.  
Baixe e instale a versão mais recente do PHP.

### Configuração

Armazene a pasta do projeto na pasta `htdocs`, ela deve estar vazia.

Crie um arquivo `.env` na raiz do projeto com:

DB_HOST="localhost"
DB_NAME="snakeshop"
DB_USER="root"
DB_PASSWORD=""

No XAMPP, inicio o Apache e o MySQL. 
Em http://localhost/phpmyadmin, importe a base de dados disponível na pasta do projeto.

## Visão Geral

### Contexto

Projeto backend para meu curso na [FLAG](https://flag.pt/curso/full-stack-web-developer).

Requisitos do projeto:

- Uso extensivo de PHP + MySQL.
- Utilização do padrão MVC: Models, Views e Controllers.
- Uso do GIT.
- Criação de frontoffice.
- Implementação de todas as funcionalidades CRUD necessárias.
- Autenticação segura em todo o backoffice.
- Uso de AJAX em algumas funcionalidades.
- Uso de um arquivo .env para armazenar informações sensíveis.
- Validação e sanitização adequadas para prevenir SQL Injection.
- Envio de códigos de status HTTP e mensagens de erro corretas.

### O desafio

O projeto visa desenvolver uma loja virtual especializada na venda de serpentes, permitindo que os usuários explorem diferentes espécies e adquiram produtos relacionados de forma prática e intuitiva.

### Tecnologias Utilizadas

Uma aplicação PHP multipágina completa com:

- **Backend**: PHP (com MVC).

- **Frontend**: HTML, CSS, JavaScript.

- **Banco de Dados**: MySQL.

- **Servidor**: XAMPP

## Melhorias e Futuro

### Melhorias:

- Implementar mais métodos de sanitização.
- Criar uma área de perfil de usuário onde os usuários possam atualizar informações, ver histórico de compras, etc.
- Enriquecer a loja com mais conteúdo.
- Implementar PHP Mailer onde fizer sentido.
- Implementar um gestor de sessões, a fim de distinguir as sessões de usuários das sessões de administradores.
- Implementar mais gestores/funcionalidades no backoffice.
- Tornar o CSS mais coeso e consistente.
- Melhorar a utilização de AJAX no que já goi implementado e implementar em possíveis novas funcionalidades.

### Futuro:

- Continuar aprendendo sobre PHP, para consolidar o que vi ao longo do curso e também perceber outras tecnologias. 