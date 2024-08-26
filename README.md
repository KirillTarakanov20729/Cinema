
# Cinema

API на Laravel для кинотеатра. 


## Installation

Установка стандартная. Для удобства написан Dockerfile и docker-compose.yml

```bash
  npm install
  composer install
  cp .env.example .env
```
    
## Documentation

В проекте реализовано:

 * Слой DTO c помощью библиотеки от [Spatie](https://github.com/spatie/data-transfer-object)
 * Работа с Enum с помощью библиотеки от [BenSampo](https://github.com/BenSampo/laravel-enum)
 * Архитектура DDD
 * Подключен Stripe для платежей
 * Event и Listener классы
 * Listener и отправка Notification сделана через Jobs
 * Документация через Swagger


## Usage/Examples

Наполнение БД тестовыми данными 
```
php artisan db:seed
```

