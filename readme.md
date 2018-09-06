# How to
- $ cp .docker/.env.example .docker/.env
- $ cp .env.example .env
## Project .env:
- DB_CONNECTION=mysql
- DB_HOST=database
- DB_PORT=3306
- DB_DATABASE=mmt
- DB_USERNAME=root
- DB_PASSWORD=root
## How to build
- cd .docker folder
- $ docker-compose up -d --build
- $ docker exec -it php bash
- $ composer install && npm install; php artisan migrate && npm run prod
## How to test
- cd .docker folder
- $ docker exec -it php bash
- $ vendor/phpunit/phpunit/phpunit