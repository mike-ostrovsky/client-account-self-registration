## Development:
#### Worksation Requirements:

- [Docker](https://docs.docker.com/)
- [Docker-Compose](https://docs.docker.com/compose/install/)

#### Preparation:
- Pull the project
- Open the project in your favorite IDE/TextEditor
- Copy .env.example to .env
- Configure the .env file
- Run the following commands:
```bash
echo DOCKER_USER=$USER >> .env
echo DOCKER_UID=$UID >> .env
```
### Run via docker:

##### Initial setup phase:

- Run the following commands from the project directory
```bash
docker-compose up -d --build
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
rm -rf ./public/storage
rm -rf ./public/logos
docker-compose exec app php artisan migrate
```
- Visit [http://localhost:8000](http://localhost:8000)
