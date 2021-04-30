<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\KodCuti;

/**
 * KodCutiSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\KodCuti`.
 */
class KodCutiSearch extends KodCuti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['mod_jenis', 'mod_keterangan'], 'safe'],
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
        $query = KodCuti::find();

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

        $query->andFilterWhere(['like', 'mod_jenis', $this->mod_jenis])
            ->andFilterWhere(['like', 'mod_keterangan', $this->mod_keterangan]);

        return $dataProvider;
    }
}
