#### Tax Application description:

- First level are countries listing, showing on main page
- Second level are states, which are listed on a country page. Besides this, on a country page outputs overall
  information about all incomes for every county, which is included to state, which is a state of a current country.
  Also, on a country page we can see Average Country Tax Rate, which are calculated by all state's counties tax rates	
- Third level is a state page. We can see Average State Tax Rate and Average and Total Incomes on this page.
- Fourth level is a county page. It's just outputs the name of a county without any additional information.

#### How to initialize Tax Application and StringTools class with unit tests:

##### For Tax Application:

I've configured docker for this application, if you use it, then:
- `docker-compose build`
- `docker-compose up`
At the same time, in another terminal tab:
- `./init.sh`
Application will be available at `http://127.0.0.1:9008/`
How to run phpunit tests: just run `bin/phpunit`

If you don't use a docker, you should configure apache server (I've used php 7.2) on public/ folder from root 
folder of project, then create two databases: first one is main database, second one just for testing purposes. 
Just update `.env` file DATABASE_URL parameter according to your mysql database connection and
just do the same for `.env.test` file.
Then:
- `composer install`
Schema migrations:
- `php bin/console doctrine:migrations:migrate --env=dev`
- `php bin/console doctrine:migrations:migrate --env=test`
Load fixtures from different source to Database:
- `php bin/console doctrine:fixtures:load --env=dev`
- `php bin/console doctrine:fixtures:load --env=test`
Run PHP Unit tests:
- `php bin/phpunit`

##### For String Tools Class:
- `composer install`
- `./vendor/bin/phpunit tests`