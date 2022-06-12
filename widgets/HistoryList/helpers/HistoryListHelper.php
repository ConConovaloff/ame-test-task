<?php

namespace app\widgets\HistoryList\helpers;

use app\models\Call;
use app\models\Customer;
use app\models\History;
use app\models\HistoryEvent;

class HistoryListHelper
{
    public static function getBodyByModel(History $model)
    {
        switch ($model->event_id) {
            case HistoryEvent::EVENT_ID_CREATED_TASK:
            case HistoryEvent::EVENT_ID_COMPLETED_TASK:
            case HistoryEvent::EVENT_ID_UPDATED_TASK:
                $task = $model->task;
                return "$model->eventText: " . ($task->title ?? '');
            case HistoryEvent::EVENT_ID_INCOMING_SMS:
            case HistoryEvent::EVENT_ID_OUTGOING_SMS:
                return $model->sms->message ? $model->sms->message : '';
            case HistoryEvent::EVENT_ID_OUTGOING_FAX:
            case HistoryEvent::EVENT_ID_INCOMING_FAX:
                return $model->eventText;
            case HistoryEvent::EVENT_ID_CUSTOMER_CHANGE_TYPE:
                return "$model->eventText " .
                    (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                    (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set");
            case HistoryEvent::EVENT_ID_CUSTOMER_CHANGE_QUALITY:
                return "$model->eventText " .
                    (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
                    (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set");
            case HistoryEvent::EVENT_ID_INCOMING_CALL:
            case HistoryEvent::EVENT_ID_OUTGOING_CALL:
                /** @var Call $call */
                $call = $model->call;
                return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
            default:
                return $model->eventText;
        }
    }
}