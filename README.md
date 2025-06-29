## Install

``` bash
$ composer require hollisho/http-client
```

## AnnotationRegistry

```php
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

// 注册 Doctrine 注解，为 PHP 8.0 做特殊处理
if (PHP_VERSION_ID >= 80000) {
    // PHP 8.0+ 需要明确注册注解命名空间
    if (class_exists('Doctrine\Common\Annotations\AnnotationRegistry')) {
        // 注册类加载器
        AnnotationRegistry::registerLoader('class_exists');
        
        // 显式注册 hollisho 的注解命名空间
        if (method_exists(AnnotationRegistry::class, 'registerAutoloadNamespace')) {
            AnnotationRegistry::registerAutoloadNamespace(
                'hollisho\httpclient\Annotations', 
                dirname(__FILE__) . '/vendor/hollisho/http-client/src/Annotations'
            );
        }
    }
} else {
    // PHP 7.x
    if (method_exists(AnnotationRegistry::class, 'registerLoader')) {
        AnnotationRegistry::registerLoader('class_exists');
    }
}
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
    public function createUser($body);
}


// 生成 FeignClient 实例
$client = FeignClientFactory::create(UserService::class);
echo $client->getUser(1);
```
