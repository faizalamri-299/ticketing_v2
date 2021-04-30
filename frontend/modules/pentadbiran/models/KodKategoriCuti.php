<?php

namespace frontend\modules\pentadbiran\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_kkc_kod_kategori_cuti".
 *
 * @property int $id
 * @property string|null $kkc_mod_kategori
 */
class KodKategoriCuti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kkc_kod_kategori_cuti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kkc_mod_kategori'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kkc_mod_kategori' => 'Kategori Cuti',
        ];
    }

    public static function getKodKategoriCutiList()
    {
        $query = KodKategoriCuti::find()->select(['id', 'kkc_mod_kategori'])->asArray()->all();
        return ArrayHelper::map($query, 'id', 'kkc_mod_kategori');
    } 
}
