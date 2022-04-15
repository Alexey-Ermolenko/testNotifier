<?php

use yii\db\Migration;

/**
 * Class m220411_210656_notification
 */
class m220411_210656_notification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('notification',
            [
                'id'          => $this->primaryKey(),
                'text'        => $this->text(),
                'integrator'  => $this->integer()->notNull(),
                'status'      => $this->integer()->null(),
                'create_date' => $this->dateTime(),
                'send_date'   => $this->dateTime(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220411_210656_notification cannot be reverted.\n";

        $this->dropTable('notification');
    }
}
