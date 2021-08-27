# 

![](https://github.com/Adam-Almeida/estrutura-de-dados-II/blob/master/ADAMPERSONALGIT.png)

# 2021 - Processo - DENTAL UNI
Repositório criado para versionamento dos arquivos utilizados no processo da DENTAL UNI 2021 - A cópia de total ou parcial para utilização comercial não está aberta até que o processo seja finalizado.

Utilize o código apenas como estudo e base para o seu aprendizado.

> Principal ideia da Applicação.
>
> - CRUD DE DENTISTAS
> - CRUD DE ESPECIALIDADE
> - EXIBIÇÃO DE DENTISTAS WEB
> - BUSCA DE DENTISTAS
> - ÁREA DE ADMINISTRAÇÃO - OPCIONAL PELO AVALIADO
> - AUTENTICAÇÃO - OPCIONAL PELO AVALIADO
> - LAYOUT RESPONSIVO EM AMBAS AS ÁREAS


## Sobre a Stack

> - PHP 7.4^
> - PDO
> - HTML5
> - CSS3
> - MYSQL
> - JQUERY
> - JAVASCRIPT

## Dependências

> - Composer
> - PHP 7.4^
> - coffeecode/router - 1.0.8^
> - coffeecode/paginator - 1.0.8^
> - league/plates - v4.0.0-alpha
> - SweetAlert - Via Cdn

## Ambiente Local

Editar as linhas do arquivo de acordo com o seu ambiente

:: DADOS DE CONFIGURAÇÃO DO BANCO DE DADOS ::

> Localização do arquivo :: source/Boot/<strong> Config.php </strong>
>
> Importar o arquivo de banco de dados :: <strong> processoseletivo2021_adam_almeida.sql</strong>

```sh

define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "root");
define("CONF_DB_NAME", "processoSeletivo2021_Adam_Almeida");

```

:: DADOS REFERENTE A URL PADRÃO DA APP ::

> Localização do arquivo :: source/Boot/<strong>Config.php</strong>

```sh

define("ROOT", "http://www.localhost:8080/processo-dental-uni");

```

## Ambiente Deploy

Link para acesso a aplicação em funcionamento e dados de acesso ao ADMIN

> https://inconclusive-hyphen.000webhostapp.com/
> 

:: DADOS DE ACESSO LOCAL E REMOTO LOGIN E SENHA ::

> LOGIN: adam.designjuridico@gmail.com
> SENHA: 12345678

## Arquivo composer.json

> Localização do arquivo :: <strong>composer.json</strong>
>
Deve ser realizado a atualização para que seja criado o autoload do projeto e atualização das bibliotecas




