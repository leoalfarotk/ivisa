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
5. php artisan migrate
6. php artisan db:seed
7. docker-compose up -d
8. cd ..
9. cd frontend
10. npm install
11. npm run serve