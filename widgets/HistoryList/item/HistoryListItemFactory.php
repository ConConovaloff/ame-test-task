<?php

namespace app\widgets\HistoryList\item;

use app\models\History;
use app\models\HistoryEvent;

class HistoryListItemFactory {
    public static function make(History $historySearch) {
        switch ($historySearch->event_id) {
            case HistoryEvent::EVENT_ID_CREATED_TASK:
            case HistoryEvent::EVENT_ID_COMPLETED_TASK:
            case HistoryEvent::EVENT_ID_UPDATED_TASK:
                return new HistoryListItemTask($historySearch);

            case HistoryEvent::EVENT_ID_INCOMING_SMS:
            case HistoryEvent::EVENT_ID_OUTGOING_SMS:
                return new HistoryListItemSMS($historySearch);

            case HistoryEvent::EVENT_ID_OUTGOING_FAX:
            case HistoryEvent::EVENT_ID_INCOMING_FAX:
                return new HistoryListItemFax($historySearch);

            case HistoryEvent::EVENT_ID_CUSTOMER_CHANGE_TYPE:
                return new HistoryListItemChangeField('type', $historySearch);

            case HistoryEvent::EVENT_ID_CUSTOMER_CHANGE_QUALITY:
                return new HistoryListItemChangeField('quality', $historySearch);

            case HistoryEvent::EVENT_ID_INCOMING_CALL:
            case HistoryEvent::EVENT_ID_OUTGOING_CALL:
                return new HistoryListItemCall($historySearch);
        }

        throw new \Exception('not implemented event ' . $historySearch->event_id);
    }
}