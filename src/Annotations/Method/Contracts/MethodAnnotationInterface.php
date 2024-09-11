<?php
namespace hollisho\httpclient\Annotations\Method\Contracts;

/**
 * @author Hollis
 * @desc
 * Interface MethodAnnotationInterface
 * @package hollisho\httpclient\Annotations\Method\Contracts
 */
interface MethodAnnotationInterface
{
    /**
     * Returns the HTTP Method for the method annotation.
     *
     * @return string
     */
    public function getHttpMethod(): string;
}