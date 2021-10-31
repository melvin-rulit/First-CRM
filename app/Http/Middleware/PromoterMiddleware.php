<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PromoterMiddleware
{

    public function handle($request, Closure $next)
    {
        $op = Auth::id();

        if ($op !== 1 && $op !== 9) {

            return redirect()->route('promouter');

        } else if ($op !== 1 && $op == 9){

            return redirect('/addAdress');
        }

    return redirect('home');
    }
}
