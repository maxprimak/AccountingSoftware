call vendor\bin\phpunit Modules\Registration\Tests
call php artisan migrate:fresh --seed
call php artisan passport:install