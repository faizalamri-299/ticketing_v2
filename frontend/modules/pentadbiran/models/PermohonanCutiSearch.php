<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\PermohonanCuti;

/**
 * PermohonanCutiSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\PermohonanCuti`.
 */
class PermohonanCutiSearch extends PermohonanCuti
{
    public $infoStatusCuti;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pc_fk_maklumat_anggota_cuti_id', 'pc_fk_maklumat_anggota_id', 'pc_fk_kod_cuti_id', 'pc_sys_bil_cuti'], 'integer'],
            [['pc_mod_tarikh_mula', 'pc_mod_tarikh_tamat', 'pc_mod_jenis_cuti', 'pc_mod_keterangan', 'pc_mod_nama_surat_sokongan', 'pc_mod_surat_sokongan', 'infoStatusCuti', 'pc_sys_baki_cuti', 'pc_mod_catatan_ketua_unit', 'pc_mod_catatan_upsm', 'pc_mod_catatan_ceo'], 'safe'],
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
        $query = PermohonanCuti::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => 
                        ['id' => SORT_DESC],
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
            'pc_fk_maklumat_anggota_cuti_id' => $this->pc_fk_maklumat_anggota_cuti_id,
            'pc_fk_maklumat_anggota_id' => $this->pc_fk_maklumat_anggota_id,
            'pc_fk_kod_cuti_id' => $this->pc_fk_kod_cuti_id,
            'pc_mod_tarikh_mula' => $this->pc_mod_tarikh_mula,
            'pc_mod_tarikh_tamat' => $this->pc_mod_tarikh_tamat,
            'pc_mod_jenis_cuti' => $this->pc_mod_jenis_cuti,
            'pc_sys_bil_cuti' => $this->pc_sys_bil_cuti,
            'pc_mod_status' => $this->infoStatusCuti,
        ]);

        $query->andFilterWhere(['like', 'pc_mod_jenis_cuti', $this->pc_mod_jenis_cuti])
            ->andFilterWhere(['like', 'pc_mod_keterangan', $this->pc_mod_keterangan])
            ->andFilterWhere(['like', 'pc_mod_nama_surat_sokongan', $this->pc_mod_nama_surat_sokongan])
            ->andFilterWhere(['like', 'pc_mod_surat_sokongan', $this->pc_mod_surat_sokongan]);

        $query->andFilterWhere(['like', 'kakitangan.ma_mod_nama_penuh', $this->pc_fk_maklumat_anggota_id]);

        return $dataProvider;
    }
}
