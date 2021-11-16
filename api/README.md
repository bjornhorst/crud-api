
<p align="center">
    Artist and songs crud application via api
</p>

## About this project

This project was a assignment for school. I had to make a one to many crud application via a api 


## Installation

Run ``
  composer install
  `` in both laravel projects.

After that modify the env file with your database credentials.

When you have the .env with your database connection set up you can run your migrations

make sure to run the following command in the api project
``
php artisan migrate
``

after the migrations are done. You can run the database seeder for some dummy data.

``
php artisan db:seed --class=ArtistSongSeeder
``
