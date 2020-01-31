#!/bin/bash
docker-compose exec php composer install
docker-compose exec php bin/console doctrine:migrations:migrate --env=dev
docker-compose exec php bin/console doctrine:migrations:migrate --env=test
docker-compose exec php bin/console doctrine:fixtures:load --env=dev
docker-compose exec php bin/console doctrine:fixtures:load --env=test
docker-compose exec php bin/phpunit