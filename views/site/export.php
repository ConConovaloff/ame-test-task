<?php

/**
 * @var $this yii\web\View
 * @var $model \app\models\History
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $exportType string
 */

use app\models\History;
use app\widgets\Export\Export;
use app\widgets\HistoryList\item\HistoryListItemWithBodyFactory;

$filename = 'history';
$filename .= '-' . time();

// На странице экспорта мы сделали фильтрацию, чтобы можно было экспортировать не все данные, а частично по указанным критериям.
// Если же к вам пришел сотрудник и говорит, что ему нужен инструмент который способен экспортить _все_ данные, то можем:
//  - обсудить перенос генерации отчета на работу через сервер сообщений
//     + разделение итогового файла на несколько, например по 1кк строк в каждом файле и архивирование их в один zip, чтобы не иметь один 10Гб csv файл
//     + информировение человека о готовности отчета и ссылке по которой можно скачать zip файл с отчетами внутри

ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
?>

<?= Export::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'ins_ts',
            'label' => Yii::t('app', 'Date'),
            'format' => 'datetime'
        ],
        [
            'label' => Yii::t('app', 'User'),
            'value' => function (History $model) {
                return isset($model->user) ? $model->user->username : Yii::t('app', 'System');
            }
        ],
        [
            'label' => Yii::t('app', 'Type'),
            'value' => function (History $model) {
                return $model->object;
            }
        ],
        [
            'label' => Yii::t('app', 'Event'),
            'value' => function (History $model) {
                return $model->eventText;
            }
        ],
        [
            'label' => Yii::t('app', 'Message'),
            'value' => function (History $model) {
                $historyListItem = HistoryListItemWithBodyFactory::make($model);
                return strip_tags($historyListItem->getBody());
            }
        ]
    ],
    'exportType' => $exportType,
    'batchSize' => 2000,
    'filename' => $filename
]);