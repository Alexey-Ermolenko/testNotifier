<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string|null $text
 * @property int $integrator
 * @property int|null $status
 * @property string|null $create_date
 * @property string|null $send_date
 *
 * @property NotificationStatus $notificationStatus
 */
class Notification extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['integrator'], 'required'],
            [['integrator', 'status'], 'integer'],
            [['create_date', 'send_date'], 'safe'],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationStatus::className(), 'targetAttribute' => ['status' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'integrator' => 'Integrator',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'send_date' => 'Send Date',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(NotificationStatus::class, ['code' => 'status']);
    }
}
