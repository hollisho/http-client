<?php

namespace hollisho\httpclient\Annotations;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Request\Contracts\ConfigurationAnnotationInterface;
use hollisho\httpclient\Constants\ConfigurationConstants;

/**
 * Class ApiName
 *
 * @Annotation
 * @Annotation\Target({"CLASS"})
 *
 * @package hollisho\httpclient\Annotations
 */
class ApiName extends Annotation implements ConfigurationAnnotationInterface
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $name;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->name;
    }

    /**
     * Returns the corresponding guzzle configuration key.
     *
     * @return string
     */
    public function getConfigKey(): string
    {
        return ConfigurationConstants::API_NAME_CONFIG_KEY;
    }
}