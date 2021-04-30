<?php

namespace frontend\modules\pentadbiran\models;

use Yii;
use frontend\modules\pentadbiran\models\Jawatan;

/**
 * This is the model class for table "tbl_ut_unit".
 *
 * @property int $id
 * @property string $ut_mod_kod
 * @property string $ut_mod_singkatan
 * @property string $ut_mod_nama_unit
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ut_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ut_mod_kod', 'ut_mod_singkatan', 'ut_mod_nama_unit'], 'required'],
            [['ut_mod_kod', 'ut_mod_singkatan'], 'string', 'max' => 50],
            [['ut_mod_nama_unit'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ut_mod_kod' => 'Kod Unit',
            'ut_mod_singkatan' => 'Singkatan Unit',
            'ut_mod_nama_unit' => 'Nama Unit',
        ];
    }

     public function getJawatan()
    {
        return $this->hasMany(Jawatan::className(), ['jt_fk_ut_id' => 'id']);
    }
}
