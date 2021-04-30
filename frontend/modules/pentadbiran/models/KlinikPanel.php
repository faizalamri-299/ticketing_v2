<?php

namespace frontend\modules\pentadbiran\models;

use Yii;

/**
 * This is the model class for table "tbl_kp_klinik_panel".
 *
 * @property int $id
 * @property string $kp_mod_nama
 * @property string $kp_mod_no_syarikat
 * @property string $kp_mod_no_telefon
 * @property string $kp_mod_emel
 * @property string $kp_mod_alamat1
 * @property string $kp_mod_alamat2
 * @property string $kp_mod_poskod
 * @property int $kp_kod_daerah
 * @property int $kp_kod_negeri
 */
class KlinikPanel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kp_klinik_panel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kp_mod_nama', 'kp_mod_no_syarikat', 'kp_mod_no_telefon', 'kp_mod_emel', 'kp_mod_alamat1', 'kp_mod_alamat2', 'kp_mod_poskod', 'kp_mod_daerah', 'kp_mod_negeri'], 'required'],
            [['kp_mod_daerah', 'kp_mod_negeri'], 'integer'],
            [['kp_mod_nama'], 'string', 'max' => 256],
            [['kp_mod_no_syarikat', 'kp_mod_alamat1', 'kp_mod_alamat2'], 'string', 'max' => 100],
            [['kp_mod_no_telefon'], 'string', 'max' => 11],
            [['kp_mod_emel'], 'string', 'max' => 320],
            [['kp_mod_poskod'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kp_mod_nama' => 'Nama Klinik',
            'kp_mod_no_syarikat' => 'No Pendaftaran Syarikat',
            'kp_mod_no_telefon' => 'No Telefon',
            'kp_mod_emel' => 'Emel',
            'kp_mod_alamat1' => 'Alamat',
            'kp_mod_alamat2' => '',
            'kp_mod_poskod' => 'Poskod',
            'InfoDaerah' => 'Daerah',
            'InfoAlamat' => 'Alamat',
            'InfoNegeri' => 'Negeri',
            'kp_mod_daerah'=>'Daerah',
            'kp_mod_negeri'=>'Negeri'
        ];
    }

    public function getKodDaerah()
    {
        return $this->hasOne(KodDaerah::className(), ['id' => 'kp_mod_daerah']);
    }

    public function getKodNegeri()
    {
        return $this->hasOne(KodNegeri::className(), ['id' => 'kp_mod_negeri']);
    }

    public static function getKodDaerahList()
    {
        $query = KodDaerah::find()->select(['id','kod', 'keterangan'])->orderBy('kod ASC')->asArray()->all();
        return ArrayHelper::map($query, 'kod', 'keterangan');
    }

    public function getInfoDaerah()
    {
        return $this->kodDaerah->keterangan;
    }
    public static function getKodNegeriList()
    {
        $query = KodNegeri::find()->select(['id','kod', 'keterangan'])->orderBy('kod ASC')->asArray()->all();
        return ArrayHelper::map($query, 'kod', 'keterangan');
    }

    public function getInfoNegeri()
    {
        return $this->kodNegeri->keterangan;
    }

    public static function getAlamat()
    {
        $query = KlinikPanel::find()
        ->select(['CONCAT(kp_mod_alamat1,kp_mod_alamat2) AS name','kp_mod_alamat1 AS label','id as id'])
        ->asArray()
        ->one();
    }

    public function getInfoAlamat()
    {
        return $this->kp_mod_alamat1 . ', ' . $this->kp_mod_alamat2 . ', '. $this->kp_mod_poskod . ', ' . $this->InfoDaerah . ' , ' . $this->InfoNegeri;
    }
}



