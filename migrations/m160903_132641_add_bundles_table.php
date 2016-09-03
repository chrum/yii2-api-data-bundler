<?php

use yii\db\Migration;

class m160903_132641_add_bundles_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%data_bundles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'data' => $this->text(),
            'created_at' => $this->integer(11)->unsigned()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%data_bundles}}');
    }
}
