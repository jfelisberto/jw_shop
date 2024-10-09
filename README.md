Olá bem vindo ao sistema Minha Loja

Vamos aos primeiros passos da configuração.

1 - Setando o acesso ao banco de dados
    No array $settings['database']; atribua os dados da conta de acesso ao  MySQL
    $settings['database'] array (
        'username' => 'usuarioMySQL',
        'password' => 'senhaMySQL',
        'host' => 'localhost',
        //'port' => '3306',
        'dbname' => 'jw_shop',
        'tablesprefix' => 'jw_',
        'charset' => 'utf8'
    )
    
2 - Crie o Banco de dados jw_shop

3 - Carregue o arquivo jw_shop.sql para popular o banco

4 - Pra logar clique no botão login e escolha na caixa de seleção um dos usuários pre cadastrados apenas para teste.


<hr />

# Smarty template engine
Smarty is a template engine for PHP, facilitating the separation of presentation (HTML/CSS) from application logic.

![CI](https://github.com/smarty-php/smarty/workflows/CI/badge.svg)

## Repository
Access the [repository](https://github.com/smarty-php/smarty) to Smarty

## Documentation
Read the [documentation](https://smarty-php.github.io/smarty/) to find out how to use it.

## Requirements
Smarty v5 can be run with PHP 7.2 to PHP 8.3.

## Installation
Smarty versions 3.1.11 or later can be installed with [Composer](https://getcomposer.org/).

To get the latest stable version of Smarty use:
```bash
composer require smarty/smarty
````

More in the [Getting Started](./docs/getting-started.md) section of the docs.
