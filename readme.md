# POWERSHARE

## Installation

```
$ composer install
$ vagrant up
$ vagrant ssh
$ cd code
$ cp .env.example .env
$ php artisan migrate:fresh --seed
$ php artisan storage:link
```

### Per project Vagrant

```
$ php vendor/bin/homestead make
$ vagrant up
$ vagrant ssh
$ sudo apt-get update
$ sudo apt-get install -y ifupdown
$ exit
$ vagrant reload
$ cd code
$ cp .env.example .env
$ php artisan migrate:fresh --seed
$ php artisan storage:link
$ npm install
$ npm run prod
```