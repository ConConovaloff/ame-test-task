<?php

namespace app\widgets\HistoryList\item;

use app\models\History;
use yii\base\View;

/**
 * Фабрика которая возвращает HistoryListItem умеющий рендериться через переданный View
 */
class HistoryListItemRenderFactory {
    public static function make(History $history, View $view): HistoryListItemCanRenderInterface {
        $historyListItem = HistoryListItemFactory::make($history);
        $historyListItem->setView($view);
        return $historyListItem;
    }
}