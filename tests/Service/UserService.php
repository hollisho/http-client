<?php
namespace hollisho\httpclientTests\Service;

use hollisho\httpclient\Annotations\Action;
use hollisho\httpclient\Annotations\BaseUrl;
use hollisho\httpclient\Annotations\Method\Get;
use hollisho\httpclient\Annotations\Method\Post;
use hollisho\httpclient\Annotations\Request\Body;
use hollisho\httpclient\Annotations\Request\Endpoint;
use hollisho\httpclient\Annotations\Request\Headers;
use hollisho\httpclient\Annotations\Request\Headers\AuthBasic;
use hollisho\httpclient\Annotations\Request\Headers\CustomHeader;
use hollisho\httpclient\Annotations\Middleware;
use hollisho\httpclient\Annotations\Middlewares;
use hollisho\httpclientTests\Middleware\TestMiddleware;
use hollisho\httpclientTests\Middleware\AuthRequest;

/**
 * @author Hollis
 * Interface UserService
 *
 * @BaseUrl(host="https://www.1024plus.com/")
 * @Middlewares({
 *     @Middleware(value=TestMiddleware::class),
 *     @Middleware(value=TestMiddleware::class)
 * })
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
     *     endpoint=@Endpoint(uri="/entry_list")
     * )
     */
    public function getUser($id);

    /**
     * @Action(
     *     method=@Post,
     *     endpoint=@Endpoint(uri="/resource"),
     *     body=@Body(json=true, name="body")
     * )
     *
     * @Middlewares({
     *     @Middleware(value=TestMiddleware::class),
     *     @Middleware(value=AuthRequest::class)
     * })
     */
    public function createUser($data);
}