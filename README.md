#### Installation instructions:


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
11) php artisan db:seed
12) ./vendor/bin/sail shell
13) composer require inertiajs/inertia-laravel:^1.3.2
14) php artisan inertia:middleware
15) npm install @inertiajs/inertia @inertiajs/inertia-vue3
16) npm install vue@latest
17) npm i @vitejs/plugin-vue
18) npm install
19) npm run dev
20) access the frontend at http://localhost:<port>

#### Worth Highlighting Implementations:

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
n) implementation of authorization with Laravel Policy;
o) backend pagination completely functional;
p) database seeder that works perfectly with policy business rule;
q) use of Tailwind for styling for better productivity;
r) use of foreign key at migration and constraint for data integrity;
s) addition of foreign key in a separate migration, for rollback without issues;
t) componentization of flash messages alerts;
u) Protection for routes with policies at server side;
v) use of Eloquent Attribute (accessor);
w) use of soft delete at users and products;
x) implementation of user register, login and logout routes;
y) implementation of redis cache with ttl and flush at logout for faster navigation where is needed
z)

