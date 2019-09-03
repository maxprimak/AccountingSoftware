@servers(['localhost' => '127.0.0.1'])

@task('phpunit_customers')
     php artisan migrate:fresh --seed
     phpunit Modules/Customers --testdox
@endtask
