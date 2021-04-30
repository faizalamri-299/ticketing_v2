<?php

namespace frontend\modules\pentadbiran\models;

use Yii;

/**
 * This is the model class for table "tbl_kod_jenis_dokumen".
 *
 * @property int $id
 * @property string $mod_kod
 * @property string $mod_keterangan
 *
 * @property TblDdDokumenDigital $tblDdDokumenDigital
 */
class KodJenisDokumen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kod_jenis_dokumen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mod_kod', 'mod_keterangan'], 'required'],
            [['mod_kod'], 'string', 'max' => 10],
            [['mod_keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mod_kod' => 'Kod Dokumen',
            'mod_keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[TblDdDokumenDigital]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenDigital()
    {
        return $this->hasOne(DokumenDigital::className(), ['dd_fk_kod_jenis_dokumen_id' => 'id']);
    }
}
