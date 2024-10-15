<?php

namespace hollisho\httpclient;


use hollisho\httpclient\Annotations\Action;
use hollisho\objectbuilder\HObject;

/**
 * @author Hollis
 * @desc
 * Class MethodVo
 * @package hollisho\httpclient
 */
class MethodVo extends HObject
{
    /** @var Action */
    public $action;

    /** @var array */
    public $requestOptions;

}