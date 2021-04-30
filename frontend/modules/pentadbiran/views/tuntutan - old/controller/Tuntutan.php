<?php

namespace frontend\modules\pentadbiran\models;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\KodTuntutan;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "tbl_makc_maklumat_anggota_has_kod_tuntutan".
 *
 * @property int $id
 * @property int|null $makt_fk_maklumat_anggota_id
 * @property int|null $makt_fk_kod_tuntutan_id
 * @property int|null $makt_sys_user_masuk
 * @property string|null $makt_sys_tarikh_masuk
 * @property int|null $makt_sys_user_kemaskini
 * @property string|null $makt_sys_tarikh_kemaskini
 * @property string|null $makt_mod_tarikh_tuntutan
 * @property string|null $makt_mod_tempat_dituju
 * @property string|null $makt_mod_butiran_perjalanan
 * @property string|null $makt_mod_waktu_tiba_pejabat
 * @property string|null $makt_mod_waktu_bertolak
 * @property string|null $makt_mod_waktu_balik
 * @property string|null $makt_mod_jumlah_jam
 * @property string|null $makt_mod_hitungan_km
 * @property string|null $makt_mod_resit
 * @property int|null $makt_mod_status
 */
class Tuntutan extends \yii\db\ActiveRecord
{
    public $tempFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_makc_maklumat_anggota_has_kod_tuntutan';
    }

    // public function behaviors()
    // {
    //     return [
    //         'bedezign\yii2\audit\AuditTrailBehavior',
    //         'timestamp'=>[
    //             'class'=>  \yii\behaviors\TimestampBehavior::class,
    //             'attributes'=>[
    //                 \yii\db\ActiveRecord::EVENT_BEFORE_INSERT=>['makt_sys_tarikh_masuk', 'makt_sys_tarikh_kemaskini'],
    //                 \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE=>['makt_sys_tarikh_kemaskini'],
    //             ],
    //             'value'=> new \yii\db\Expression('NOW()'),
    //         ],
    //         [
    //             'class' => \yii\behaviors\BlameableBehavior::class,
    //             'createdByAttribute' => 'makt_sys_user_masuk',
    //             'updatedByAttribute' => 'makt_sys_user_kemaskini',
    //         ],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['makt_fk_maklumat_anggota_id', 'makt_fk_kategori_tuntutan', 'makt_fk_kod_tuntutan_id', 'makt_sys_user_masuk', 'makt_sys_user_kemaskini', 'makt_mod_status'], 'integer'],
            [['makt_sys_tarikh_masuk', 'makt_sys_tarikh_kemaskini', 'makt_mod_tarikh_tuntutan', 'makt_mod_waktu_tiba_pejabat', 'makt_mod_waktu_bertolak', 'makt_mod_waktu_balik'], 'safe'],
            [['makt_mod_tempat_dituju', 'makt_mod_butiran_perjalanan', 'makt_mod_resit'], 'string', 'max' => 256],
            [['makt_mod_jumlah_jam', 'makt_mod_hitungan_km'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'makt_fk_maklumat_anggota_id' => 'Nama Kakitangan',
            'makt_fk_kategori_tuntutan' => 'Kategori Tuntutan',
            'makt_fk_kod_tuntutan_id' => 'Jenis Tuntutan',
            'makt_sys_user_masuk' => 'Makt Sys User Masuk',
            'makt_sys_tarikh_masuk' => 'Makt Sys Tarikh Masuk',
            'makt_sys_user_kemaskini' => 'Makt Sys User Kemaskini',
            'makt_sys_tarikh_kemaskini' => 'Makt Sys Tarikh Kemaskini',
            'makt_mod_tarikh_tuntutan' => 'Tarikh Tuntutan',
            'makt_mod_tempat_dituju' => 'Tempat Dituju',
            'makt_mod_butiran_perjalanan' => 'Butiran Perjalanan',
            'makt_mod_waktu_tiba_pejabat' => 'Waktu Tiba Pejabat',
            'makt_mod_waktu_bertolak' => 'Waktu Bertolak',
            'makt_mod_waktu_balik' => 'Waktu Balik',
            'makt_mod_jumlah_jam' => 'Jumlah Jam',
            'makt_mod_hitungan_km' => 'Hitungan Km',
            'makt_mod_resit' => 'Resit',
            'makt_mod_status' => 'Status',
            'tempFile' => 'Resit',
        ];
    }

    ########################RELATIONSHIP#############################

    public function getNamaKakitangan()
    {
        return $this->hasOne(Kakitangan::className(), ['id' => 'makt_fk_maklumat_anggota_id']);
    }

    public function getKodTuntutan()
    {
        return $this->hasOne(KodTuntutan::className(), ['id' => 'makt_fk_kod_tuntutan_id']);
    }

    #################################################################


    ###################DROPDOWN#####################################

    public static function getNamaKakitanganList()
    {
        $query = Kakitangan::find()->select(['id', 'ma_mod_nama_penuh'])->orderBy('ma_mod_nama_penuh ASC')->asArray()->all();
        return ArrayHelper::map($query, 'id', 'ma_mod_nama_penuh');
    }

    public static function getKategoriList()
    {
        $query = KodTuntutan::find()->select(['id', 'mod_kategori'])
                                    ->groupBy('mod_kategori')
                                    ->orderBy('id ASC')
                                    ->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_kategori');
    }

    public static function getKodKeteranganList()
    {
        $query = KodTuntutan::find()->select(['id', 'mod_jenis_tuntutan'])->groupBy('mod_jenis_tuntutan')->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_jenis_tuntutan');
    }

    public static function getKodTuntutanAList()
    {
        $query = KodTuntutan::find()->select(['id', 'mod_jenis_tuntutan'])
                                    ->where(['like', 'mod_kod_tuntutan', 'A' . '%', false])
                                    ->groupBy('mod_jenis_tuntutan')
                                    ->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_jenis_tuntutan');
    }

    public static function getKodTuntutanBList()
    {
        $query = KodTuntutan::find()->select(['id', 'mod_jenis_tuntutan'])
                                    ->where(['like', 'mod_kod_tuntutan', 'B' . '%', false])
                                    ->groupBy('mod_jenis_tuntutan')
                                    ->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_jenis_tuntutan');
    }

    public static function getKodTuntutanCList()
    {
        $query = KodTuntutan::find()->select(['id', 'mod_jenis_tuntutan'])
                                    ->where(['like', 'mod_kod_tuntutan', 'C' . '%', false])
                                    ->groupBy('mod_jenis_tuntutan')
                                    ->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_jenis_tuntutan');
    }

    public static function getKodTuntutanDList()
    {
        $query = KodTuntutan::find()->select(['id', 'mod_jenis_tuntutan'])
                                    ->where(['like', 'mod_kod_tuntutan', 'D' . '%', false])
                                    ->groupBy('mod_jenis_tuntutan')
                                    ->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_jenis_tuntutan');
    }

    public static function getKodTuntutanEList()
    {
        $query = KodTuntutan::find()->select(['id', 'mod_jenis_tuntutan'])
                                    ->where(['like', 'mod_kod_tuntutan', 'E' . '%', false])
                                    ->groupBy('mod_jenis_tuntutan')
                                    ->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_jenis_tuntutan');
    }

    public static function getKod($tuntutan = null)
    {
        $query = KodTuntutan::find()->select(['id', 'mod_jenis_tuntutan'])
                                    ->where(['like', 'mod_kod_tuntutan', $tuntutan . '%', false])
                                    ->groupBy('mod_jenis_tuntutan')
                                    ->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_jenis_tuntutan');
    }

    ###############################################################
}
