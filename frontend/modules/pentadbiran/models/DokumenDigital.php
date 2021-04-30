<?php

namespace frontend\modules\pentadbiran\models;
use frontend\modules\pentadbiran\models\KodJenisDokumen;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "tbl_dd_dokumen_digital".
 *
 * @property int $id
 * @property int $dd_fk_kod_jenis_dokumen_id
 * @property string $dd_mod_tajuk_dokumen
 * @property string $dd_mod_no_rujukan
 * @property string $dd_mod_dokumen_daripada
 * @property string $dd_mod_dokumen_kepada
 * @property string $dd_mod_tarikh_terima
 * @property string $dd_mod_tarikh_serah
 *
 * @property TblKodJenisDokumen $ddFkKodJenisDokumen
 */
class DokumenDigital extends \yii\db\ActiveRecord
{
    public $tempFile;
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'tbl_dd_dokumen_digital';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['dd_fk_kod_jenis_dokumen_id', 'dd_mod_tajuk_dokumen', 'dd_mod_no_rujukan', 'dd_mod_dokumen_daripada', 'dd_mod_dokumen_kepada', 'dd_mod_tarikh_terima', 'dd_mod_tarikh_serah'], 'required'],
            [['dd_fk_kod_jenis_dokumen_id'], 'integer'],
            [['dd_mod_tarikh_terima', 'dd_mod_tarikh_serah','tarikhTerima'], 'safe'],
             [['dd_mod_dokumen'],'file'],
            [['dd_mod_tajuk_dokumen'], 'string', 'max' => 256],
            [['dd_mod_no_rujukan', 'dd_mod_dokumen_daripada', 'dd_mod_dokumen_kepada', 'dd_mod_dokumen', 'tempFile'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dd_fk_kod_jenis_dokumen_id' => 'Nama Dokumen',
            'dd_mod_tajuk_dokumen' => 'Tajuk Dokumen',
            'dd_mod_no_rujukan' => 'No Rujukan',
            'dd_mod_dokumen_daripada' => 'Dokumen Daripada',
            'dd_mod_dokumen_kepada' => 'Dokumen Kepada',
            'dd_mod_tarikh_terima' => 'Tarikh Terima',
            'dd_mod_tarikh_serah' => 'Tarikh Serah',
            'dd_mod_dokumen' => 'Fail Dokumen',
            'infoTarikhTerima' => 'Tarikh Terima',
            'infoTarikhSerah' => 'Tarikh Serah',
            'tempFile' => 'Dokumen',
            'jenisDokumen.mod_keterangan' => 'Jenis Dokumen',
        ];
    }

    /**
     * Gets query for [[DdFkKodJenisDokumen]].
     *
     * @return \yii\db\ActiveQuery
     */


    public function getJenisDokumen()
    { 
        return $this->hasOne(KodJenisDokumen::className(), ['id' => 'dd_fk_kod_jenis_dokumen_id']);
    }

    //dropdown list data
    public static function getKodJenisDokumenList()
    {
        $query = KodJenisDokumen::find()->select(['id', 'mod_keterangan'])->orderBy('mod_keterangan ASC')->asArray()->all();
        return ArrayHelper::map($query, 'id', 'mod_keterangan');
    }

    public function getInfoTarikhTerima()
    {
        return Yii::$app->formatter->asDateTime($this->dd_mod_tarikh_terima, 'php:d-M-Y h:i:s A');
    }

    public function getInfoTarikhSerah()
    {
        return Yii::$app->formatter->asDateTime($this->dd_mod_tarikh_serah, 'php:d-M-Y h:i:s A');
    }

}
