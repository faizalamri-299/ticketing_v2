<?php

namespace frontend\modules\pentadbiran\models;

use Yii;

/**
 * This is the model class for table "tbl_kod_daerah".
 *
 * @property int $id
 * @property int|null $userid_masuk
 * @property string|null $tarikh_masuk
 * @property int|null $userid_kemaskini
 * @property string|null $tarikh_kemaskini
 * @property string $kod
 * @property string $keterangan
 * @property string $kod_negeri
 */
class KodDaerah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kod_daerah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid_masuk', 'userid_kemaskini'], 'integer'],
            [['tarikh_masuk', 'tarikh_kemaskini'], 'safe'],
            [['kod', 'keterangan', 'kod_negeri'], 'required'],
            [['kod', 'kod_negeri'], 'string', 'max' => 2],
            [['keterangan'], 'string', 'max' => 100],
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
            'keterangan' => 'Keterangan',
            'kod_negeri' => 'Kod Negeri',
        ];
    }
}
