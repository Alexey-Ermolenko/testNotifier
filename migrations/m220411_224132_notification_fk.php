<?php

use yii\db\Migration;

/**
 * Class m220411_224132_notification_fk
 */
class m220411_224132_notification_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_notification_status',
            'notification',
            'status',
            'notification_status',
            'code',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220411_224132_notification_fk cannot be reverted.\n";

        $this->dropForeignKey('fk_notification_status', 'notification');
    }
}
