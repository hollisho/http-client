<?php
namespace hollisho\httpclientTests\Unit;

use hollisho\httpclientTests\Client\HttpClient;
use hollisho\httpclientTests\Middleware\AuthRequest;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function test()
    {
        $httpClient = new HttpClient('https://www.1024plus.com');
        $httpClient->pushMiddleware(new AuthRequest());
        $httpClient->httpPost('/category/springboot/');
        $this->assertTrue(true);
    }
}