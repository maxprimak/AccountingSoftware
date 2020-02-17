<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        //\Barryvdh\Cors\HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            //'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        //middleware permissions Head & TopManager
        'admin' => \App\Http\Middleware\AdminMiddleware::class,

        //middleware employees
        'employee' => \App\Http\Middleware\EmployeesMiddleware::class,

        //registration middlewares
        'is_not_registered' => \Modules\Registration\Http\Middleware\IsNotRegistered::class,
        'is_registered' => \Modules\Registration\Http\Middleware\IsRegistered::class,

        'is_authorized' => \Modules\Login\Http\Middleware\IsAuthorized::class,

        'my_branch' => \Modules\Companies\Http\Middleware\MyBranch::class,
        'my_company' => \Modules\Companies\Http\Middleware\MyCompany::class,
        'my_customer' => \Modules\Customers\Http\Middleware\MyCustomer::class,
        'my_repair_order' => \Modules\Orders\Http\Middleware\MyRepairOrder::class,
        'my_sales_order' => \Modules\Orders\Http\Middleware\MySalesOrder::class,
        'my_order' => \Modules\Orders\Http\Middleware\MyOrder::class,
        'my_brand' => \Modules\Goods\Http\Middleware\MyBrand::class,
        'my_model' => \Modules\Goods\Http\Middleware\MyModel::class,
        'my_submodel' => \Modules\Goods\Http\Middleware\MySubmodel::class,
        'my_part' => \Modules\Goods\Http\Middleware\MyPart::class,
        'my_color' => \Modules\Goods\Http\Middleware\MyColor::class,
        'my_warehouse' => \Modules\Goods\Http\Middleware\MyWarehouse::class,
        'my_good' => \Modules\Goods\Http\Middleware\MyGood::class,
        'my_device' => \Modules\Devices\Http\Middleware\MyDevice::class,
        'my_employee' => \Modules\Employees\Http\Middleware\MyEmployee::class,
        'my_service' => \Modules\Services\Http\Middleware\MyService::class,
        'my_warehouse_has_good' => \Modules\Warehouses\Http\Middleware\MyWarehouseHasGood::class,

    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
