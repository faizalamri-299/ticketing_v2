<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\MaklumatAnak;

/**
 * MaklumatAnakSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\MaklumatAnak`.
 */
class MaklumatAnakSearch extends MaklumatAnak
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'man_mod_umur'], 'integer'],
            [['man_mod_nama', 'man_mod_jenis_pengenalan', 'man_mod_no_pengenalan', 'man_mod_tarikh_lahir', 'man_mod_tempat_lahir', 'man_mod_jenis_status', 'man_mod_nama_insitusi'], 'safe'],
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
        $query = MaklumatAnak::find();

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
            'man_mod_umur' => $this->man_mod_umur,
            'man_mod_tarikh_lahir' => $this->man_mod_tarikh_lahir,
        ]);

        $query->andFilterWhere(['like', 'man_mod_nama', $this->man_mod_nama])
            ->andFilterWhere(['like', 'man_mod_jenis_pengenalan', $this->man_mod_jenis_pengenalan])
            ->andFilterWhere(['like', 'man_mod_no_pengenalan', $this->man_mod_no_pengenalan])
            ->andFilterWhere(['like', 'man_mod_tempat_lahir', $this->man_mod_tempat_lahir])
            ->andFilterWhere(['like', 'man_mod_jenis_status', $this->man_mod_jenis_status])
            ->andFilterWhere(['like', 'man_mod_nama_insitusi', $this->man_mod_nama_insitusi]);

        return $dataProvider;
    }
}
