<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;

/**
 * KakitanganHasKodCutiSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\KakitanganHasKodCuti`.
 */
class KakitanganHasKodCutiSearch extends KakitanganHasKodCuti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'makc_fk_maklumat_anggota_id', 'makc_fk_kod_cuti_id', 'makc_mod_tahun'], 'integer'],
            [['makc_mod_jumlah_cuti', 'makc_sys_baki_cuti'], 'number'],
            [['makc_mod_status'], 'safe'],
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
        $query = KakitanganHasKodCuti::find();
       
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => 
                        ['makc_fk_maklumat_anggota_id' => SORT_ASC,
                        'makc_mod_tahun' => SORT_ASC,
                        'makc_fk_kod_cuti_id' => SORT_ASC],
                    ],
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
            'makc_fk_maklumat_anggota_id' => $this->makc_fk_maklumat_anggota_id,
            'makc_fk_kod_cuti_id' => $this->makc_fk_kod_cuti_id,
            'makc_mod_tahun' => $this->makc_mod_tahun,
            'makc_mod_jumlah_cuti' => $this->makc_mod_jumlah_cuti,
            'makc_sys_baki_cuti' => $this->makc_sys_baki_cuti,
        ]);

        $query->andFilterWhere(['like', 'makc_mod_status', $this->makc_mod_status]);

        return $dataProvider;
    }
}
