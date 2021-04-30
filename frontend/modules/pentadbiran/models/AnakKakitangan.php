<?php

namespace frontend\modules\pentadbiran\models;

use Yii;

/**
 * This is the model class for table "tbl_man_maklumat_anak".
 *
 * @property int $id
 * @property string $man_mod_nama
 * @property string $man_mod_jenis_pengenalan
 * @property string $man_mod_no_pengenalan
 * @property int $man_mod_umur
 * @property string $man_mod_tarikh_lahir
 * @property string $man_mod_tempat_lahir
 * @property string $man_mod_jenis_status
 * @property string $man_mod_nama_insitusi
 */
class AnakKakitangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_man_maklumat_anak';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['man_mod_umur'], 'integer'],
            [['man_mod_tarikh_lahir'], 'safe'],
            [['man_mod_nama', 'man_mod_tempat_lahir', 'man_mod_nama_insitusi'], 'string', 'max' => 100],
            [['man_mod_jenis_pengenalan', 'man_mod_no_pengenalan', 'man_mod_jenis_status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'man_mod_nama' => 'Nama',
            'man_mod_jenis_pengenalan' => 'Jenis Pengenalan',
            'man_mod_no_pengenalan' => 'No Pengenalan',
            'man_mod_umur' => 'Umur',
            'man_mod_tarikh_lahir' => 'Tarikh Lahir',
            'man_mod_tempat_lahir' => 'Tempat Lahir',
            'man_mod_jenis_status' => 'Jenis Status',
            'man_mod_nama_insitusi' => 'Nama Insitusi',
            'infoTarikhLahir' => 'Tarikh Lahir',
        ];
    }

    /******************************* FUNCTION RELATIONSHIP[START] *********************************/
    public function getKakitangan()
    {
        return $this->hasMany(AnakKakitangan::className(), ['man_fk_kakitangan_id' => 'id']);
    }
    /******************************* FUNCTION RELATIONSHIP[END] *********************************/


    /******************************* FUNCTION DROPDOWN[START] *********************************/
    public function dataJenisPengenalan()
    {
        return [
            'IC' => 'IC',
            'No Surat Beranak' => 'No Surat Beranak'
        ];
    }

    public function dataJenisStatus()
    {
        return [
            'Masih Belajar' => 'Masih Belajar',
            'Bekerja' => 'Bekerja',
            'Tidak Bekerja' => 'Tidak Bekerja'
        ];
    }
    /******************************* FUNCTION DROPDOWN[END] *********************************/


    /******************************* FUNCTION LAIN-LAIN[START] *********************************/
    public function getInfoTarikhLahir()
    {
       return Yii::$app->formatter->asDateTime($this->man_mod_tarikh_lahir, 'php:d-m-Y');
    }

    /******************************* FUNCTION LAIN-LAIN[END] *********************************/
}
