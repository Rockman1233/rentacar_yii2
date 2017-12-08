<?php

use yii\db\Migration;

/**
 * Handles the creation of table `car`.
 */
class m171207_211729_create_car_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('car', [

            'id' => $this->primaryKey(),
            'mark' => $this->string(),
            'model' => $this->string(),
            'colour' => $this->string(),
            'state_num' => $this->string(),
            'price' => $this->integer(),
            'status' => $this->integer(),
            'foto' => $this->string(),
            'description' => $this->text()

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('car');
    }
}
