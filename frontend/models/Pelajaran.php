<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pelajaran".
 *
 * @property int $id
 * @property string $pelajaran
 */
class Pelajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pelajaran'], 'required'],
            [['id'], 'integer'],
            [['pelajaran'], 'string', 'max' => 200],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pelajaran' => 'Pelajaran',
        ];
    }
}
