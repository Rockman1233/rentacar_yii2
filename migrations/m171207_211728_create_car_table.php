<?php

use yii\db\Migration;

/**
 * Handles the creation of table `car`.
 */
class m171207_211728_create_car_table extends Migration
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
            'owner' => $this->integer(),
            'foto' => $this->string(),
            'description' => $this->text()

        ]);

        // add foreign key for table `car`
        $this->addForeignKey(
            'fk-car-user',
            'car',
            'owner',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('car');
    }


}
