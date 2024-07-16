<?php
namespace hollisho\httpclient\tests\Unit;

use hollisho\httpclient\tests\Client\HttpClient;
use hollisho\httpclient\tests\Middleware\AuthRequest;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function test()
    {
        $httpClient = new HttpClient('https://www.1024plus.com');
        $httpClient->pushMiddleware(new AuthRequest());
        $httpClient->httpPost('/test');
        $this->assertTrue(true);
    }
}