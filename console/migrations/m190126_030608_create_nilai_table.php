<?php

use yii\db\Migration;

/**
 * Handles the creation of table `nilai`.
 */
class m190126_030608_create_nilai_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('nilai', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'nilai' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('nilai');
    }
}
