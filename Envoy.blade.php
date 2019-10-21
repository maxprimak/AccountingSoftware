@servers(['localhost' => '127.0.0.1'])

@task('phpunit_customers')
     php artisan migrate:fresh --seed
     phpunit Modules/Customers --testdox
@endtask

@task('static_analyse_employees')
     vendor/bin/phpstan analyse Modules/Employees
     {{-- vendor/bin/psalm --init Modules/Employees/Http/Controllers 3 --}}
@endtask
