1) composer create-project "laravel/laravel:^10.0" laravel-vue
2) cd laravel-vue
3) composer require laravel/sail --dev
4) php artisan sail:install 
5) Adjust environment variables
6) ./vendor/bin/sail up -d
7) sudo chmod -R 775 storage
   sudo chmod -R 775 docker
8) sudo chown -R $USER:www-data storage
   sudo chown -R $USER:www-data docker
9) docker compose exec --user root laravel.test bash
10) php artisan sail:publish
11) php artisan migrate
12) 
