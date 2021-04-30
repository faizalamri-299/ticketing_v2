<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\KlinikPanel;

/**
 * KlinikPanelSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\KlinikPanel`.
 */
class KlinikPanelSearch extends KlinikPanel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kp_mod_daerah', 'kp_mod_negeri'], 'integer'],
            [['kp_mod_nama', 'kp_mod_no_syarikat', 'kp_mod_no_telefon', 'kp_mod_emel', 'kp_mod_alamat1', 'kp_mod_alamat2', 'kp_mod_poskod'], 'safe'],
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
        $query = KlinikPanel::find();

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
            'kp_mod_daerah' => $this->kp_mod_daerah,
            'kp_mod_negeri' => $this->kp_mod_negeri,
        ]);

        $query->andFilterWhere(['like', 'kp_mod_nama', $this->kp_mod_nama])
            ->andFilterWhere(['like', 'kp_mod_no_syarikat', $this->kp_mod_no_syarikat])
            ->andFilterWhere(['like', 'kp_mod_no_telefon', $this->kp_mod_no_telefon])
            ->andFilterWhere(['like', 'kp_mod_emel', $this->kp_mod_emel])
            ->andFilterWhere(['like', 'kp_mod_alamat1', $this->kp_mod_alamat1])
            ->andFilterWhere(['like', 'kp_mod_alamat2', $this->kp_mod_alamat2])
            ->andFilterWhere(['like', 'kp_mod_poskod', $this->kp_mod_poskod]);

        return $dataProvider;
    }
}
