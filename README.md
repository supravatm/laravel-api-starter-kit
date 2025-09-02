
<h1 align="center">
Laravel Rest API Starter Kit with Docker
</h1>

<p align="center"><img src="public/img/laravel-and-docker.webp" width="400" alt="Laravel + Docker"></p>

<h5 align="center">
A Laravel & Docker Development Setup
</h5>

## Install

Clone repo

```
git clone git@github.com:supravatm/laravel-v12-api-starter.git
```
To install your dependencies run the following in your project directory all you need is this one liner —
```
docker run --rm -v "$(pwd)":/app composer install
```
inside your .env file, you want to update the following environment variables as follows —

```
DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=dbuser
DB_PASSWORD=dbpassword
```
Make your way into your project directory and run Compose’s up command:
```
docker-compose up -d
```
Run the following commands in your console/terminal —
```
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan optimize
docker-compose exec app php atrisan session:table
docker-compose exec app php artisan migrate
docker-compose exec app php artisan clear:cache
```

## API Documentation
<p align="center">
    <img align="center" src="https://raw.githubusercontent.com/supravatm/laravel-v12-api-starter/main/public/img/postment-document-screenshot.png" alt="Preview" width="80%" />

</p>
</br>
<p style="font-weight: bold;">
Complete REST API Documentation can be found <a href="https://documenter.getpostman.com/view/497605/2sB3BLjnwZ" target="_blank" rel="noopener noreferrer">here</a>
</p>

## License

[MIT](https://opensource.org/licenses/MIT)
