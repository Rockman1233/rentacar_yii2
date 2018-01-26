<?php

use yii\db\Migration;

/**
 * Handles adding position to table `user`.
 */
class m171211_085342_add_position_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'login', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'login');
    }
}
