<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bill;

/**
 * BillSearch represents the model behind the search form of `app\models\Bill`.
 */
class BillSearch extends Bill
{
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

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Bill::find();

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
        ]);

        return $dataProvider;
    }
}
