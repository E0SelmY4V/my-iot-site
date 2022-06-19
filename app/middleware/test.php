<?php
namespace app\middleware;

class test
{
    public function handle($request, \Closure $next)
    {
        $request->test = 9982;
        return $next($request);
    }
}
