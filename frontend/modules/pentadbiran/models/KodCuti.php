<?php

namespace frontend\modules\pentadbiran\models;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\PermohonanCuti;
use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;

use Yii;

/**
 * This is the model class for table "tbl_kod_cuti".
 *
 * @property int $id
 * @property string $mod_jenis
 * @property string $mod_keterangan
 *
 * @property TblMakcMaklumatAnggotaHasKodCuti[] $tblMakcMaklumatAnggotaHasKodCutis
 * @property TblPcPermohonanCuti[] $tblPcPermohonanCutis
 */
class KodCuti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kod_cuti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mod_jenis', 'mod_keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mod_jenis' => 'Kategori',
            'mod_keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[TblMakcMaklumatAnggotaHasKodCutis]].
     *
     * @return \yii\db\ActiveQuery
     */
    /******************************* FOREGIN KEY [START] *********************************/
    // public function getMaklumatAnggotaHasKodCuti()
    // {
    //     return $this->hasMany(TblMakcMaklumatAnggotaHasKodCuti::className(), ['fk_makc_kod_cuti_id' => 'id']);
    // }

    /**
     * Gets query for [[TblPcPermohonanCutis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPermohonanCuti()
    {
        return $this->hasMany(PermohonanCuti::className(), ['pc_fk_id_kod_cuti' => 'id']);
    }

    public function getKakitanganHasKodCuti()
    {
        return $this->hasMany(KakitanganHasKodCuti::className(), ['fk_makc_kod_cuti_id' => 'id']);
    }

    public function getKakitangan()
    {
        return $this->hasMany(Kakitangan::className(), ['id' => 'id'])
        ->via ('kakitanganHasKodCuti');
    }

    /******************************* FOREGIN KEY [END] *********************************/
}
