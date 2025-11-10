# ⚙️ API Event Publisher

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

🤝 Integrações

Se estiver utilizando outros serviços integrados (como envio de e-mails, S3 ou SNS/SQS via LocalStack), lembre-se de configurar corretamente as variáveis de ambiente correspondentes no .env.
