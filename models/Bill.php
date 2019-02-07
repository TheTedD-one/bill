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
    const PAYMENT_CASH = 'Наличный расчет';
    const PAYMENT_CARD = 'Безналичный расчет';

    public static function tableName()
    {
        return 'bill';
    }

    public function rules()
    {
        return [
            [
                [
                    'is_deleted',
                    'my_requisites_id',
                    'customer_requisites_id',
                    'sender_requisites_id',
                    'recipient_requisites_id',
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
            [
                [
                    'contract_type',
                    'payment_type',
                    'delivery_point',
                    'delivery_type',
                    'delivery_document',
                    'transport_document',
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'my_requisites_id',
                    'customer_requisites_id',
                    'sender_requisites_id',
                    'recipient_requisites_id',
                ],
                'required'
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
            'my_requisites_id' => 'Поставщик',
            'customer_requisites_id' => 'Получатель',
            'sender_requisites_id' => 'Грузоотправитель',
            'recipient_requisites_id' => 'Грузополучатель',
            'contract_type' => 'Договор на поставку',
            'payment_type' => 'Условия оплаты',
            'delivery_point' => 'Пункт назначения',
            'delivery_type' => 'Способ отправления',
            'delivery_document' => 'Довереность на поставку товаров',
            'transport_document' => 'Товарно-транспортная накладная',
        ];
    }

    public static function getPaymentTypes()
    {
        return [
            self::PAYMENT_CARD => self::PAYMENT_CARD,
            self::PAYMENT_CASH => self::PAYMENT_CASH,
        ];
    }

    public function getCustomer() {
        return $this->hasOne(Requisites::className(), ['id' => 'customer_requisites_id']);
    }

    public function getPositionCount() {
        return $this->hasMany(Position::className(), ['bill_id' => 'id'])->count();
    }
}
