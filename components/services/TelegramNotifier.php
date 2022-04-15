<?php

namespace app\components\services;

use app\models\Notification;
use Yii;
use yii\base\Component;

/**
 * Сервис для отправки Telegram сообщений.
 *
 * Class TelegramNotifier
 * @package components/services
 */
class TelegramNotifier extends Component
{
    const NOTIFIER_ID = 1;
    const SERVICE_NAME = 'Telegram';

    /**
     * Отправка сообщения в Telegram
     *
     * @param Notification $notification
     * @return bool
     */
    public function sendMessage(Notification $notification): bool
    {
        return true;
    }
}