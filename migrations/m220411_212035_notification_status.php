<?php

use yii\db\Migration;

/**
 * Class m220411_212035_notification_status
 */
class m220411_212035_notification_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('notification_status',
            [
                'id'   => $this->primaryKey(),
                'code' => $this->integer()->unique()->null(),
                'name' => $this->string(255),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220411_212035_notification_status cannot be reverted.\n";

        $this->dropTable('notification_status');
    }
}
