call vendor\bin\phpunit Modules\Registration\Tests
call vendor\bin\phpunit Modules\Companies\Tests
call vendor\bin\phpunit Modules\Employees\Tests
call vendor\bin\phpunit Modules\Customers\Tests
call php artisan migrate:fresh --seed
call php artisan passport:install