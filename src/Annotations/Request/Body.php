<?php
namespace hollisho\httpclient\Annotations\Request;

use Doctrine\Common\Annotations\Annotation;
use hollisho\httpclient\Constants\BodyConstants;
use hollisho\httpclient\Exceptions\NoBodyTypeProvidedException;

/**
 * Class Body
 *
 * @Annotation
 * @Annotation\Target({"METHOD"})
 *
 * @package hollisho\httpclient\Annotations\Request
 */
class Body extends Annotation
{
    /**
     * @Annotation\Required
     *
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $json = false;

    /**
     * @var bool
     */
    public $multiPart = false;

    /**
     * @var bool
     */
    public $formParams = false;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isJson(): bool
    {
        return $this->json;
    }

    /**
     * @return bool
     */
    public function isFormParams(): bool
    {
        return $this->formParams;
    }

    /**
     * @return bool
     */
    public function isMultiPart(): bool
    {
        return $this->multiPart;
    }

    /**
     * @return string
     *
     * @throws NoBodyTypeProvidedException
     */
    public function getBodyType(): string
    {
        switch (true) {
            case $this->isJson() :
                return BodyConstants::JSON_BODY;
            case $this->isFormParams() :
                return BodyConstants::FORM_PARAMS_BODY;
            case $this->isMultiPart() :
                return BodyConstants::MULTI_PART_BODY;
            default :
                throw new NoBodyTypeProvidedException("Please provide a type for the body annotation.");
        }
    }
}