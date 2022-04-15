<?php

use app\models\Notification;
use app\models\NotificationStatus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $integrationServiceList array */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Notification', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text:ntext',
            [
                'attribute' => 'integrator',
                'value' => function($data) use ($integrationServiceList) {
                    $arr = array_filter($integrationServiceList,function($item) use ($data) {
                        return $item['id'] === $data->integrator;
                    });

                    $arr = array_pop($arr);
                    if ($arr['id'] === $data->integrator) {
                        return $arr['name'];
                    } else {
                        return '-';
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'integrator', ArrayHelper::map($integrationServiceList, 'id', 'name'), ['class'=>'form-control', 'prompt' => 'Выбрать интеграцию']),
            ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return ($data->getRelatedRecords()['status'])->name;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', ArrayHelper::map(NotificationStatus::find()->asArray()->all(), 'code', 'name'), ['class'=>'form-control', 'prompt' => 'Выбрать статус']),
            ],
            'create_date',
            'send_date',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Notification $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
