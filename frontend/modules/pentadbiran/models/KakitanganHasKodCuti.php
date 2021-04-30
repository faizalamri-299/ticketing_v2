<?php

namespace frontend\modules\pentadbiran\models;
use frontend\modules\pentadbiran\models\KodCuti;
use frontend\modules\pentadbiran\models\PermohonanCuti;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "tbl_makc_maklumat_anggota_has_kod_cuti".
 *
 * @property int $id
 * @property int $makc_fk_maklumat_anggota_id
 * @property int $makc_fk_kod_cuti_id
 * @property int $makc_mod_tahun
 * @property float $makc_mod_jumlah_cuti
 * @property float $makc_sys_baki_cuti
 * @property string $makc_mod_status
 *
 * @property TblKodCuti $fkMakcKodCuti
 * @property TblMaMaklumatAnggota $fkMakcMaklumatAnggota
 */
class KakitanganHasKodCuti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_makc_maklumat_anggota_has_kod_cuti';
    }

    public function behaviors() {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            'timestamp'=>[
                'class'=>  TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['makc_sys_tarikh_masuk', 'makc_sys_tarikh_kemaskini'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['makc_sys_tarikh_kemaskini'],
                ],
                'value'=> new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'makc_sys_user_masuk',
                'updatedByAttribute' => 'makc_sys_user_kemaskini',
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['fk_makc_maklumat_anggota_id', 'fk_makc_kod_cuti_id', 'makc_mod_tahun', 'makc_mod_jumlah_cuti', 'makc_sys_baki_cuti', 'makc_mod_status'], 'required'],
            [['makc_fk_maklumat_anggota_id', 'makc_fk_kod_cuti_id', 'makc_mod_tahun', 'makc_sys_user_masuk', 'makc_sys_user_kemaskini'], 'integer'],
            [['makc_sys_tarikh_masuk', 'makc_sys_tarikh_kemaskini'], 'safe'],
            [['makc_mod_jumlah_cuti', 'makc_sys_baki_cuti'], 'number'],
            [['makc_mod_status'], 'string', 'max' => 100],
            [['makc_fk_kod_cuti_id'], 'exist', 'skipOnError' => true, 'targetClass' => KodCuti::className(), 'targetAttribute' => ['makc_fk_kod_cuti_id' => 'id']],
            [['makc_fk_maklumat_anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kakitangan::className(), 'targetAttribute' => ['makc_fk_maklumat_anggota_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'makc_fk_maklumat_anggota_id' => 'Nama Kakitangan',
            'makc_fk_kod_cuti_id' => 'Jenis Cuti',
            'makc_mod_tahun' => 'Tahun',
            'makc_mod_jumlah_cuti' => 'Jumlah Cuti',
            'makc_sys_baki_cuti' => 'Baki Cuti',
            'makc_mod_status' => 'Status',
        ];
    }

    /**
     * Gets query for [[FkMakcKodCuti]].
     *
     * @return \yii\db\ActiveQuery
     */
    //for table kodcuti
    public function getKodCuti()
    {
        return $this->hasOne(KodCuti::className(), ['id' => 'makc_fk_kod_cuti_id']);
    }
    
    public function getInfoUnit()
    {
        return $this->jawatan->unit->ut_mod_nama_unit;
    }

    /**
     * Gets query for [[FkMakcMaklumatAnggota]].
     *
     * @return \yii\db\ActiveQuery
     */
    //for table kakitangan
    public function getKakitangan()
    {
        return $this->hasOne(Kakitangan::className(), ['id' => 'makc_fk_maklumat_anggota_id']);
    }

    public function getPermohonanCuti()
    {
        return $this->hasMany(PermohonanCuti::className(), ['pc_fk_kakitangan_cuti_id' => 'id']);
    }

    public function getKakitanganHasJawatan()
    {
        return $this->hasMany(KakitanganHasJawatan::className(), ['pc_fk_kakitangan_cuti_id' => 'id']);
    }
}
