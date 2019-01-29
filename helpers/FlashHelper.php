<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 03.11.2018
 * Time: 3:09
 */

namespace app\helpers;

use Yii;

class FlashHelper
{
    const TYPE_SUCCESS = 1;
    const TYPE_ERROR = 2;

    public static function setFlash($type, $message = null)
    {
        if ($type === self::TYPE_SUCCESS) {
            if (!$message) $message = self::getSuccessMessage();
            Yii::$app->session->setFlash('success', $message);
        } else if ($type === self::TYPE_ERROR) {
            if (!$message) $message = self::getErrorMessage();
            Yii::$app->session->setFlash('error', $message);
        }
    }

    public static function getFlash($type)
    {
        if ($type === self::TYPE_SUCCESS) {
            return Yii::$app->session->getFlash('success');
        } else if ($type === self::TYPE_ERROR) {
            return Yii::$app->session->getFlash('error');
        }
    }

    private static function getSuccessMessage()
    {
        return 'Успех';
    }

    private static function getErrorMessage()
    {
        return 'Неудача';
    }
}