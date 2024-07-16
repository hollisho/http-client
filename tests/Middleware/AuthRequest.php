<?php
namespace hollisho\httpclient\tests\Middleware;

use Psr\Http\Message\RequestInterface;

class AuthRequest
{
    public function __invoke(callable $handler): callable
    {
        return function(RequestInterface $request, array $options) use($handler) {
            $apiKey = 'test';
            $apiPassword = 'test';
            $request = $request->withHeader(
                'Authorization',
                'Basic '.base64_encode("{$apiKey}:{$apiPassword}")
            );
            return $handler($request, $options);
        };
    }
}