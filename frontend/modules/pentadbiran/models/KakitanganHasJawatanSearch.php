<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;

/**
 * KakitanganSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\Kakitangan`.
 */
class KakitanganHasJawatanSearch extends KakitanganHasJawatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['kajt_fk_kakitangan_id', 'kajt_fk_jawatan_id', 'kajt_mod_tarikh_lantikan', 'kajt_mod_tarikh_tamat', 'kajt_mod_status_kakitangan', 'kajt_mod_no_kakitangan', 'kajt_flag_eksekutif', 'kajt_mod_kategori_anggota'], 'safe'],
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
        $query = KakitanganHasJawatan::find();

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

        $query->andFilterWhere(['like', 'kajt_fk_kakitangan_id', $this->kajt_fk_kakitangan_id])
            ->andFilterWhere(['like', 'kajt_fk_jawatan_id', $this->kajt_fk_jawatan_id])
            ->andFilterWhere(['like', 'kajt_mod_tarikh_lantikan', $this->kajt_mod_tarikh_lantikan])
            ->andFilterWhere(['like', 'kajt_mod_tarikh_tamat', $this->kajt_mod_tarikh_tamat])
            ->andFilterWhere(['like', 'kajt_mod_status_kakitangan', $this->kajt_mod_status_kakitangan])
            ->andFilterWhere(['like', 'kajt_mod_no_kakitangan', $this->kajt_mod_no_kakitangan])
            ->andFilterWhere(['like', 'kajt_flag_eksekutif', $this->kajt_flag_eksekutif])
            ->andFilterWhere(['like', 'kajt_mod_kategori_anggota', $this->kajt_mod_kategori_anggota]);

        return $dataProvider;
    }
}
