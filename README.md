1) composer create-project "laravel/laravel:^10.0" laravel-vue
2) cd laravel-vue
3) composer require laravel/sail --dev
4) php artisan sail:install 
5) Adjust environment variables
6) ./vendor/bin/sail up -d
7) sudo chmod -R 775 storage
   sudo chmod -R 775 docker
8) docker compose exec --user root laravel.test bash
9) php artisan sail:publish
10) php artisan migrate
11) ./vendor/bin/sail shell
12) composer require inertiajs/inertia-laravel:^1.3.2
13) php artisan inertia:middleware
14) npm install @inertiajs/inertia @inertiajs/inertia-vue3
15) npm install vue@latest
16) npm i @vitejs/plugin-vue
17) npm install
18) npm run dev
19) access the frontend at http://localhost:<port>

Implementations:

a) use of Inertia form helper, to protect system from user spamming the submit button;
b) Disabling of submit button after first submission;
b) client and server inputs protection and validation;
c) authentication at server-side;
d) form requests for better validation;
e) single action controllers for better decoupling;
f) docker orchestration for better productivity;
g) parameter typing and functions return typing;
h) applying PSR-12 at PHP;
i) logging main CRUD executions for monitorability;
j) real time search without page full reload;
k) implementation of seeder;
l) implementation of factories;
m) implementation of native debounce function to limit the number of requests from search;
n) 

