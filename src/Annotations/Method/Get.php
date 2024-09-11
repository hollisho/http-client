<?php

namespace hollisho\httpclient\Annotations\Method;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Method\Contracts\MethodAnnotationInterface;
use hollisho\httpclient\Constants\MethodConstants;

/**
 * Class Get
 *
 * Exposes the GET http method through annotation.
 *
 * @Annotation
 * @Annotation\Target({"METHOD"})
 *
 * @package hollisho\httpclient\Annotations\Method
 */
class Get extends Annotation implements MethodAnnotationInterface
{

    public function getHttpMethod(): string
    {
        return MethodConstants::HTTP_GET;
    }
}