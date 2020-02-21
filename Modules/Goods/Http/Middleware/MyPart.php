<?php

namespace Modules\Goods\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Goods\Entities\Part;
use Modules\Goods\Entities\CompanyHasPart;

class MyPart
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
        $part_id = $request->route('part_id');

        if($part_id == "null"){

            return response()->json(Part::getWithoutPartText(), 200);

        }

        $default_parts = Part::where('is_custom',0)->get();

        if($default_parts->contains('id', $part_id)){
            return $next($request);
        } 

        $part_ids = CompanyHasPart::where('company_id', auth('api')->user()->getCompany()->id)->pluck('part_id')->toArray();
        $parts = Part::whereIn('id', $part_ids)->get();

        if($parts->contains('id', $part_id)){
            return $next($request);
        }

        return response()->json(['error' => 'You do not have permission to this part or it does not exist'], 403);
    }
}
