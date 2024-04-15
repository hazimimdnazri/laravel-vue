# Dockerize Laravel + Vue

## How do I use it?

- Make sure you already install `docker` and `docker-compose`.
- Create another copy of the `.env.example` file and rename it to `.env`.  
- Run: 
    ```
    docker-compose up -d
    docker-compose exec app composer install --no-dev
    docker-compose exec app composer npm install
    docker-compose exec app chown www-data:www-data -R vendor storage
    docker-compose exec app npm run build
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate
    docker-compose exec app php artisan db:seed
    ```

- The application will be serving on your port 3000.
