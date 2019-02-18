<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Requisites;

class RequisitesSearch extends Requisites
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

    public function search($params)
    {
        $query = Requisites::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            echo '<pre>';
            print_r($this->errors);
            echo '</pre>';
            die;
            return $dataProvider;
        }

        $query->andFilterWhere([
            'is_deleted' => Requisites::NOT_DELETED,
            'id' => $this->id,
        ]);

        return $dataProvider;
    }
}
