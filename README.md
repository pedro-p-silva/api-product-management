<p align="center">
  <img width="460" height="350" src="https://pedropsilva.com.br/images/portfolio/projects/project_two.png">
</p>

# API Product Management
[![NPM](https://img.shields.io/npm/l/react)](https://github.com/pedro-p-silva/api-product-management/blob/main/LICENSE)

Essa API foi desenvolvida para aplicar alguns dos meus conhecimentos utilizando o framework Laravel. Com esse serviço, é possível efetuar o gerenciamento de produtos, podendo efetuar o cadastro, buscas avançadas, edições e exclusões desses produtos.<br>

Nesse projeto, foi utilizada a forma de autenticação JSON Web Token (JWT), visando uma maior segurança na troca de informações na WEB.<br>

Para uma maior facilidade em efetuar validações locais, os seeders e factories foram também previamente configurados, deste modo, para outros desenvolvedores que clonarem o projeto, não existe a necessidade de cadastrar os dados manualmente ao criar as migrations.

Importante salientar, quando um novo usuário é criado na API, um e-mail será disparado para ele, nesse ponto, foi utilizado o serviço de fila, isso foi pensado pois o usuário não precisará aguardar a resposta do servidor de e-mail, o que pode levar um certo tempo e impactar a experiência do usuário. Assim é só configurar um tempo para que as tarefas paradas na fila sejam executadas, e os e-mail serão disparados posteriormente.

## APIs utilizadas
* API para consultar usuários:<br>
  https://api.github.com/users/${name} [name] = Nome de usuário do GitHub, por exemplo (pedro-p-silva).

* API para consultar repositórios:<br>
https://api.github.com/users/${name}/repos [name] = Nome de usuário do GitHub.<br><br>

## Acessar o projeto
Veja: [Github Profile](https://github-profiles-ps.netlify.app/)
<br><br>

## Algumas IDEs recomendadas

* [VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (desabilitar o Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin).
* [WebStorm](https://www.jetbrains.com/pt-br/webstorm/)<br><br>

## Customizar Configurações

Veja: [Vite Configuration Reference](https://vitejs.dev/config/).<br><br>

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
  <img align="center" title="Typescript" alt="Pedro-Ts" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/typescript/typescript-plain.svg">
  <img align="center" title="Vue.js" alt="Pedro-Vue" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/vuejs/vuejs-original.svg">
  <img align="center" title="HTML 5" alt="Pedro-HTML" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg">
  <img align="center" title="CSS 3" alt="Pedro-CSS" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg">
</div>
