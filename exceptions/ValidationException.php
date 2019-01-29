<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 05.11.2018
 * Time: 23:28
 */

namespace app\exceptions;


class ValidationException extends BaseException
{
    public function __construct($message = self::WRONG_DATA_MESSAGE, $code = self::WRONG_DATA_CODE, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}