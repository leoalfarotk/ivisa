## iVisa - My Cards module

### Requirements

* docker & docker-compose (for development)
* php 7.2
* node & npm

### Deployment

1. cd backend
2. composer install
3. cp .env.example .env (if it wasn't created by the post-installation composer script)
4. php artisan key:generate (if it wasn't set by the post-installation composer script)
5. set database address, name, and credentials in .env file (will depend on local set up)
6. docker-compose up -d (if using docker & docker-compose)
7. php artisan migrate (if using docker: docker exec `name_of_php_container` php artisan migrate)
8. php artisan db:seed (if using docker: docker exec `name_of_php_container` php artisan db:seed)
9. cd ..
10. cd frontend
11. npm install
12. npm run serve