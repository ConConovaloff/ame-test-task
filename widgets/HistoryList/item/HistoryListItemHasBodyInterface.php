<?php

namespace app\widgets\HistoryList\item;

/**
 * Интерфейс HistoryListItem умеющий возвращать тело
 */
interface HistoryListItemHasBodyInterface {
    public function getBody(): string;
}
