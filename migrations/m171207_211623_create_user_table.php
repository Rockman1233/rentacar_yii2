<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m171207_211623_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'drive_license' => $this->string(),
            'birthday' => $this->date(),
            'foto' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
