# Company

### Project setup steps:

- Copy and paste `.env.example` into `.env` file in root directory
  ```shell
  cp .env.example .env
  ```
- Run following commands:
  ```shell
  composer install
  php artisan key:generate
  ```
- Call [API](http://127.0.0.1:8000/api/users) from postman to get users details
