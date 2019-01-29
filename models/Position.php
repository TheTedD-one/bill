<?php

namespace app\models;

use app\interfaces\RemovableInterface;
use Yii;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property int $is_deleted
 * @property string $created_date
 * @property string $modified_date
 * @property int $bill_id
 * @property string $name
 * @property int $unit
 * @property double $quantity
 * @property double $price
 * @property double $tax_rate
 * @property double $tax_sum
 * @property double $total_price
 * @property double $excise_rate
 * @property double $excise_sum
 */
class Position extends BaseModel implements RemovableInterface
{
    public static function tableName()
    {
        return 'position';
    }

    public function rules()
    {
        return [
            [
                [
                    'is_deleted',
                    'bill_id',
                    'unit'
                ],
                'integer'
            ],
            [
                [
                    'bill_id',
                    'name',
                    'unit',
                    'quantity',
                    'price',
                    'tax_rate',
                    'tax_sum',
                    'total_price',
                    'excise_rate',
                    'excise_sum'
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
                    'quantity',
                    'price',
                    'tax_rate',
                    'tax_sum',
                    'total_price',
                    'excise_rate',
                    'excise_sum'
                ],
                'number'
            ],
            [
                [
                    'name'
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
            'bill_id' => 'Bill ID',
            'name' => 'Name',
            'unit' => 'Unit',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'tax_rate' => 'Tax Rate',
            'tax_sum' => 'Tax Sum',
            'total_price' => 'Total Price',
            'excise_rate' => 'Excise Rate',
            'excise_sum' => 'Excise Sum',
        ];
    }
}
