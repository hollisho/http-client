<?php

namespace hollisho\httpclient\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Middleware
 *
 * @Annotation
 * @Annotation\Target({"METHOD", "CLASS"})
 *
 * @package hollisho\httpclient\Annotations
 */
class Middleware extends Annotation
{
    /**
     * @var string
     */
    public $value;


    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Returns the corresponding to guzzle configuration key.
     *
     * @return string
     */
    public function getConfigKey(): string
    {
        return "";
    }

}