echo Running Registration Block Tests
call vendor\bin\phpunit Modules\Registration\Tests

echo Running Companies Block Tests
call vendor\bin\phpunit Modules\Companies\Tests

echo Running Employees Block Tests
call vendor\bin\phpunit Modules\Employees\Tests

echo Running Customers Block Tests
call vendor\bin\phpunit Modules\Customers\Tests

echo Running Login Block Tests
call vendor\bin\phpunit Modules\Login\Tests

echo Running Migration / Installing Passport Clients
call php artisan migrate:fresh --seed
call php artisan passport:install