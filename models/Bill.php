<?php

namespace app\models;

use app\interfaces\RemovableInterface;

/**
 * This is the model class for table "bill".
 *
 * @property int $id
 * @property int $is_deleted
 * @property string $created_date
 * @property string $modified_date
 */
class Bill extends BaseModel implements RemovableInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'is_deleted'
                ],
                'integer'
            ],
            [
                [
                    'created_date',
                    'modified_date'
                ],
                'safe'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_deleted' => 'Is Deleted',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }
}
