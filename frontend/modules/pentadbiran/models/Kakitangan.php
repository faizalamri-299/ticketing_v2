<?php

namespace frontend\modules\pentadbiran\models;
use frontend\modules\pentadbiran\models\KodDaerah;
use frontend\modules\pentadbiran\models\KodNegeri;
use frontend\modules\pentadbiran\models\Unit;
use frontend\modules\pentadbiran\models\KodCuti;
use frontend\modules\pentadbiran\models\PermohonanCuti;
use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;
use frontend\modules\pentadbiran\models\Jawatan;

use yii\helpers\ArrayHelper;

use Yii;

/**s
 * This is the model class for table "tbl_ma_maklumat_anggota".
 *
 * @property int $id
 * @property int $ma_fk_maklumat_pasangan_id
 * @property int $ma_fk_maklumat_anak_id
 *@property int $ma_mod_unit
 * @property string $ma_mod_jawatan
 * @property string $ma_mod_nama_penuh
 * @property string $ma_mod_tarikh_lahir
 * @property string $ma_mod_no_kp
 * @property string $ma_mod_status_perkahwinan
 * @property int $ma_mod_umur
 * @property string $ma_mod_alamat1
 * @property string $ma_mod_alamat2
 * @property int $ma_mod_poskod
 * @property string $ma_mod_warganegara
 * @property string $ma_mod_kelayakan_tertinggi
 * @property string $ma_mod_bidang
 * @property string $ma_mod_no_cukai_pendapatan
 * @property string $ma_mod_no_kwsp
 * @property string $ma_mod_no_akaun_bank
 * @property string $ma_mod_bank
 * @property string $ma_mod_no_hp
 * @property string $ma_mod_no_telefon_rumah
 * @property string $ma_mod_email
 *
 * @property TblManMaklumatAnak $maFkMaklumatAnak
 * @property TblMpMaklumatPasangan $maFkMaklumatPasangan
 */
class Kakitangan extends \yii\db\ActiveRecord
{
    public $tempImage;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ma_maklumat_anggota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ma_mod_umur', 'ma_mod_poskod'], 'integer'],
            [['ma_mod_tarikh_lahir'], 'safe'],
            [[ 'ma_mod_nama_penuh', 'ma_mod_gambar'], 'string', 'max' => 100],
            [['ma_mod_no_kp', 'ma_mod_bangsa','ma_mod_agama', 'ma_mod_status_perkahwinan', 'ma_mod_alamat1', 'ma_mod_alamat2','ma_mod_daerah','ma_mod_negeri', 'ma_mod_warganegara', 'ma_mod_kelayakan_tertinggi', 'ma_mod_bidang', 'ma_mod_no_cukai_pendapatan', 'ma_mod_no_kwsp', 'ma_mod_no_akaun_bank', 'ma_mod_bank', 'ma_mod_no_hp', 'ma_mod_no_telefon_rumah', 'ma_mod_email'], 'string', 'max' => 50],

            [['tempImage'], 'image', 'extensions'=>'jpg, png, jpeg, gif'],
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kajt_mod_no_kakitangan' => 'No Kakitangan',
            'ma_mod_nama_penuh' => 'Nama Penuh',
            'ma_mod_tarikh_lahir' => 'Tarikh Lahir',
            'ma_mod_no_kp' => 'No Kad Pengenalan',
            'ma_mod_bangsa' => 'Bangsa',
            'ma_mod_agama' => 'Agama',
            'ma_mod_status_perkahwinan' => 'Status Perkahwinan',
            'ma_mod_umur' => 'Umur',
            'ma_mod_alamat1' => 'Alamat1',
            'ma_mod_alamat2' => 'Alamat2',
            'ma_mod_poskod' => 'Poskod',
            'ma_mod_daerah' => 'Daerah',
            'ma_mod_negeri' => 'Negeri',
            'ma_mod_warganegara' => 'Warganegara',
            'ma_mod_kelayakan_tertinggi' => 'Kelayakan Tertinggi',
            'ma_mod_bidang' => 'Bidang',
            'ma_mod_no_cukai_pendapatan' => 'No Cukai Pendapatan',
            'ma_mod_no_kwsp' => 'No KWSP',
            'ma_mod_no_akaun_bank' => 'No Akaun Bank',
            'ma_mod_bank' => 'Bank',
            'ma_mod_no_hp' => 'No Hp',
            'ma_mod_no_telefon_rumah' => 'No Telefon Rumah',
            'ma_mod_email' => 'Email',
            'ma_mod_gambar' => 'Gambar',
            'infoTarikhLahir' => 'Tarikh Lahir',
            'infoUnit' => 'Unit',
            'infoJawatan' => 'Jawatan',
            'infoAlamat' => 'Alamat',
            'tempImage' => 'Gambar',
        ];
    }



    /******************************* FOREGIN KEY [START] *********************************/

    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'ma_fk_ut_id']);
    }

    public function getPasangan()
    {
        return $this->hasMany(PasanganKakitangan::className(), ['mp_fk_kakitangan_id' => 'id']);
    }

    public function getKakitanganHasJawatan()
    {
        return $this->hasOne(KakitanganHasJawatan::className(), ['kajt_fk_kakitangan_id' => 'id']);
    }

    public function getJawatan()
    {
        return $this->hasMany (Jawatan::className(), ['id' => 'id'])
        ->via ('kakitanganHasJawatan');
    }

    //relationship to intermiediate table (KakitanganHasKodCuti)
    public function getKakitanganHasKodCuti()
    {
        return $this->hasMany(KakitanganHasKodCuti::className(), ['makc_fk_maklumat_anggota_id' => 'id']);
    }

    //relationship to access to table kod cuti through intermediate table (KakitanganHasKodCuti)
    public function getKodCuti()
    {
        return $this->hasMany(KodCuti::className(), ['id' => 'id'])
        ->via ('kakitanganHasKodCuti');
    }

    public function getPermohonanCuti()
    {
        return $this->hasMany(PermohonanCuti::className(), ['pc_fk_maklumat_anggota_id' => 'id']);
    }

    public function getKodDaerah()
    {
        return $this->hasOne(KodDaerah::className(), ['id' => 'ma_mod_daerah']);
    }

    public function getKodNegeri()
    {
        return $this->hasOne(KodNegeri::className(), ['id' => 'ma_mod_negeri']);
    }
    /******************************* FOREGIN KEY [END] *********************************/

    /******************************* FUNCTION DROPDOWN [START] *********************************/

    public static function getDropDownKodDaerah()
    {
        $query = KodDaerah::find()->select(['id', 'keterangan'])->orderBy('keterangan ASC')->asArray()->all();
        return ArrayHelper::map($query, 'id', 'keterangan');
    }

    public static function getDropDownKodNegeri()
    {
        $query = KodNegeri::find()->select(['id', 'keterangan'])->orderBy('kod ASC')->asArray()->all();
        return ArrayHelper::map($query, 'id', 'keterangan');
    }

    public static function getKodUnit()
    {
        $query = Unit::find()->select(['id','ut_mod_kod', 'keterangan' => 'CONCAT(" [", ut_mod_kod, "] ", ut_mod_nama_unit)'])->orderBy('ut_mod_kod ASC')->asArray()->all();

        return ArrayHelper::map($query, 'id', 'keterangan');

    }

    public static function getJawatanDepDrop($unitId)
    {
        $droptions = Jawatan::find()->select(['tbl_jt_jawatan.id as id', 'CONCAT("[",tbl_ut_unit.ut_mod_kod, jt_mod_kod,"] ", jt_mod_nama_jawatan) AS `name`'])->joinWith('unit')->where(['jt_fk_ut_id'=>$unitId])->asArray()->orderBy(['jt_mod_kod' => SORT_ASC])->all();
        
        return $droptions;
    }


    public function dataKategoriAnggota()
    {
        return [
            'Kakitangan' => 'Kakitangan',
            'Anggota' => 'Anggota'
        ];
    }
    public function dataBangsa()
    {
        return [
            'Melayu' => 'Melayu',
            'Cina' => 'Cina',
            'India' => 'India',
            'Bumiputera' => 'Bumiputera',
            'Lain-lain' => 'Lain-lain'
        ];
    }

    public function dataAgama()
    {
        return [
            'Islam' => 'Islam',
            'Buddha' => 'Buddha',
            'Hindu' => 'Hindu',
            'Kristian' => 'Kristian',
            'Sikh' => 'Sikh'
        ];
    }

    public function dataStatusPerkahwinan()
    {
        return [
            'Bujang' => 'Bujang',
            'Berkahwin' => 'Berkahwin',
            'Duda' => 'Duda',
            'Janda' => 'Janda',
        ];
    }

    public function dataWarganegara()
    {
        return [
            'Warganegara' => 'Warganegara',
            'Bukan Warganegara' => 'Bukan Warganegara'
        ];
    }

    public function dataKelayakan()
    {
        return [
            'SPM' => 'SPM',
            'Sijil' => 'Sijil',
            'STPM' => 'STPM',
            'Diploma' => 'Diploma',
            'Ijazah Sarjana Muda' => 'Ijazah Sarjana Muda',
            'A-Level' => 'A-Level',
            'Ijazah Sarjana' => 'Ijazah Sarjana',
            'phD' => 'phD'
        ];
    }

    public function dataNamaBank()
    {
        return [
            'Affin Bank' => 'Affin Bank',
            'Alliance Bank' => 'Alliance Bank',
            'Am Bank' => 'Am Bank',
            'Bank Muamalat' => 'Bank Muamalat',
            'Bank Islam' => 'Bank Islam',
            'CIMB Bank' => 'CIMB Bank',
            'Citi Bank' => 'Citi Bank',
            'HSBC Bank' => 'HSBC Bank',
            'Hong Leong Bank' => 'Hong Leong Bank',
            'Maybank' => 'Maybank',
            'OCBC Bank' => 'OCBC Bank',
            'Public Bank' => 'Public Bank',
            'RHB Bank' => 'RHB Bank'
        ];
    }

    /******************************* FUNCTION DROPDOWN [END] *********************************/

    /******************************* FUNCTION LAIN-LAIN[START] *********************************/
    public function getPathPhotoMedium()
    {
        if(!empty($this->ma_mod_gambar)) {
            $fotoPath = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/images/kakitangan/' . $this->id . '/m_' . $this->ma_mod_gambar;
        } else {
            $fotoPath =Yii::$app->request->baseUrl . '/img/l_photo-not-available.jpg';
        }

        return $fotoPath;
    }

    public function getPathPhotoThumbnail()
    {
        if(!empty($this->ma_mod_gambar)) {
            $fotoPath = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/images/kakitangan/' . $this->id . '/t_' . $this->ma_mod_gambar;
        } else {
            $fotoPath =Yii::$app->request->baseUrl . '/img/t_photo-not-available.jpg';
        }

        return $fotoPath;
    }

    public function getPathPhotoSmall()
    {
        if(!empty($this->ma_mod_gambar)) {
            $fotoPath = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/images/kakitangan/' . $this->id . '/s_' . $this->ma_mod_gambar;
        } else {
            $fotoPath =Yii::$app->request->baseUrl . '/img/s_photo-not-available.jpg';
        }

        return $fotoPath;
    }

    public function getPathPhotoLarge()
    {
        if(!empty($this->ma_mod_gambar)) {
            $fotoPath = Yii::getAlias('@web') . Yii::$app->params['filePath'] . '/images/kakitangan/' . $this->id . '/l_' . $this->ma_mod_gambar;
        } else {
            $fotoPath =Yii::$app->request->baseUrl . '/img/l_photo-not-available.jpg';
        }

        return $fotoPath;
    }

    public function getInfoTarikhLahir()
    {
       return Yii::$app->formatter->asDateTime($this->ma_mod_tarikh_lahir, 'php:d-m-Y');
    }

    public function getInfoDaerah()
    {
        return $this->kodDaerah->keterangan;
    }

    public function getInfoNegeri()
    {
        return $this->kodNegeri->keterangan;
    }

    public function getInfoAlamat()
    {
        return $this->ma_mod_alamat1 . ', ' . $this->ma_mod_alamat2 . ', '. $this->ma_mod_poskod . ', ' . $this->infoDaerah . ' , ' . $this->infoNegeri;
    }

    /******************************* FUNCTION LAIN-LAIN[END] *********************************/

}
