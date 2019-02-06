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
    const UNIT_PIECE = 1;
    const UNIT_KILOGRAM = 2;
    const UNIT_LITER = 3;

    public static function tableName()
    {
        return 'position';
    }

    public function rules()
    {
        return [
            [
                [
                    'id',
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
                    'total_price_without_tax',
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
                    'total_price_without_tax',
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
            'name' => 'Наименование товара',
            'unit' => 'Единица измерения',
            'quantity' => 'Количество',
            'price' => 'Цена',
            'total_price_without_tax' => 'Стоимость товаров без НДС',
            'tax_rate' => 'Ставка НДС',
            'tax_sum' => 'Сумма НДС',
            'total_price' => 'Всего стоимость реализации',
            'excise_rate' => 'Ставка Акциз',
            'excise_sum' => 'Сумма Акциз',
        ];
    }

    public static function getUnitList()
    {
        return [
            self::UNIT_PIECE => 'шт.',
            self::UNIT_KILOGRAM => 'кг.',
            self::UNIT_LITER => 'л.',
        ];
    }
}
