# Project Laravel - Inertia/Vuejs
### Developer: Attila Barcellos Sipos (GitHub: AttilaBS)

## Technologies used:
* Laravel 10 with Sail
* PHP 8.3
* Postgresql 15
* PEST 2

* Tailwindcss 4
* Vite 5
* Inertia 1
* Pinia 2
* Vue 3

## Some technical and architectural decisions:
* Even though I often use repository pattern with PHP/Laravel with positive results, didn't use at this project, to avoid overengineering, taking in consideration its simplicity;
* Used componentization at Inertia Pages to comply with DRY and for code consistency;
* To avoid complex bugs that come with caching strategies, opted to clean all user caches when products are created, changed, deleted or when the user logs out;
* Used MVC with SOA for logic abstraction, keeping in mind the project scope;
* Applied, much as possible, KISS, S of SOLID, Clean Code, PSR-12, and other recommended practices by the community;
* Created a authorization policy that forbids users that are not admins (is_admin boolean column) to edit or delete products, in a hypothetical scenario where there is need for control over that operations. For security reasons, the is_admin parameter can't be passed from frontend;
* Applied a rule where only the user that created a product is able to see it, reproducing a business rule that I see often at real projects;
* Used Pinia for management of the user logged-in state, for a global and unified state across the project;
* One of the uses of Inertia features was the search function without page reloading. To avoid excessive number of requests, created a debounce function to limit the number of requests per search in a way that it doesn't overload the server.

## Installation instructions:

1) git clone git@github.com:AttilaBS/laravel-vue.git
2) cd laravel-vue
3) composer install
4) cp .env.example .env
5) php artisan sail:install (unselect mysql, select: pgsql and redis with space bar)
6) ./vendor/bin/sail up -d (use sudo if needed)
7) docker compose exec --user root laravel.test bash (use sudo if needed)
8) php artisan sail:publish
9) php artisan migrate
10) php artisan db:seed
11) php artisan key:generate
12) npm install
13) npm run dev
14) access the frontend at http://localhost:{port}
15) Run the tests with php artisan test inside laravel.test container
16) If you want to test admin user at application, log-in with credentials: admin-user@email.com and pass: 12345678

## Worth Highlighting Implementations:

#### a) use of Inertia form helper, to protect system from user spamming the submit button;
#### b) Disabling of submit button after first submission;
#### c) authentication at server-side;
#### d) Laravel form requests for better scope validation;
#### e) single action controllers for better decoupling;
#### f) docker orchestration for better productivity;
#### g) parameter and functions return typing;
#### h) applying PSR-12 at PHP;
#### i) logging main CRUD executions for monitorability;
#### j) real time search without page full reload;
#### k) implementation of seeder;
#### l) implementation of factories;
#### m) implementation of native JS debounce function to limit the number of requests per search;
#### n) implementation of authorization with Laravel Policy;
#### o) backend pagination completely functional;
#### p) database seeder that works perfectly with policy logic;
#### q) use of Tailwind for styling for better productivity;
#### r) use of foreign key at migration and constraint for data integrity;
#### s) addition of foreign key in a separate migration, for rollback without issues;
#### t) componentization of flash messages alerts;
#### u) Protection for routes with policies at server side;
#### v) use of Eloquent Attribute (accessor);
#### w) use of soft delete at users and products;
#### x) implementation of user register, login and logout routes;
#### y) implementation of redis cache at products list for faster navigation where is needed, with ttl and flush at logout;
#### z) implementation of integration tests for users and products with pest;
#### z1) use of pinia for global state management of logged-in user;
#### z2) use of Eloquent Observer for cache cleaning at product change, addition or deletion;
#### z3) client and server inputs protection and validation;
#### z4) Error handling at main controllers;
#### z5) Hashing of passwords, using the secure bcrypt algorithm.
