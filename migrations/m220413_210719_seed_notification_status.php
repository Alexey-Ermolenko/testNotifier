<?php

use app\models\NotificationStatus;
use yii\db\Migration;

/**
 * Class m220413_210719_seed_notification_status
 */
class m220413_210719_seed_notification_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('notification_status', ['code', 'name'], [
            [NotificationStatus::ERROR, 'ERROR'],
            [NotificationStatus::WAITING, 'WAITING'],
            [NotificationStatus::SENT, 'SENT']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220413_210719_seed_notification_status cannot be reverted.\n";

        $this->truncateTable('notification_status');

        return false;
    }
}
