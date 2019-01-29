<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 03.11.2018
 * Time: 2:13
 */

namespace app\exceptions;


class RepositorySaveException extends BaseException
{
    public function __construct($message = self::SAVE_ERROR_MESSAGE, $code = self::SAVE_ERROR_CODE, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}