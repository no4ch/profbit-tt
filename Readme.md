# Test task source code for ProfBIT

## Setup steps
* Install docker/docker-compose
* Clone this project to your `projectDir`
* Move to `projectDir/docker`
* Run `docker-compose up -d --build`
* Create .env file `docker-compose exec app cp .env.example .env`
* Run `docker-compose exec app composer install`
* Create DB `docker-compose exec app php bin/console doctrine:database:create`
* Run migrations `docker-compose exec app php bin/console doctrine:migrations:migrate`
* Run `docker-compose exec app php bin/console doctrine:fixtures:load`
* Go `http://localhost/products`

## Using steps
Use bottom buttons for next/previous page (button shows if page are available).
Use links in table for sorting products by fields and directions (ask/desc)
