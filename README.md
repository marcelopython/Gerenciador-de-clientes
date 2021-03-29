# Gerenciador de clientes

# Guia para execução do projeto

**Clonar o projeto**

**Instalar o composer para gerenciamento de dependência**
* [Site do composer para download](#Site do composer para download)
    * [Vesão  1.10.1](#Vesão  1.10.1)
    * [https://getcomposer.org/download/](#https://getcomposer.org/download/)


**Php**
* [Versão](#versão)
    * [>= 7.4.3](#>=7.4.3) 

**Banco de dados Mysql**
* [Versão](#Versão)
    * [8.0.23](#8.0.23)


# Configuração do banco de dados

**No arquivo [pasta_do_projeto]/config/database.php e onde seta as configurações do banco de dados**

### Apos ter feito as configurações e criado o banco de dados, rode os comando dentro da pasta do projeto para criar as tabelas

**php  database/tables/1_createUserTable.php**

**php database/tables/2_createPeopleTable.php**

**php database/tables/3_createAddressTable.php**


### Comando para inserir o usuário default

**php database/insert/createAdminUser.php**


##  Comando para Instalação de dependência do projeto

**composer install**


## Inicialização do projeto pelo servido php

**php -S localhost:8000 -t public/**

## Inicialização do projeto pelo apache2

**localhost/[caminho_onde_esta_o_projeto]/public**

## Usuário default

**Email = admin@admin.com.br**

**Password = admin**





