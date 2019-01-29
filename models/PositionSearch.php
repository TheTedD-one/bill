<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 29.01.2019
 * Time: 18:47
 */

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PositionSearch extends Position
{
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

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Position::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'is_deleted' => Bill::NOT_DELETED,
            'id' => $this->id,
            'bill_id' => $this->bill_id,
        ]);

        return $dataProvider;
    }
}