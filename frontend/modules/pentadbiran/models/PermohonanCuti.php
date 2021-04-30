<?php

namespace frontend\modules\pentadbiran\models;
use frontend\modules\pentadbiran\models\KodCuti;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;
use frontend\modules\pentadbiran\models\KodKategoriCuti;
use yii\helpers\ArrayHelper;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "tbl_pc_permohonan_cuti".
 *
 * @property int $id
 * @property int $pc_fk_id_kakitangan
 * @property int $pc_fk_id_kod_cuti
 * @property string $pc_mod_tarikh_mula
 * @property string $pc_mod_tarikh_tamat
 * @property int $pc_sys_bil_cuti
 * @property string $pc_mod_jenis_cuti
 * @property string $pc_mod_keterangan
 * @property string $pc_mod_nama_surat_sokongan
 * @property string $pc_mod_surat_sokongan
 *
 * @property TblMaMaklumatAnggota $pcFkIdKakitangan
 * @property TblKodCuti $pcFkIdKodCuti
 */
class PermohonanCuti extends \yii\db\ActiveRecord
{
    public $tempSurat;
    public $tarikh;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_pc_permohonan_cuti';
    }

    public function behaviors() {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            'timestamp'=>[
                'class'=>  TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['pc_sys_tarikh_masuk', 'pc_sys_tarikh_kemaskini'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['pc_sys_tarikh_kemaskini'],
                ],
                'value'=> new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'pc_sys_user_masuk',
                'updatedByAttribute' => 'pc_sys_user_kemaskini',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['pc_fk_id_kakitangan', 'pc_fk_id_kod_cuti', 'pc_mod_tarikh_mula', 'pc_mod_tarikh_tamat', 'pc_sys_bil_cuti', 'pc_mod_jenis_cuti', 'pc_mod_keterangan', 'pc_mod_nama_surat_sokongan', 'pc_mod_surat_sokongan'], 'required'],
            [["id",'pc_fk_maklumat_anggota_id', 'pc_fk_maklumat_anggota_cuti_id', 'pc_fk_kod_cuti_id', 'pc_sys_user_masuk', 'pc_sys_user_kemaskini'], 'integer'],
            [['pc_mod_tarikh_mula', 'pc_mod_tarikh_tamat', 'tarikh', 'pc_sys_tarikh_masuk', 'pc_sys_tarikh_kemaskini'], 'safe'],
            [['pc_sys_baki_cuti', 'pc_sys_bil_cuti'], 'number'],
            [['pc_mod_status'], 'string', 'max' => 100],
            [['pc_mod_jenis_cuti'], 'string', 'max' => 50],
            [['pc_mod_nama_surat_sokongan','pc_mod_keterangan'], 'string', 'max' => 256],
            [['pc_mod_surat_sokongan'], 'file'],
            [['tempSurat'], 'string', 'max' => 256],
            // [['pc_fk_id_kakitangan'], 'exist', 'skipOnError' => true, 'targetClass' =>PermohonanCuti::className(), 'targetAttribute' => ['pc_fk_id_kakitangan' => 'id']],
            //  [['pc_fk_id_kod_cuti'], 'exist', 'skipOnError' => true, 'targetClass' =>KodCuti::className(), 'targetAttribute' => ['pc_fk_id_kod_cuti' => 'id']],
             // ['pc_mod_tarikh_mula', 'compare', 'compareAttribute' => 'pc_mod_tarikh_tamat', 'operator' => '<='],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pc_fk_maklumat_anggota_id' => 'Nama Kakitangan',
            'pc_fk_kod_cuti_id' => 'Kategori Cuti',
            'pc_mod_tarikh_mula' => 'Tarikh Mula',
            'pc_mod_tarikh_tamat' => 'Tarikh Tamat',
            'pc_sys_bil_cuti' => 'Bilangan Hari Cuti',
            'pc_mod_jenis_cuti' => 'Jenis Cuti',
            'pc_mod_keterangan' => 'Keterangan',
            'pc_mod_nama_surat_sokongan' => 'Nama Surat Sokongan',
            'pc_mod_surat_sokongan' => 'Dokumen Sokongan',
            'infoCuti' => 'Kategori Cuti',
            'pc_sys_baki_cuti' => 'Baki Cuti',
            'infoStatusCuti' => 'Status',
            'tempSurat' => 'Dokumen Sokongan',
            'infoKakitangan'=>'Nama Kakitangan',
            'infoJenisCuti'=>'Kategori Cuti',
            'tarikh' => 'Tempoh Cuti',
        ];
    }


    /************************************* RELATIONSHIP [START] ******************************/
     public function getKodCuti()
    {
        return $this->hasOne(KodCuti::className(), ['id' => 'pc_fk_kod_cuti_id']);
    }
    public function getKakitanganHasKodCuti()
    {
        return $this->hasOne(KakitanganHasKodCuti::className(), ['id' => 'pc_fk_maklumat_anggota_cuti_id']);
    }
    public function getKakitangan()
    {
        return $this->hasOne(Kakitangan::className(), ['id' => 'pc_fk_maklumat_anggota_id']);
    }
    public function getKodKategoriCuti()
    {
        return $this->hasOne(KodKategoriCuti::className(), ['id' => 'pc_mod_jenis_cuti']);
    }

    /************************************* RELATIONSHIP [END] ******************************/
    

    /************************************* DROPDOWN [START] ******************************/


    public static function getKodCutiDepDrop($kakitanganId)
    {
         $droptions = KakitanganHasKodCuti::find()
            ->select(['tbl_kod_cuti.id as id', 'CONCAT("",tbl_kod_cuti.mod_jenis," ","[" ,makc_sys_baki_cuti,"]") AS `name`'])
            ->joinWith('kodCuti')
            ->where(['makc_fk_maklumat_anggota_id'=>$kakitanganId])
            ->asArray()->orderBy(['mod_jenis' => SORT_ASC])
            ->all();
        
        return $droptions;

    }

    public static function getList($kakitanganId = NULL)
    {
        $droptions = KakitanganHasKodCuti::find()
            ->select(['tbl_kod_cuti.id as id', 'CONCAT("[",tbl_kod_cuti.mod_jenis,"] ") AS `name`'])
            ->joinWith('kodCuti')
            ->where(['makc_fk_maklumat_anggota_id'=>$kakitanganId])
            ->asArray()->orderBy(['mod_jenis' => SORT_ASC])
            ->all();

        return ArrayHelper::map($droptions, 'id', 'name');
    }

    /************************************* DROPDOWN [END] ******************************/

    /************************************* FUNCTION [START] ******************************/

     public function getInfoCuti()
    {
        return $this->kodCuti->mod_jenis;
    }

     public function getInfoJenisCuti()
    {
        return $this->kodKategoriCuti->kkc_mod_kategori;
    }

    public function getInfoStatusCuti($upsize = false)
    {
        switch($this->pc_mod_status) {
            case 0:
                $text = "<span class=\"badge badge-warning\">Dalam Proses</span>"; break;
            case 1:
                $text = "<span class=\"badge badge-success\">Disokong</span>"; break;
            case 2:
                $text = "<span class=\"badge badge-danger\">Tidak Disokong</span>"; break;
            case 3:
                $text = "<span class=\"badge badge-success\">Disahkan</span>"; break;
            case 4:
                $text = "<span class=\"badge badge-danger\">Tidak Disahkan</span>"; break;
            case 5:
                $text = "<span class=\"badge badge-success\">DiLuluskan</span>"; break;
            case 6:
                $text = "<span class=\"badge badge-danger\">Tidak Diluluskan</span>"; break;
            case 7:
                $text = "<span class=\"badge badge-danger\">Pembatalan Cuti</span>"; break;
            default:
                $text = '-'; break;
        }

        return $upsize ? "<h5>$text</h5>" : $text;
    }
    //get the kakitangan name that has been stored in the KakitanganHasKodCuti table
      public static function getKakitanganName()
    {
        $query = KakitanganHasKodCuti::find()
            ->select(['id', 'makc_fk_maklumat_anggota_id'])
            ->with('kakitangan')
            ->orderBy('makc_fk_maklumat_anggota_id ASC')
            ->asArray()->all();

        return ArrayHelper::map($query,'makc_fk_maklumat_anggota_id', 'kakitangan.ma_mod_nama_penuh');
    }

    public function getInfoKakitangan()
    {
        return $this->kakitangan->ma_mod_nama_penuh;
    }

    public function getFilePathDownload()
    {
        return Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/files/SuratSokongan/' . $this->id.'/'. $this->pc_mod_surat_sokongan;
    }

    public function getFilePathView()
    {
        if(!empty($this->makt_mod_resit)) {
            $fotoPath = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/files/SuratSokongan/' . $this->id. $this->pc_mod_surat_sokongan;
        } else {
            $fotoPath = Yii::getAlias('@web') . '/img/l_photo-not-available.jpg';
        }

        return $fotoPath;
    }
      
    /************************************* FUNCTION [END] ******************************/

    /************************************* VIRTUAL FIELD [START] ******************************/



    /************************************* VIRTUAL FIELD [END] ******************************/
}
