<?php

namespace app\models;

use app\exceptions\RepositoryNotFoundException;
use app\interfaces\RemovableInterface;
use Yii;

/**
 * This is the model class for table "requisites".
 *
 * @property int $id
 * @property int $is_deleted
 * @property string $created_date
 * @property string $modified_date
 * @property string $name
 * @property string $bin
 * @property string $iik
 * @property string $address
 * @property int $isMe
 */
class Requisites extends BaseModel implements RemovableInterface
{
    const MY_REQUISITES = 1;
    const ALL_REQUISITES = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'is_deleted',
                    'isMe'
                ],
                'integer'
            ],
            [
                [
                    'name',
                    'bin',
                    'iik',
                    'address'
                ],
                'required'
            ],
            [
                [
                    'created_date',
                    'modified_date'
                ],
                'safe'
            ],
            [
                [
                    'name',
                    'bin',
                    'iik',
                    'address'
                ],
                'string',
                'max' => 255
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_deleted' => 'Is Deleted',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'name' => 'Наименование компании',
            'bin' => 'БИН',
            'iik' => 'ИИК',
            'address' => 'Адрес',
            'isMe' => 'Мои реквизиты',
        ];
    }

    public static function getMyDetails()
    {
        $details = self::find()
            ->where('is_deleted=:is_deleted', [':is_deleted' => self::NOT_DELETED])
            ->andWhere('isMe=:isMe', [':isMe' => self::MY_REQUISITES])
            ->asArray()
            ->all();

        return $details;
    }

    public static function getAllDetails()
    {
        $details = self::find()
            ->where('is_deleted=:is_deleted', [':is_deleted' => self::NOT_DELETED])
            ->asArray()
            ->all();

        return $details;
    }

    public static function getSelectDetails($isMe = self::ALL_REQUISITES)
    {
        if ($isMe === self::MY_REQUISITES) {
            $details = self::getMyDetails();
        } else {
            $details = self::getAllDetails();
        }

        $data = [];
        foreach($details as $item) {
            $data[$item['id']] = $item['name'] . ' (БИН: ' . $item['bin'] . ')';
        }

        return $data;
    }
}
