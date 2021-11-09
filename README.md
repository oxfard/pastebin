# Laravel 8 Pastebin App
Простое приложение на Laravel 8. Реализует базовый функционал сервиса Pastebin.com.

## Возможности
* Регистрация прямая и через ВК
* Подсветка кода
* Просроченные пасты не видны, не редактируемы
* Unlisted доступны только по прямой ссылке
* Зарегестрированному доступны private пасты
* Автор видит свои пасты в разделе /my и может редактировать их. Реализована пагинация.

## Не реализавано
* Поиск
* Тесты
* Упаковка в контейнер

## Системные  требованиями
* PHP 7.3+
* MySQL 5.7+

## Установка
Клонируем репозиторий

    git clone https://github.com/oxfard/pastebin.git

Заходим в папку проекта

    cd pastebin

Устанавливаем зависимости

    composer install

В .env заполняем переменные окружения

	APP_URL=
    
    DB_CONNECTION=mysql
	DB_HOST=
	DB_PORT=3306
	DB_DATABASE=
	DB_USERNAME=
	DB_PASSWORD=

Открыть дирректории на запись

	/storage/logs
	/storage/framework/sessions
	/storage/framework/views

Выполнить миграции

	php artisan migrate

Настройка ВК-авторизации

	зарегестрировать приложение в https://vk.com/apps?act=manage

В .env заполнить 

    VKONTAKTE_CLIENT_ID=
    VKONTAKTE_CLIENT_SECRET=

Собрать фронт

    npm install
    
