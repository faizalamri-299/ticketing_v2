<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\Unit;

/**
 * UnitSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\Unit`.
 */
class UnitSearch extends Unit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ut_mod_kod', 'ut_mod_singkatan', 'ut_mod_nama_unit'], 'safe'],
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
        $query = Unit::find();

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
        ]);

        $query->andFilterWhere(['like', 'ut_mod_kod', $this->ut_mod_kod])
            ->andFilterWhere(['like', 'ut_mod_singkatan', $this->ut_mod_singkatan])
            ->andFilterWhere(['like', 'ut_mod_nama_unit', $this->ut_mod_nama_unit]);

        return $dataProvider;
    }
}
