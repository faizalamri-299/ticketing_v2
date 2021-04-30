<?php

namespace frontend\modules\pentadbiran\models;
use frontend\modules\pentadbiran\models\KodKategoriTuntutan;

use Yii;

/**
 * This is the model class for table "tbl_kod_tuntutan".
 *
 * @property int $id
 * @property string $mod_kod_tuntutan
 * @property string $mod_jenis_tuntutan
 * @property string $mod_keterangan
 * @property string $mod_penuntut
 * @property string $mod_kadar
 */
class KodTuntutan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kod_tuntutan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['mod_kod_tuntutan', 'mod_jenis_tuntutan', 'mod_keterangan', 'mod_penuntut', 'mod_kadar'], 'required'],
            [['kt_fk_kod_id'], 'integer'],
            [['mod_kategori','mod_kod_tuntutan', 'mod_jenis_tuntutan', 'mod_keterangan', 'mod_penuntut', 'mod_kadar', 'mod_nilaian'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kt_fk_kod_id' => 'Kategori',
            'mod_kategori' => 'Kategori',
            'mod_kod_tuntutan' => 'Kod Tuntutan',
            'mod_jenis_tuntutan' => 'Jenis Tuntutan',
            'mod_keterangan' => 'Keterangan',
            'mod_penuntut' => 'Penuntut',
            'mod_kadar' => 'Kadar',
            'mod_nilaian' => 'Nilai',
        ];
    }

    public function getKategori()
    {
        return $this->hasOne(KodKategoriTuntutan::className(), ['id' => 'kt_fk_kod_id']);
    }
}
