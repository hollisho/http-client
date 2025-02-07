<?php
namespace hollisho\httpclient\Interpreters;

use hollisho\httpclient\Annotations\Request\Contracts\ConfigurationAnnotationInterface;

/**
 * @author Hollis
 * @desc http client config interpreter
 * Class ConfigInterpreter
 * @package hollisho\httpclient\Interpreters
 */
class ConfigInterpreter
{
    /**
     * @var array
     */
    private $classAnnotations;

    /**
     * ConfigFactory constructor.
     *
     * @param array $classAnnotations
     */
    public function __construct(array $classAnnotations)
    {
        $this->classAnnotations = $classAnnotations;
    }

    /**
     * Makes the configuration from the class annotations.
     *
     * @return array
     */
    public function makeConfig(): array
    {
        $config = [];

        /**
         * Load up the global configurations for the client.
         *
         * @var ConfigurationAnnotationInterface $annotation
         */
        foreach ($this->classAnnotations as $annotation) {
            $key = $annotation->getConfigKey();

            if (!$key) {
                continue;
            }

            if (isset($config[$key])) {
                $config[$key] = array_merge($config[$key], $annotation->getValue());

                continue;
            }

            $config[$key] = $annotation->getValue();
        }

        return $config ?? [];
    }
}