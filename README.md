## Install

``` bash
$ composer require hollisho/http-client
```

## TestCase

1. 执行指定目录所有用例

```sh
$ ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml
```

2. 执行指定文件

```sh
$ ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml --test-suffix RequestTest.php
```

3. 执行 RequestTest 用例

```sh
$ ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml --filter RequestTest
```

4. 执行 RequestTest::test 用例

```sh
$ ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml --filter RequestTest::test
```

## Basic Use
```php
$httpClient = new BaseClient('https://www.1024plus.com');
$httpClient->pushMiddleware(new AuthRequest());
$httpClient->httpPost('/category/springboot/');
```


## Use Annotation
```php
/**
 * @author Hollis
 * Interface UserService
 *
 * @BaseUrl(host="https://www.1024plus.com/")
 *
 * @package hollisho\httpclientTests\Service
 */
interface UserService
{
    /**
     * @Headers(headers={
     *     @AuthBasic(username="override", password="override"),
     *     @CustomHeader(name="x-override", body="test")
     * })
     *
     * @Action(
     *     method=@Get,
     *     endpoint=@Endpoint(uri="/api/entry/{id}")
     * )
     */
    public function getUser($id);

    /**
     * @Action(
     *     method=@Post,
     *     endpoint=@Endpoint(uri="/resource"),
     *     body=@Body(json=true, name="body")
     * )
     */
    public function createUser($data);
}


// 生成 FeignClient 实例
$client = FeignClientFactory::create(UserService::class);
echo $client->getUser(1);
```
