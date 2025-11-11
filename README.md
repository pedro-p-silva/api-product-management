# 🌐 API Event Publisher

Projeto desenvolvido em PHP com o framework Laravel, utilizando JWT (JSON Web Token) para autenticação e autorização de usuários.
Todo o ambiente é configurável e executável via Docker, facilitando o setup local e a integração entre serviços.

---

## 🚀 Tecnologias Utilizadas

- **PHP** (Laravel Framework)
- **JWT**
- **Composer**
- **Docker**
- **MySQL**

---

## 🧩 Pré-requisitos

Antes de iniciar, garanta que você tenha instalado em sua máquina:

- [PHP](https://www.php.net/)
- [Laravel](https://laravel.com/)
- [Docker](https://www.docker.com/get-started)
- [Composer](https://getcomposer.org/)

---

## ⚙️ Passo a passo para executar o projeto

### 1. Clone o repositório

```bash
git clone https://github.com/pedro-p-silva/api-event-publisher.git
cd api-event-publisher
```

### 2. Configure as variáveis de ambiente

```bash
cp .env.example .env
```

### 3. Build e subida dos containers (Docker)
```bash
docker compose up -d --build
```

### 4. Instalar as dependências do projeto
```bash
docker exec -it laravel-app bash
composer install
```

### 5. Gere a chave da aplicação
```bash
php artisan key:generate
```

### 6. Execute as migrações do banco de dados
```bash
php artisan migrate
```

### 7. Gere a chave secreta JWT
```bash
php artisan jwt:secret
```

---
## 🤝 Integrações

Este projeto é responsável por publicar notificações em um tópico SNS da AWS e por realizar o upload de imagens no S3 durante o processo de criação de um novo usuário.
Para que essas funcionalidades funcionem corretamente, é necessário utilizar em conjunto o projeto [mail-consumer](https://github.com/pedro-p-silva/mail-consumer).
A Mail Consumer é o serviço responsável por criar e configurar os recursos AWS necessários — como o tópico SNS, a fila SQS e o bucket S3 — além de validar e processar as mensagens recebidas na fila. Após o processamento, ele também é responsável por enviar o e-mail de boas-vindas ao novo usuário.

Este projeto (api-event-publisher) atua como emissor dos eventos, sendo responsável por publicar as mensagens no tópico SNS e efetuar o upload da imagem de perfil do usuário no S3, permitindo assim a integração completa com a Mail Consumer.

---
## 📘 Documentação
Consulte os endpoints e exemplos de requisições no link:
[API Doc Swagger](http://localhost/api/documentation)
