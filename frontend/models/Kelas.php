<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property int $id_kelas
 * @property string $kelas
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelas'], 'required'],
            [['id_kelas'], 'integer'],
            [['kelas'], 'string', 'max' => 200],
            [['id_kelas'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kelas' => 'Id Kelas',
            'kelas' => 'Kelas',
        ];
    }
}
