<?php

namespace frontend\modules\pentadbiran\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "tbl_kod_kategori_tuntutan".
 *
 * @property int $id
 * @property string|null $kk_mod_kategori
 * @property string|null $kk_mod_singkatan
 */
class KodKategoriTuntutan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kod_kategori_tuntutan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kk_mod_kategori'], 'string', 'max' => 100],
            [['kk_mod_singkatan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kk_mod_kategori' => 'Kk Mod Kategori',
            'kk_mod_singkatan' => 'Kk Mod Singkatan',
        ];
    }

    public static function getKodKategoriList()
    {
        $query = KodKategoriTuntutan::find()->select(['id', 'kk_mod_kategori'])->asArray()->all();
        return ArrayHelper::map($query, 'id', 'kk_mod_kategori');
    } 
}
