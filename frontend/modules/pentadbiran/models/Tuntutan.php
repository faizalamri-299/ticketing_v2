<?php

namespace frontend\modules\pentadbiran\models;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;
use frontend\modules\pentadbiran\models\KodKategoriTuntutan;
use frontend\modules\pentadbiran\models\KodTuntutan;
use yii\helpers\ArrayHelper;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

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
        return 'tbl_makt_maklumat_anggota_has_kod_tuntutan';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            'timestamp' => [
                'class'=>  \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['makt_sys_tarikh_masuk', 'makt_sys_tarikh_kemaskini'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE =>  ['makt_sys_tarikh_kemaskini'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'makt_sys_user_masuk',
                'updatedByAttribute' => 'makt_sys_user_kemaskini',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['makt_fk_maklumat_anggota_id', 'makt_fk_kategori_tuntutan', 'makt_fk_kod_tuntutan_id', 'makt_sys_user_masuk', 'makt_sys_user_kemaskini', 'makt_mod_status'], 'integer'],
            [['makt_sys_tarikh_masuk', 'makt_sys_tarikh_kemaskini', 'makt_mod_tarikh_tuntutan','makt_mod_waktu_keluar_pejabat', 'makt_mod_waktu_tiba_pejabat', 'makt_mod_waktu_bertolak', 'makt_mod_waktu_balik'], 'safe'],
            [['makt_mod_butiran_tuntutan', 'makt_mod_tempat_dari','makt_mod_tempat_dituju', 'makt_mod_butiran_perjalanan', 'makt_mod_resit'], 'string', 'max' => 256],
            [['makt_mod_hitungan_km','makt_mod_kiraan_tuntutan_perjalanan','makt_mod_jam'], 'string', 'max' => 100],
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
            'makt_sys_tarikh_masuk' => 'Makt Sys User Masuk',
            'makt_sys_user_kemaskini' => 'Makt Sys User Kemaskini',
            'makt_sys_tarikh_kemaskini' => 'Makt Sys Tarikh Kemaskini',
            'makt_mod_butiran_tuntutan' => 'Butiran Tuntutan',
            'makt_mod_tarikh_tuntutan' => 'Tarikh Tuntutan',
            'makt_mod_tempat_dari' => 'Dari',
            'makt_mod_tempat_dituju' => 'Tempat Dituju',
            'makt_mod_butiran_perjalanan' => 'Butiran Perjalanan',
            'makt_mod_waktu_keluar_pejabat' => 'Waktu Keluar Pejabat',
            'makt_mod_waktu_tiba_pejabat' => 'Waktu Tiba Pejabat',
            'makt_mod_waktu_bertolak' => 'Waktu Bertolak',
            'makt_mod_waktu_balik' => 'Waktu Balik',
            'makt_mod_jam' => 'Jam',
            'makt_mod_hitungan_km' => 'Hitungan Km',
            'makt_mod_kiraan_tuntutan_perjalanan' => 'Jumlah Tuntutan',
            'makt_mod_resit' => 'Resit',
            'makt_mod_status' => 'Status',
            'infoMasa' => 'Tarikh Tuntutan',
            'infoStatus' => 'Status',
            'tempFile' => 'Resit',
        ];
    }

    ########################RELATIONSHIP#############################

    public function getNamaKakitangan()
    {
        return $this->hasOne(Kakitangan::className(), ['id' => 'makt_fk_maklumat_anggota_id']);
    }

    public function getKategori()
    {
        return $this->hasOne(KodKategoriTuntutan::className(), ['id' => 'makt_fk_kategori_tuntutan']);
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

    public static function getTuntutanDepDrop($tuntutanId)
    {
        $droptions = KodTuntutan::find()->select(['tbl_kod_tuntutan.id as id' , 'mod_jenis_tuntutan as name'])
                                        ->joinWith('kategori')
                                        ->where(['kt_fk_kod_id'=>$tuntutanId])
                                        ->groupBy('mod_jenis_tuntutan')
                                        ->asArray()->orderBy(['kt_fk_kod_id' => SORT_ASC])->all();
        
        return $droptions;
    }

    public static function getList($tuntutanId = NULL)
    {
        $droptions = KodTuntutan::find()->select(['tbl_kod_tuntutan.id as id' , 'mod_jenis_tuntutan as name'])
                                ->joinWith('kategori')
                                ->where(['kt_fk_kod_id'=>$tuntutanId])
                                ->groupBy('mod_jenis_tuntutan')
                                ->asArray()->orderBy(['kt_fk_kod_id' => SORT_ASC])->all();
        return ArrayHelper::map($droptions, 'id', 'name');
    }


    ###############################################################

    ##########################Function#############################

    public function getInfoStatus($upsize = false)
    {
        switch($this->makt_mod_status) {
            case 0:
                $text = "<span class=\"badge badge-warning\">Baru</span>"; break;
            case 1:
                $text = "<span class=\"badge badge-info\">Semakan</span>"; break;
            case 2:
                $text = "<span class=\"badge badge-success\">Lulus</span>"; break;
            case 3:
                $text = "<span class=\"badge badge-danger\">Ditolak</span>"; break;
            default:
                $text = '-'; break;
        }

        return $upsize ? "<h5>$text</h5>" : $text;
    }

    public function getFilePathDownload()
    {
        return Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/files/TuntutanResit/' . $this->id.'/'. $this->makt_mod_resit;
    }

    public function getInfoMasa()
    {
       return Yii::$app->formatter->asDateTime($this->makt_sys_tarikh_masuk, 'php:d-m-Y h:i:s A');
    }

    public function getFilePathView()
    {
        if(!empty($this->makt_mod_resit)) {
            $fotoPath = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/files/TuntutanResit/' . $this->id. $this->makt_mod_resit;
        } else {
            $fotoPath = Yii::getAlias('@web') . '/img/l_photo-not-available.jpg';
        }

        return $fotoPath;
    }

    ###############################################################
}
