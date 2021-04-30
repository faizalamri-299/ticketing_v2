<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\Kakitangan;

/**
 * KakitanganSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\Kakitangan`.
 */
class KakitanganSearch extends Kakitangan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','ma_mod_umur', 'ma_mod_poskod'], 'integer'],
            [['ma_mod_nama_penuh', 'ma_mod_tarikh_lahir', 'ma_mod_no_kp', 'ma_mod_status_perkahwinan', 'ma_mod_bangsa', 'ma_mod_agama', 'ma_mod_alamat1', 'ma_mod_alamat2', 'ma_mod_warganegara', 'ma_mod_kelayakan_tertinggi', 'ma_mod_bidang', 'ma_mod_no_cukai_pendapatan', 'ma_mod_no_kwsp', 'ma_mod_no_akaun_bank', 'ma_mod_bank', 'ma_mod_no_hp', 'ma_mod_no_telefon_rumah', 'ma_mod_email'], 'safe'],
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
        $query = Kakitangan::find();

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
            'ma_mod_tarikh_lahir' => $this->ma_mod_tarikh_lahir,
            'ma_mod_umur' => $this->ma_mod_umur,
            'ma_mod_poskod' => $this->ma_mod_poskod,
        ]);

        $query->andFilterWhere(['like', 'ma_mod_nama_penuh', $this->ma_mod_nama_penuh])
            ->andFilterWhere(['like', 'ma_mod_no_kp', $this->ma_mod_no_kp])
            ->andFilterWhere(['like', 'ma_mod_status_perkahwinan', $this->ma_mod_status_perkahwinan])
            ->andFilterWhere(['like', 'ma_mod_bangsa', $this->ma_mod_bangsa])
            ->andFilterWhere(['like', 'ma_mod_agama', $this->ma_mod_agama])
            ->andFilterWhere(['like', 'ma_mod_alamat1', $this->ma_mod_alamat1])
            ->andFilterWhere(['like', 'ma_mod_alamat2', $this->ma_mod_alamat2])
            ->andFilterWhere(['like', 'ma_mod_warganegara', $this->ma_mod_warganegara])
            ->andFilterWhere(['like', 'ma_mod_kelayakan_tertinggi', $this->ma_mod_kelayakan_tertinggi])
            ->andFilterWhere(['like', 'ma_mod_bidang', $this->ma_mod_bidang])
            ->andFilterWhere(['like', 'ma_mod_no_cukai_pendapatan', $this->ma_mod_no_cukai_pendapatan])
            ->andFilterWhere(['like', 'ma_mod_no_kwsp', $this->ma_mod_no_kwsp])
            ->andFilterWhere(['like', 'ma_mod_no_akaun_bank', $this->ma_mod_no_akaun_bank])
            ->andFilterWhere(['like', 'ma_mod_bank', $this->ma_mod_bank])
            ->andFilterWhere(['like', 'ma_mod_no_hp', $this->ma_mod_no_hp])
            ->andFilterWhere(['like', 'ma_mod_no_telefon_rumah', $this->ma_mod_no_telefon_rumah])
            ->andFilterWhere(['like', 'ma_mod_email', $this->ma_mod_email]);

        return $dataProvider;
    }
}
