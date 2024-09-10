<?php
namespace hollisho\httpclientTests\Unit;

use hollisho\httpclient\FeignFactory;
use hollisho\httpclientTests\Service\UserService;
use PHPUnit\Framework\TestCase;

class FeignTest extends TestCase
{
    public function test()
    {
        // 生成 FeignClient 实例
        $client = FeignFactory::create(UserService::class);
        echo $client->getUser(1);
    }
}