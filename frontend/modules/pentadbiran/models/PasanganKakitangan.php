<?php

namespace frontend\modules\pentadbiran\models;

use Yii;

/**
 * This is the model class for table "tbl_mp_maklumat_pasangan".
 *
 * @property int $id
 * @property string $mp_mod_nama
 * @property string $mp_mod_tarikh_lahir
 * @property string $mp_mod_no_kp
 * @property string $mp_mod_warganegara
 * @property string $mp_mod_pekerjaan
 * @property string $mp_mod_nama_majikan
 * @property string $mp_mod_alamat_majikan1
 * @property string $mp_mod_alamat_majikan2
 * @property int $mp_mod_poskod
 * @property string $mp_mod_no_hp
 * @property string $mp_mod_no_pejabat
 */
class PasanganKakitangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_mp_maklumat_pasangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mp_mod_tarikh_lahir'], 'safe'],
            [['mp_mod_poskod', 'mp_fk_kakitangan_id'], 'integer'],
            [['mp_mod_nama', 'mp_mod_nama_majikan'], 'string', 'max' => 100],
            [['mp_mod_no_kp', 'mp_mod_warganegara', 'mp_mod_pekerjaan', 'mp_mod_alamat_majikan1', 'mp_mod_alamat_majikan2', 'mp_mod_no_hp', 'mp_mod_no_pejabat'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mp_mod_nama' => 'Nama',
            'mp_mod_tarikh_lahir' => 'Tarikh Lahir',
            'mp_mod_no_kp' => 'No Kp',
            'mp_mod_warganegara' => 'Warganegara',
            'mp_mod_pekerjaan' => 'Pekerjaan',
            'mp_mod_nama_majikan' => 'Nama Majikan',
            'mp_mod_alamat_majikan1' => 'Alamat Majikan1',
            'mp_mod_alamat_majikan2' => 'Alamat Majikan2',
            'mp_mod_poskod' => 'Poskod',
            'mp_mod_no_hp' => 'No Hp',
            'mp_mod_no_pejabat' => 'No Pejabat',
            'infoAlamat' => 'Alamat',
            'infoTarikhLahir' => 'Tarikh Lahir',
            'infoNamaMajikan' => 'Nama Majikan',

        ];
    }
    /******************************* FUNCTION RELATIONSHIP[START] *********************************/
    public function getKakitangan()
    {
        return $this->hasOne(Kakitangan::className(), ['id' => 'mp_fk_kakitangan_id']);
    }
    /******************************* FUNCTION RELATIONSHIP[END] *********************************/

    /******************************* FUNCTION DROPDOWN[START] *********************************/
    public function dataWarganegara()
    {
        return [
            'Warganegara' => 'Warganegara',
            'Bukan Warganegara' => 'Bukan Warganegara'
        ];
    }
    /******************************* FUNCTION DROPDOWN[END] *********************************/


    /******************************* FUNCTION LAIN-LAIN[START] *********************************/
    public function getInfoAlamat()
    {
        if($this->mp_mod_alamat_majikan1 != NULL){
            return $this->mp_mod_alamat_majikan1 . ', ' . $this->mp_mod_alamat_majikan2 . ', ' . $this->mp_mod_poskod;
        }else{
            return 'Tidak Diisi';
        }
    }

    public function getInfoTarikhLahir()
    {
       return Yii::$app->formatter->asDateTime($this->mp_mod_tarikh_lahir, 'php:d-m-Y');
    }

    public function getInfoPekerjaan()
    {
        if($this->mp_mod_pekerjaan != NULL){
            return $this->mp_mod_pekerjaan;
        }else{
            return 'Tidak Diisi';
        }
    }

    public function getInfoNamaMajikan()
    {
        if($this->mp_mod_nama_majikan != NULL){
            return $this->mp_mod_nama_majikan;
        }else{
            return 'Tidak Diisi';
        }
    }

    public function getInfoNoPejabat()
    {
        if($this->mp_mod_no_pejabat != NULL){
            return $this->mp_mod_no_pejabat;
        }else{
            return 'Tidak Diisi';
        }
    }

    /******************************* FUNCTION LAIN-LAIN[END] *********************************/
}
