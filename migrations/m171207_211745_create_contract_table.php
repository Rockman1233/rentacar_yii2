<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contract`.
 */
class m171207_211745_create_contract_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('contract', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer(),
            'driver_id' => $this->integer(),
            'status' => $this->integer(),
            'first_date' => $this->date(),
            'second_date' => $this->date()
        ]);

        // creates index for column `car_id`
        $this->createIndex(
            'idx-contract-car_id',
            'contract',
            'car_id'
        );

        // add foreign key for table `car`
        $this->addForeignKey(
            'fk-contract-car_id',
            'contract',
            'car_id',
            'car',
            'id',
            'CASCADE'
        );
        // creates index for column `driver_id`
        $this->createIndex(
            'idx-contract-driver_id',
            'contract',
            'driver_id'
        );

        // add foreign key for table `driver`
        $this->addForeignKey(
            'fk-contract-driver_id',
            'contract',
            'driver_id',
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
        $this->dropTable('contract');
    }
}
