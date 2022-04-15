<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\Notifier;
use app\components\services\SmsNotifier;
use app\components\services\TelegramNotifier;
use Yii;
use app\models\Notification;
use app\models\NotificationStatus;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CommandController extends Controller
{
    /**
     * Команда рассылающая сообщения через разные сервисы
     * @return int Exit code
     */
    public function actionSendMessage(): int
    {
        $query = Notification::find()
            ->where(['!=', 'status', NotificationStatus::ERROR])
            ->andWhere(['<=', 'send_date', new Expression('NOW()')]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $notifications = $dataProvider->getModels();

        foreach ($notifications as $notification) {
            if ((new Notifier($notification))->notificator->sendMessage($notification) === true) {
                $notification->send_date = date('Y-m-d H:m:s', time());
                $notification->status = NotificationStatus::SENT;
                $notification->save();
            }
        }

        return ExitCode::OK;
    }
}
