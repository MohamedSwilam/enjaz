# Requirements
1. PHP 8.0+
2. MySQL

## Project Setup
### Setup laravel
#### Create .env file as a copy from .env.example and setup MySQL env variables in .env file
#### Login to [Mail Trap](https://mailtrap.io/) and update mail env variables in .env file
```sh
composer install
```

```sh
php artisan migrate
```

```sh
php artisan db:seed
```

```sh
php artisan passport:install
```

#### Update APP_CLIENT_SECRET env variable in .env file with the displayed secret key of client ID 2 displayed from the last command.

#### Import postman collection in postman folder and update base_url and APP_CLIENT_SECRET in collection environment variables

### Test Accounts
#### Super Admin:
```
Email: mohamed_swilam@hotmail.com
Password: password
```

#### Normal User: (gets 2% price discount)
```
Email: normal-user@test.com
Password: password
```

#### Silver User: (gets 5% price discount)
```
Email: silver-user@test.com
Password: password
```

#### Gold User: (gets 10% price discount)
```
Email: silver-user@test.com
Password: password
```
