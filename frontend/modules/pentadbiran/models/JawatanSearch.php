<?php

namespace frontend\modules\pentadbiran\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pentadbiran\models\Jawatan;

/**
 * JawatanSearch represents the model behind the search form of `frontend\modules\pentadbiran\models\Jawatan`.
 */
class JawatanSearch extends Jawatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jt_fk_ut_id'], 'integer'],
            [['jt_mod_kod', 'jt_mod_nama_jawatan', 'jt_mod_ringkasan_peranan'], 'safe'],
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
        $query = Jawatan::find();

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
            'jt_fk_ut_id' => $this->jt_fk_ut_id,
        ]);

        $query->andFilterWhere(['like', 'jt_mod_kod', $this->jt_mod_kod])
            ->andFilterWhere(['like', 'jt_mod_nama_jawatan', $this->jt_mod_nama_jawatan])
            ->andFilterWhere(['like', 'jt_mod_ringkasan_peranan', $this->jt_mod_ringkasan_peranan]);

        return $dataProvider;
    }
}
