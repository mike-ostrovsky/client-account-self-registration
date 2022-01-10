docker-compose up -d --build
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
rm -rf ./public/storage
rm -rf ./public/logos
docker-compose exec app php artisan migrate