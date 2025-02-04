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
12) ./vendor/bin/sail shell
13) composer require inertiajs/inertia-laravel:^1.3.2
14) php artisan inertia:middleware
15) add \App\Http\Middleware\HandleInertiaRequests::class to web middleware group at app/Http/Kernel.php
16) npm install @inertiajs/inertia @inertiajs/inertia-vue3
17) npm install vue@latest
18) npm i @vitejs/plugin-vue
19) npm install
20) npm run dev


