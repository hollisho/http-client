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
