<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 06.11.2018
 * Time: 1:19
 */

namespace app\exceptions;


class BusinessLogicException extends BaseException
{
    public function __construct($message = self::BUSINESS_LOGIC_ERROR_MESSAGE, $code = self::BUSINESS_LOGIC_ERROR_CODE, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}