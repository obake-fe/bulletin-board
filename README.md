# bulletin-board

## Version
- PHP 8.1
- Composer 2.2
- Laravel 9.*
- nginx 1.2
- mysql 8.0

## Start
```shell
$ cp src/.env.example src/.env
$ docker-compose up -d
$ docker-compose exec web bash
$ composer install
$ php artisan key:generate
$ php artisan optimize
$ php artisan migrate
```

## Seeding
```shell
$ php artisan db:seed  // add 50 dummy data
```

## URL
- http://localhost:8080

## Reference
- [【超入門】20分でLaravel開発環境を爆速構築するDockerハンズオン | Qiita](https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4)