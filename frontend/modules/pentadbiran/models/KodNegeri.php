<?php

namespace frontend\modules\pentadbiran\models;

use Yii;

/**
 * This is the model class for table "tbl_kod_negeri".
 *
 * @property int $id
 * @property int|null $userid_masuk
 * @property string|null $tarikh_masuk
 * @property int|null $userid_kemaskini
 * @property string|null $tarikh_kemaskini
 * @property string|null $kod
 * @property string|null $kod_lama
 * @property string|null $keterangan
 */
class KodNegeri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kod_negeri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid_masuk', 'userid_kemaskini'], 'integer'],
            [['tarikh_masuk', 'tarikh_kemaskini'], 'safe'],
            [['kod'], 'string', 'max' => 3],
            [['kod_lama'], 'string', 'max' => 7],
            [['keterangan'], 'string', 'max' => 23],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid_masuk' => 'Userid Masuk',
            'tarikh_masuk' => 'Tarikh Masuk',
            'userid_kemaskini' => 'Userid Kemaskini',
            'tarikh_kemaskini' => 'Tarikh Kemaskini',
            'kod' => 'Kod',
            'kod_lama' => 'Kod Lama',
            'keterangan' => 'Keterangan',
        ];
    }
}
