<p align="center">
  <img width="460" height="350" src="https://pedropsilva.com.br/images/portfolio/projects/project_two.png">
</p>

# API Product Management
[![NPM](https://img.shields.io/npm/l/react)](https://github.com/pedro-p-silva/api-product-management/blob/main/LICENSE)

Essa API foi desenvolvida para aplicar alguns dos meus conhecimentos utilizando o framework Laravel. Com esse serviço, é possível efetuar o gerenciamento de produtos, podendo efetuar o cadastro, buscas avançadas, edições e exclusões desses produtos.<br>

Nesse projeto, foi utilizada a forma de autenticação JSON Web Token (JWT), visando uma maior segurança na troca de informações na WEB.<br>

Para uma maior facilidade em efetuar validações locais, os seeders e factories foram também previamente configurados, deste modo, para outros desenvolvedores que clonarem o projeto, não existe a necessidade de cadastrar os dados manualmente ao criar as migrations.

Importante salientar, quando um novo usuário é criado na API, um e-mail será disparado para ele, nesse ponto, foi utilizado o serviço de fila, isso foi pensado pois o usuário não precisará aguardar a resposta do servidor de e-mail, o que pode levar um certo tempo e impactar a experiência do usuário. Deste modo, é só configurar um job para que as tarefas paradas na fila sejam executadas, e os e-mails serão disparados posteriormente.<br><br>

## Documentação da API (Swagger UI)
Nessa etapa, é importante que você possua o docker instalado. A documentação da API, pode ser acessada utilizando a seguinte imagem:
```sh
docker run -p 80:8080 -e SWAGGER_JSON_URL=https://gist.githubusercontent.com/pedro-p-silva/4cfc285c568c0a40af162a94ced9dadd/raw/a448bb01e917c4f493a43aa95d95eff2fbd65401/openapi.json swaggerapi/swagger-ui
```
<br>

## Algumas IDEs recomendadas

* [PHP Storm](https://www.jetbrains.com/pt-br/phpstorm/)
* [Visual Studio Code](https://code.visualstudio.com/)<br><br>

## Customizar Configurações

Veja: [Laravel Configuration Reference](https://laravel.com/docs/11.x/configuration).<br><br>

## Configurações do projeto

### Clonar o projeto
```sh
git clone https://github.com/pedro-p-silva/api-product-management.git
```

### Instalar o gerenciador de pacotes

```sh
npm install
```

### Duplicar o arquivo .env.example e renomear o arquivo duplicado para ".env". Posteriormente, adicionar as informações de conexão do banco de dados no arquivo renomeado.<br>

### Instalar o gerenciador de dependências

```sh
composer install
```

### Gerando a chave APP_KEY no arquivo .env

```sh
php artisan key:generate
```

### Gerando a secret do JWT

```sh
php artisan jwt:secret
```

### Migração das tabelas do banco de dados

```sh
php artisan migrate
```

### Populando as tabelas migradas

```sh
php artisan db:seed
```
<br>

## Skills utilizadas
<div style="display: inline_block">
  <img align="center" title="PHP" alt="Pedro-PHP" height="40" width="50" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg">
  <img align="center" title="Laravel" alt="Pedro-Laravel" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg">
  <img align="center" title="MySQL" alt="Pedro-Mysql" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original.svg">
</div>
