<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification_status".
 *
 * @property int $id
 * @property int|null $code
 * @property string|null $name
 *
 * @property Notification[] $notifications
 */
class NotificationStatus extends \yii\db\ActiveRecord
{
    const ERROR = 1;
    const WAITING = 2;
    const SENT = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::class, ['status' => 'code']);
    }
}
