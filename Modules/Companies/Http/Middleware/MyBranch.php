<?php

namespace Modules\Companies\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Companies\Entities\Branch;
use Modules\Users\Entities\User;


class MyBranch
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
        $company_id = User::where('login_id', auth('api')->user()->id)->firstOrFail()->company_id;
        $branches = Branch::where('company_id', $company_id)->pluck('id')->toArray();
        $branch_id = $request->route('branch_id');
        if(in_array($branch_id, $branches)){
            return $next($request);
        }else{
            return response()->json(['error' => 'You do not have permission to this branch or this branch does not exist'], 403);
        }
        return $next($request);
    }
}
