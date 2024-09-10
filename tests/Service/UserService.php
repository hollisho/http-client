<?php
namespace hollisho\httpclientTests\Service;

use hollisho\httpclient\Annotations\Method\Get;
use hollisho\httpclient\Annotations\Method\Post;

interface UserService
{
    /**
     * @Action(
     *     method=@Get,
     *     endpoint=@Endpoint(uri="/resource")
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