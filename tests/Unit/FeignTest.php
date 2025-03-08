<?php
namespace hollisho\httpclientTests\Unit;

use hollisho\httpclient\Feign\FeignClientFactory;
use hollisho\httpclientTests\Middleware\TestMiddleware;
use hollisho\httpclientTests\Service\UserService;
use PHPUnit\Framework\TestCase;

class FeignTest extends TestCase
{
    public function test()
    {
        // create feign client
        /** @var UserService $client */
        $client = FeignClientFactory::create(UserService::class);
        $response = $client->getUser(1, 'Ho');
        $this->assertTrue($response->getStatusCode() === 200);
    }

    public function testClassLevelMiddleware()
    {
        /** @var UserService $client */
        $client = FeignClientFactory::create(UserService::class);
        TestMiddleware::reset();
        
        $this->assertFalse(TestMiddleware::$called);
        
        try {
            $client->getUser(1);
        } catch (\Exception $e) {
            // 在捕获异常后立即检查 $called 状态
            $this->assertTrue(TestMiddleware::$called, 'Middleware should be called even if request fails');
            return;
        }
        
        $this->assertTrue(TestMiddleware::$called);
    }

    public function testMethodLevelMiddleware()
    {
        /** @var UserService $client */
        $client = FeignClientFactory::create(UserService::class);
        TestMiddleware::reset();
        
        $this->assertFalse(TestMiddleware::$called);
        
        try {
            $client->createUser(['id' => 123, 'username' => 'ho']);
        } catch (\Exception $e) {
            // 在捕获异常后立即检查 $called 状态
            $this->assertTrue(TestMiddleware::$called, 'Middleware should be called even if request fails');
            return;
        }
        
        $this->assertTrue(TestMiddleware::$called);
    }
}