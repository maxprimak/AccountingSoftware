<?php

namespace Modules\Goods\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Goods\Entities\Color;

class MyColor
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
        $color_id = $request->route('color_id');
        $colors = Color::all();
        if($colors->contains('id', $color_id)){
            return $next($request);
        }
        else{
            return response()->json([
                'error' => 'color_id is invalid'
            ],403);
        }
    }
}
