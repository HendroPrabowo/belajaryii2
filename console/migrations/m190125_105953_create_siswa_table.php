<?php

use yii\db\Migration;

/**
 * Handles the creation of table `siswa`.
 */
class m190125_105953_create_siswa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('siswa', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'jenis_kelamin' => $this->string()->notNull(),
            'agama' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('siswa');
    }
}
