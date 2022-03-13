# テスト
## セットアップ
1. `db`コンテナに接続
```
docker-compose exec db bash
```
2. `root`ユーザーでmysqlに接続
```
mysql -u root -p
```
3. テスト用のDBを作る
```
CREATE DATABASE laravel_test;
```
4. ログインユーザーに全権限を付与する
```
GRANT ALL on laravel_test.* to phper@'%';
```
5. `web`コンテナに接続
```
docker-compose exec web bash
```
6. テスト用DBでmigrate実行（`--env=testing`オプションを付与することで、`env.testing`を読み込んでテスト用DBに接続できる)
```
php artisan migrate:refresh --env=testing
```

## 実行
### 全体テスト実行
```
php artisan test
```
