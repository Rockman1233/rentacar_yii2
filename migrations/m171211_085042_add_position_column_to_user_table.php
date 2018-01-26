<?php

use yii\db\Migration;

/**
 * Handles adding position to table `user`.
 */
class m171211_085042_add_position_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'password', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'password');
    }
}
