<?php

namespace app\widgets\HistoryList\item;

use app\models\History;

/**
 * Фабрика которая возвращает HistoryListItem умеющий возвращать тело
 */
class HistoryListItemWithBodyFactory {
    public static function make(History $history): HistoryListItemHasBodyInterface {
        return HistoryListItemFactory::make($history);
    }
}