<?php

namespace Etherbase\Core\Plugin\Middleware;

use Closure;

class Plugin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // TODO: Get theme from user settings or system setting, or env or default....
        \Plugin::init();
        \Plugin::do_action('init');
        return $next($request);
    }

}
