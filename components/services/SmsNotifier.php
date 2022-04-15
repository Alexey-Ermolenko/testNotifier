<?php

namespace app\components\services;

use app\models\Notification;
use Yii;
use yii\base\Component;

/**
 * Сервис для отправки SMS сообщений.
 *
 * Class SmsNotifier
 * @package components/services
 */
class SmsNotifier extends Component
{
    const NOTIFIER_ID = 2;
    const SERVICE_NAME = 'Sms';

    public Notification $notification;
    public string $number;
    public string $message;

    public function getNotification(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Отправка SMS пользователю.
     *
     * @param Notification $notification
     * @return bool
     */
    public function sendMessage(Notification $notification): bool
    {
        return true;
    }
}
