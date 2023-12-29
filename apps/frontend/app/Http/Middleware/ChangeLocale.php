<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ChangeLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User|null $user */
        $user = $request->user();

        if ($user !== null) {
            // Change the app language by the chosen user language
            config(['app.locale' => $user->language]);
        } else {
            if ($request->hasCookie('language')) {
                // Change the app language by the chosen user language
                config(['app.locale' => $request->cookie('language')]);
            }
        }

        return $next($request);
    }
}
