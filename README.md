# Требования

* Установленный [node-js](https://nodejs.org/en/download/).
* Установленный [composer](https://getcomposer.org/download/).
* Установленный [Docker](https://docs.docker.com/engine/install/).
* Установленный [PHP](https://www.php.net/downloads.php) версии 8.0.2 или выше.

# Установка

### Клонирование репозитория
* Клонировать репозиторий `git clone https://github.com/piece-of-me/catalog.git`;
* Перейти в папку catalog `cd catalog`;

### Установка пакетов и зависимостей
* Скопировать переменные окружения `cat .env.example > .env`;
* Установить пакеты и зависимости с помощью `npm install`;
* Установить зависимости с помощью `composer install`;

# Запуск приложения
* Собрать и запустить приложение с помощью `docker-compose up -d`;
* Запустить миграции с помощью `docker exec -it app php artisan migrate --seed`;

### [Swagger](http://localhost:8000/api/documentation#)