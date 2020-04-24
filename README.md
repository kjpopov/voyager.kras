# voyager.kras
A voyager/laravel web academy

# Howto install fresh voyager app

1. Comment server start command: in docker-compose.yml
2. Uncomment server install command
3. `docker-compose up --build laravel`
4. Swap comments again
5. `docker-compose up`
6. `docker-compose exec laravel bash`
7. ```
bash-5.0# php artisan voyager:install --with-dummy
```
