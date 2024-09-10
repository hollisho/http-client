<?php

namespace hollisho\httpclient\Annotations\Request\Headers;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Request\Contracts\ConfigurationAnnotationInterface;
use hollisho\httpclient\Constants\ConfigurationConstants;

/**
 * Class AuthBearer
 *
 * @Annotation
 * @Annotation\Target({"METHOD", "CLASS"})
 *
 * @package hollisho\httpclient\Annotations\Request\Headers
 */
Class AuthBearer extends Annotation implements ConfigurationAnnotationInterface
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $token;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    public function getValue()
    {
        return [
            'Authorization' => "Bearer {$this->getToken()}",
        ];
    }

    /**
     * Returns the corresponding guzzle configuration key.
     *
     * @return string
     */
    public function getConfigKey(): string
    {
        return ConfigurationConstants::HEADER_CONFIG_KEY;
    }
}