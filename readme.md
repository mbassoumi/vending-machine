## Notes
- To change money storage in the vending machine: go to money table in database and change the amount value.
- To check your answer make sure you have enough change on the vending machine
- To check your answer make sure you have enough quantity of the selected snack in the vending machine

## Messages
- not enough money [when you havn't entered enough money]
- not enough change [when the vending machine doesn't have enough change]
- not enough quantity [when the snack is out of stock]
- have a sweet snack [when every things is ok] 

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
