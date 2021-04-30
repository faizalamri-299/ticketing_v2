<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\MaklumatPasangan;

/**
 * MaklumatPasanganSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\MaklumatPasangan`.
 */
class MaklumatPasanganSearch extends MaklumatPasangan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mp_mod_poskod'], 'integer'],
            [['mp_mod_nama', 'mp_mod_tarikh_lahir', 'mp_mod_no_kp', 'mp_mod_warganegara', 'mp_mod_pekerjaan', 'mp_mod_nama_majikan', 'mp_mod_alamat_majikan1', 'mp_mod_alamat_majikan2', 'mp_mod_no_hp', 'mp_mod_no_pejabat'], 'safe'],
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
        $query = MaklumatPasangan::find();

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
            'mp_mod_tarikh_lahir' => $this->mp_mod_tarikh_lahir,
            'mp_mod_poskod' => $this->mp_mod_poskod,
        ]);

        $query->andFilterWhere(['like', 'mp_mod_nama', $this->mp_mod_nama])
            ->andFilterWhere(['like', 'mp_mod_no_kp', $this->mp_mod_no_kp])
            ->andFilterWhere(['like', 'mp_mod_warganegara', $this->mp_mod_warganegara])
            ->andFilterWhere(['like', 'mp_mod_pekerjaan', $this->mp_mod_pekerjaan])
            ->andFilterWhere(['like', 'mp_mod_nama_majikan', $this->mp_mod_nama_majikan])
            ->andFilterWhere(['like', 'mp_mod_alamat_majikan1', $this->mp_mod_alamat_majikan1])
            ->andFilterWhere(['like', 'mp_mod_alamat_majikan2', $this->mp_mod_alamat_majikan2])
            ->andFilterWhere(['like', 'mp_mod_no_hp', $this->mp_mod_no_hp])
            ->andFilterWhere(['like', 'mp_mod_no_pejabat', $this->mp_mod_no_pejabat]);

        return $dataProvider;
    }
}
