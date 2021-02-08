Для развёртывания приложения необходимо склонировать репозиторий.

Далее необходимо создать файлы конфигов на основе существующий примеров.

db.php, memcache.php, params-local.php

В файле db.php нужно настроить соединение с базой данных и поднять миграции:

php yii migrate --migrationPath=@yii/rbac/migrations/

php yii migrate

И подтянуть зависимости через Composer:

composer update