<?php

namespace hollisho\httpclientTests\Middleware;

use Psr\Http\Message\RequestInterface;

class TestMiddleware
{
    public static $called = false;

    public function __invoke(callable $handler): callable
    {
        return function(RequestInterface $request, array $options) use($handler) {
            self::$called = true;
            
            try {
                return $handler($request, $options);
            } catch (\Exception $e) {
                self::$called = true;
                throw $e;
            }
        };
    }

    public static function reset()
    {
        self::$called = false;
    }
} 