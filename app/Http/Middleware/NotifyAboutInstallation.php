<?php

namespace App\Http\Middleware;

use Closure;

class NotifyAboutInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        alert('', _p('pages.alerts.install_demo', 'You can always install this demo locally, via Docker or quick installer. <a href="https://github.com/awes-io/demo" style="color:white;">Install now</a>'), 'info')->to('header');

        return $next($request);
    }
}
