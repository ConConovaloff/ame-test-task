<?php
use app\models\search\HistorySearch;
use app\widgets\HistoryList\item\HistoryListItemRenderFactory;

/** @var $this yii\web\View **/
/** @var $model HistorySearch **/


// Хорошее место, чтобы показать для тестового задание знания OOP и паттернов
$historyEventItemRender = HistoryListItemRenderFactory::make($model, $this);
echo $historyEventItemRender->render();
