<?php

namespace Modules\Employees\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Employees\Entities\Employee;
use Modules\Users\Entities\User;

class MyEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $employee_id = $request->route('employee_id');
        if(!Employee::where('id', $employee_id)->exists()){
            return response()->json([
                'error' => 'this employee does not exist'
            ],403);
        }
        $employee_company_id = Employee::find($employee_id)->getUser()->company_id;
        $my_company_id = auth('api')->user()->getCompany()->id;
        if($employee_company_id == $my_company_id){
            return $next($request);   
        }

        return response()->json([
            'error' => 'you do not have permission for this employee'
        ],403);
    }
}
