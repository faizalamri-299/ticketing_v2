<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\DokumenDigital;

/**
 * DdDokumenDigitalSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\DdDokumenDigital`.
 */
class DokumenDigitalSearch extends DokumenDigital
{
    public $mod_keterangan;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['mod_keterangan','dd_fk_kod_jenis_dokumen_id','dd_mod_tajuk_dokumen', 'dd_mod_no_rujukan', 'dd_mod_dokumen_daripada', 'dd_mod_dokumen_kepada', 'dd_mod_tarikh_terima', 'dd_mod_tarikh_serah'], 'safe'],
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
        $query = DokumenDigital::find();

        // join table dari function di model dd dokumen digital
        //$query->joinWith(['ddFkKodJenisDokumen']);
             
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['dd_fk_kod_jenis_dokumen_id'] = [
            'asc'=>['jenisDokumen.mod_keterangan'=>SORT_ASC],
            'desc'=>['jenisDokumen.mod_keterangan'=>SORT_DESC],
        ];

        $dataProvider->sort->attributes['dd_mod_tarikh_terima'] = [
            'asc'=>['infoTarikhTerima'=>SORT_ASC],
            'desc'=>['infoTarikhTerima'=>SORT_DESC],
        ];

        $dataProvider->sort->attributes['dd_mod_tarikh_serah'] = [
            'asc'=>['infoTarikhSerah'=>SORT_ASC],
            'desc'=>['infoTarikhSerah'=>SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('jenisDokumen');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'dd_fk_kod_jenis_dokumen_id' => $this->dd_fk_kod_jenis_dokumen_id,
            'dd_mod_tarikh_terima' => $this->dd_mod_tarikh_terima,
            'dd_mod_tarikh_serah' => $this->dd_mod_tarikh_serah,
        ]);

        $query//->andFilterWhere(['like', 'mod_keterangan', $this->mod_keterangan])
            ->andFilterWhere(['like', 'dd_mod_tajuk_dokumen', $this->dd_mod_tajuk_dokumen])
            ->andFilterWhere(['like', 'dd_mod_no_rujukan', $this->dd_mod_no_rujukan])
            ->andFilterWhere(['like', 'dd_mod_dokumen_daripada', $this->dd_mod_dokumen_daripada])
            ->andFilterWhere(['like', 'dd_mod_dokumen_kepada', $this->dd_mod_dokumen_kepada])
            ->andFilterWhere(['like', 'tbl_kod_jenis_dokumen.mod_keterangan', $this->dd_fk_kod_jenis_dokumen_id]);

        return $dataProvider;
    }
}
