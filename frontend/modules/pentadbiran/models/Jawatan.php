<?php

namespace frontend\modules\pentadbiran\models;

use Yii;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\KakitanganHasJawatan;
use frontend\modules\pentadbiran\models\Unit;

/**
 * This is the model class for table "tbl_jt_jawatan".
 *
 * @property int $id
 * @property int $jt_fk_ut_id
 * @property string $jt_mod_kod
 * @property string $jt_mod_nama_jawatan
 * @property string $jt_mod_ringkasan_peranan
 */
class Jawatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_jt_jawatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jt_fk_ut_id', 'jt_mod_kod', 'jt_mod_nama_jawatan', 'jt_mod_ringkasan_peranan'], 'required'],
            [['jt_fk_ut_id'], 'integer'],
            [['jt_mod_kod'], 'string', 'max' => 50],
            [['jt_mod_nama_jawatan', 'jt_mod_ringkasan_peranan'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jt_fk_ut_id' => 'ID Unit',
            'jt_mod_kod' => 'Kod Jawatan',
            'jt_mod_nama_jawatan' => 'Nama Jawatan',
            'jt_mod_ringkasan_peranan' => 'Ringkasan Peranan Jawatan',
        ];
    }

    /***************************** FOREIGN KEY [START] ****************************/

    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'jt_fk_ut_id']);
    }

    public function getKakitanganHasJawatan()
    {
        return $this->hasMany(KakitanganHasJawatan::className(), ['kajt_fk_jawatan_id' => 'id']);
    }

    // Get data from Kakitangan table through the intermediate table -> tbl_kajt_kakitangan_has_jawatan
     public function getKakitangan()
    {
        return $this->hasMany (Kakitangan::className(), ['id' => 'id'])
        ->via ('kakitanganHasJawatan');
    }

    /***************************** FOREIGN KEY [START] ****************************/
}
