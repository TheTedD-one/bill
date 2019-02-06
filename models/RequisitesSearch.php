<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Requisites;

/**
 * RequisitesSearch represents the model behind the search form of `app\models\Requisites`.
 */
class RequisitesSearch extends Requisites
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_deleted', 'isMe'], 'integer'],
            [['created_date', 'modified_date', 'name', 'bin', 'iik', 'address'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Requisites::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_deleted' => $this->is_deleted,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'isMe' => $this->isMe,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bin', $this->bin])
            ->andFilterWhere(['like', 'iik', $this->iik])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
