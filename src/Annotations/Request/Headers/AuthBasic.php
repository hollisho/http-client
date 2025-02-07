<?php
namespace hollisho\httpclient\Annotations\Request\Headers;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Annotations\Request\Contracts\ConfigurationAnnotationInterface;
use hollisho\httpclient\Constants\ConfigurationConstants;

/**
 * Class AuthBasic
 *
 * @Annotation
 * @Annotation\Target({"METHOD", "CLASS"})
 *
 * @package hollisho\httpclient\Annotations\Request\Headers
 */
class AuthBasic extends Annotation implements ConfigurationAnnotationInterface
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $username;

    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $password;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getValue()
    {
        return [
            $this->getUsername(),
            $this->getPassword(),
        ];
    }

    /**
     * Returns the corresponding to guzzle configuration key.
     *
     * @return string
     */
    public function getConfigKey(): string
    {
        return ConfigurationConstants::AUTH_CONFIG_KEY;
    }
}