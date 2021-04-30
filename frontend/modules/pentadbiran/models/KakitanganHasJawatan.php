<?php

namespace frontend\modules\pentadbiran\models;
use yii\helpers\ArrayHelper;
use frontend\modules\pentadbiran\models\Unit;
use frontend\modules\pentadbiran\models\Jawatan;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\KakitanganHasKodCuti;
use Yii;

/**
 * This is the model class for table "tbl_kajt_kakitangan_has_jawatan".
 *
 * @property int $id
 * @property string $kajt_fk_kakitangan_id
 * @property string $kajt_fk_jawatan_id
 * @property string $kajt_mod_tarikh_lantikan
 * @property string $kajt_mod_tarikh_tamat
 * @property string $kajt_mod_status_kakitangan
 * @property string $kajt_mod_no_kakitangan
 * @property string $kajt_flag_eksekutif
 * @property string $kajt_mod_kategori_anggota
 */
class KakitanganHasJawatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kajt_kakitangan_has_jawatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kajt_mod_tarikh_lantikan', 'kajt_mod_tarikh_tamat'], 'safe'],
            [['kajt_fk_kakitangan_id', 'kajt_fk_jawatan_id'], 'integer'],
            [['kajt_mod_status_kakitangan', 'kajt_mod_no_kakitangan', 'kajt_mod_unit'], 'string', 'max' => 100],
            [['kajt_flag_eksekutif'], 'string', 'max' => 50],
            [['kajt_mod_kategori_anggota'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kajt_fk_kakitangan_id' => 'Kajt Fk Kakitangan ID',
            'kajt_fk_jawatan_id' => 'Jawatan',
            'kajt_mod_unit' => 'Unit',
            'kajt_mod_tarikh_lantikan' => 'Tarikh Lantikan',
            'kajt_mod_tarikh_tamat' => 'Tarikh Tamat Berkhidmat',
            'kajt_mod_status_kakitangan' => 'Status Kakitangan',
            'kajt_mod_no_kakitangan' => 'No Kakitangan',
            'kajt_flag_eksekutif' => 'Eksekutif',
            'kajt_mod_kategori_anggota' => 'Kategori Anggota',
            'infoTarikhLantikan' => 'Tarikh Lantikan',
            'infoTarikhTamat' => 'Tarikh Tamat',
            'infoStatus' => 'Status',
        ];
    }

    public function dataEksekutif()
    {
        return [
            'Eksekutif' => 'Eksekutif',
            'Bukan Eksekutif' => 'Bukan Eksekutif'
        ];
    }

    public function dataKategoriAnggota()
    {
        return [
            'Kakitangan' => 'Kakitangan',
            'Anggota' => 'Anggota'
        ];
    }

    public function getInfoJawatan()
    {
        return $this->jawatan->jt_mod_nama_jawatan;
    }
    public function getInfoUnit()
    {
        return $this->jawatan->unit->ut_mod_nama_unit;
    }

    public function getInfoTarikhLantikan()
    {
       return Yii::$app->formatter->asDateTime($this->kajt_mod_tarikh_lantikan, 'php:d-m-Y');
    }

    public function getInfoTarikhTamat()
    {
       return Yii::$app->formatter->asDateTime($this->kajt_mod_tarikh_tamat, 'php:d-m-Y');
    }

    public function getInfoStatus()
    {
        if($this->kajt_mod_status_kakitangan == 1){
            return '<span class="badge badge-success">'.'Aktif'.' </span>';
        }elseif($this->kajt_mod_status_kakitangan == 2){
            return '<span class="badge badge-warning">'.'Tidak Aktif'.' </span>';
        }else{
            return '<span class="badge badge-danger">'.'Tidak Diisi'.' </span>';
        }
    }

     /******************************* FOREGIN KEY [START] *********************************/

    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'ma_fk_ut_id']);
    }

    public function getJawatan()
    {
         return $this->hasOne(Jawatan::className(), ['id' => 'kajt_fk_jawatan_id']);
    }

    public function getKakitangan()
    {
        return $this->hasOne(Kakitangan::className(), ['id' => 'kajt_fk_kakitangan_id']);
    }

    public function getKakitanganHasKodCuti()
    {
        return $this->hasOne(KakitanganHasKodCuti::className(), ['id' => 'kajt_fk_kakitangan_id']);
    }


    /******************************* FOREGIN KEY [END] *********************************/

    /******************************* DROPDOWN FUNCTION [START] *********************************/

      public static function getKodUnit()
    {
        $query = Unit::find()->select(['id','ut_mod_kod', 'keterangan' => 'CONCAT(" [", ut_mod_kod, "] ", ut_mod_nama_unit)'])->orderBy('ut_mod_kod ASC')->asArray()->all();

        return ArrayHelper::map($query, 'id', 'keterangan');

    }

    public static function getJawatanDepDrop($unitId)
    {
        $droptions = Jawatan::find()
            ->select(['tbl_jt_jawatan.id as id', 'CONCAT("[",tbl_ut_unit.ut_mod_kod, jt_mod_kod,"] ", jt_mod_nama_jawatan) AS `name`'])
            ->joinWith('unit')
            ->where(['jt_fk_ut_id'=>$unitId])
            ->asArray()->orderBy(['jt_mod_kod' => SORT_ASC])
            ->all();
        
        return $droptions;
    }

    public static function getList($unitId = NULL)
    {
        $droptions = Jawatan::find()
            ->select(['tbl_jt_jawatan.id as id', 'CONCAT("[",tbl_ut_unit.ut_mod_kod, jt_mod_kod,"] ", jt_mod_nama_jawatan) AS `name`'])
            ->joinWith('unit')
            ->where(['jt_fk_ut_id'=>$unitId])
            ->asArray()->orderBy(['jt_mod_kod' => SORT_ASC])
            ->all();

        return ArrayHelper::map($droptions, 'id', 'name');
    }
    

    /******************************* DROPDOWN FUNCTION [END] *********************************/
}
