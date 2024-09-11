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