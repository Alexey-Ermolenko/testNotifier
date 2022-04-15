<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\models\Notification;
use app\components\services\SmsNotifier;
use app\components\services\TelegramNotifier;

/**
 *
 * Class Notifier
 * @package components
 */
class Notifier extends Component
{
    private Notification $notification;
    public Component $notificator;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
        $this->setNotificator();
    }

    public function setNotificator()
    {
        if ($this->notification->integrator === SmsNotifier::NOTIFIER_ID) {
            $this->notificator = new SmsNotifier();
        } else {
            $this->notificator = new TelegramNotifier();
        }
    }

    /**
     * Получение списка сервисов для отправки сообщений
     *
     * @return array
     */
    public static function getIntegrationServiceList(): array
    {
        return [
            ['id' => TelegramNotifier::NOTIFIER_ID, 'name' => TelegramNotifier::SERVICE_NAME],
            ['id' => SmsNotifier::NOTIFIER_ID, 'name' => SmsNotifier::SERVICE_NAME]
        ];
    }
}
