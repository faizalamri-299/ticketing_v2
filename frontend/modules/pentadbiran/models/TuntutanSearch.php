<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\Tuntutan;

/**
 * TuntutanSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\Tuntutan`.
 */
class TuntutanSearch extends Tuntutan
{
    public $infoStatus;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'makt_fk_maklumat_anggota_id', 'makt_fk_kategori_tuntutan', 'makt_fk_kod_tuntutan_id', 'makt_sys_user_masuk', 'makt_sys_user_kemaskini', 'makt_mod_status'], 'integer'],
            [['makt_sys_tarikh_masuk', 'makt_sys_tarikh_kemaskini', 'makt_mod_tarikh_tuntutan','makt_mod_tempat_dituju', 'makt_mod_butiran_tuntutan','makt_mod_butiran_perjalanan', 'makt_mod_waktu_tiba_pejabat', 'makt_mod_waktu_bertolak', 'makt_mod_waktu_balik', 'makt_mod_jam', 'makt_mod_jumlah_jam','makt_mod_hitungan_km', 'makt_mod_resit' ,'infoStatus'], 'safe'],
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
        $query = Tuntutan::find();

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
            'makt_fk_kategori_tuntutan' => $this->makt_fk_kategori_tuntutan,
            'makt_fk_maklumat_anggota_id' => $this->makt_fk_maklumat_anggota_id,
            'makt_fk_kod_tuntutan_id' => $this->makt_fk_kod_tuntutan_id,
            'makt_sys_user_masuk' => $this->makt_sys_user_masuk,
            'makt_sys_tarikh_masuk' => $this->makt_sys_tarikh_masuk,
            'makt_sys_user_kemaskini' => $this->makt_sys_user_kemaskini,
            'makt_sys_tarikh_kemaskini' => $this->makt_sys_tarikh_kemaskini,
            'makt_mod_tarikh_tuntutan' => $this->makt_mod_tarikh_tuntutan,
            'makt_mod_butiran_tuntutan' => $this->makt_mod_butiran_tuntutan,
            'makt_mod_waktu_tiba_pejabat' => $this->makt_mod_waktu_tiba_pejabat,
            'makt_mod_waktu_bertolak' => $this->makt_mod_waktu_bertolak,
            'makt_mod_waktu_balik' => $this->makt_mod_waktu_balik,
            'makt_mod_status' => $this->infoStatus,
        ]);

        $query->andFilterWhere(['like', 'makt_mod_tempat_dituju', $this->makt_mod_tempat_dituju])
            ->andFilterWhere(['like', 'makt_mod_butiran_perjalanan', $this->makt_mod_butiran_perjalanan])
            ->andFilterWhere(['like', 'makt_mod_hitungan_km', $this->makt_mod_hitungan_km])
            ->andFilterWhere(['like', 'makt_mod_resit', $this->makt_mod_resit]);

        return $dataProvider;
    }
}
