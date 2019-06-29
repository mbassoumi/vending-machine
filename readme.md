## Run Project

- clone it to your local machine
```
git clone https://github.com/mbassoumi/vending-machine.git
```

- run 
```
composer install
```

- copy .env.example to .env in same directory and change database configuration
- run 
```
php artisan migrate:fresh --seed
```

- run command 
```
php artisan serve
```

- start play with it


## Run test cases

```
cd vending-machine
vendor/bin/phpunit 
```
