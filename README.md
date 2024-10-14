# PHP

Инструкция использования:  
cd ./docker

docker compose build — собрать проект  
docker compose up -d — запустить проект  
docker compose down — остановить проект  
docker compose logs -f [service name] — посмотреть логи сервиса  
docker compose ps — вывести список контейнеров  
docker compose exec [service name] [command» — выполнить команду в контейнере  
docker compose images — список образов  
docker exec -it [your_project_php_1] bash - зайти внутрь контейнера  
docker-compose down -v - удалить все сети и тома(volumes, даже БД)

Особенности:  
composer dump-autoload - запуск внутри контейнера php для обновления namespace

```
