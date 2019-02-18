<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 29.01.2019
 * Time: 18:47
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PositionSearch extends Position
{
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'is_deleted',
                ],
                'integer'
            ],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $bill_id)
    {
        $query = Position::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ]
        ]);

        $this->load($params);
        $query->andFilterWhere([
            'is_deleted' => Bill::NOT_DELETED,
            'bill_id' => $bill_id,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        return $dataProvider;
    }
}