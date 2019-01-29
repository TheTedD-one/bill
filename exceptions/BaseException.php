<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 03.11.2018
 * Time: 1:49
 */

namespace app\exceptions;

use yii\base\Exception;

class BaseException extends Exception
{
    const WRONG_DATA_CODE = 400;
    const WRONG_DATA_MESSAGE = 'Ошибка валидации. Неверные данные.';

    const BUSINESS_LOGIC_ERROR_CODE = 400;
    const BUSINESS_LOGIC_ERROR_MESSAGE = 'Ошибка в бизнес логике.';

    const SAVE_ERROR_CODE = 500;
    const SAVE_ERROR_MESSAGE = 'Ошибка сохранения данных.';

    const LOAD_ERROR_CODE = 500;
    const LOAD_ERROR_MESSAGE = 'Ошибка загрузки данных.';

    const NOT_FOUND_CODE = 500;
    const NOT_FOUND_MESSAGE = 'Запись не найдена.';

    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}