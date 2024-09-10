<?php
namespace hollisho\httpclient\Constants;

/**
 * @author Hollis
 * @desc
 * Class BodyConstants
 * @package hollisho\httpclient\Constants
 */
final class BodyConstants
{
    /**
     * These are the available body types.
     *
     * @const string
     */
    const JSON_BODY = 'JSON';
    const FORM_PARAMS_BODY = 'FORM_PARAMS';
    const MULTI_PART_BODY = 'MULTI_PART';
}