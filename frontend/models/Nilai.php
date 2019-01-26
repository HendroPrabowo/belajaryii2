<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nilai".
 *
 * @property int $id
 * @property string $nama
 * @property int $nilai
 * @property string $file
 */
class Nilai extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nilai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'nilai'], 'required'],
            [['nilai'], 'integer'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file' => 'File',
            'id' => 'ID',
            'nama' => 'Nama',
            'nilai' => 'Nilai',
        ];
    }
}
