<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 03.11.2018
 * Time: 1:43
 */
namespace app\exceptions;

class RepositoryNotFoundException extends BaseException
{
    public function __construct($message = self::NOT_FOUND_MESSAGE, $code = self::NOT_FOUND_CODE, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}