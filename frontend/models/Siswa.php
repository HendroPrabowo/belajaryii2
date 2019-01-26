<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property int $id
 * @property string $nama
 * @property string $jenis_kelamin
 * @property string $agama
 * @property string $file_import
 */
class Siswa extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'jenis_kelamin', 'agama'], 'required'],
            [['nama', 'jenis_kelamin', 'agama'], 'string', 'max' => 255],
            [['file_import'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file' => 'CSV',
            'id' => 'ID',
            'nama' => 'Nama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'file_import' => 'File Import',
        ];
    }
}
