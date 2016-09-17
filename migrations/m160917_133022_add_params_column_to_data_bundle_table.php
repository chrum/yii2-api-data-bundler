<?php

use yii\db\Migration;

/**
 * Handles adding params to table `data_bundle`.
 */
class m160917_133022_add_params_column_to_data_bundle_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%data_bundles}}', 'params', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%data_bundles}}', 'params');
    }
}
