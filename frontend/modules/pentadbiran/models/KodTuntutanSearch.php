<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\KodTuntutan;

/**
 * KodTuntutanSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\KodTuntutan`.
 */
class KodTuntutanSearch extends KodTuntutan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['mod_kod_tuntutan', 'mod_jenis_tuntutan', 'mod_keterangan', 'mod_penuntut', 'mod_kadar'], 'safe'],
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
        $query = KodTuntutan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'mod_kod_tuntutan' => SORT_ASC,
                ]
            ],
        ]);

         $dataProvider->pagination->pageSize=0;

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

        $query->andFilterWhere(['like', 'mod_kod_tuntutan', $this->mod_kod_tuntutan])
            ->andFilterWhere(['like', 'mod_jenis_tuntutan', $this->mod_jenis_tuntutan])
            ->andFilterWhere(['like', 'mod_keterangan', $this->mod_keterangan])
            ->andFilterWhere(['like', 'mod_penuntut', $this->mod_penuntut])
            ->andFilterWhere(['like', 'mod_kadar', $this->mod_kadar]);

        return $dataProvider;
    }
}
