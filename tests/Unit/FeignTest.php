<?php
namespace hollisho\httpclientTests\Unit;

use hollisho\httpclient\Feign\FeignClientFactory;
use hollisho\httpclientTests\Service\UserService;
use PHPUnit\Framework\TestCase;

class FeignTest extends TestCase
{
    public function test()
    {
        // 生成 FeignClient 实例
        $client = FeignClientFactory::create(UserService::class);
        echo $client->getUser(1, 'Ho');
    }
}