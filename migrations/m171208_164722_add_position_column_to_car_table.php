<?php

use yii\db\Migration;

/**
 * Handles adding position to table `car`.
 */
class m171208_164722_add_position_column_to_car_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('car', 'owner', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('car', 'owner');
    }
}
