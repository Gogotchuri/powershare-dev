# PowerShare

## Installation

```
$ composer install
$ vagrant up
$ vagrant ssh
$ cd code
$ cp .env.example .env
$ php artisan migrate:fresh --seed
$ php artisan storage:link
$ php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"
```

