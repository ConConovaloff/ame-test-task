<?php

namespace app\widgets\HistoryList\item;
use app\models\Call;

class HistoryListItemCall extends HistoryListItemAbstract {
    public function render(): string {
        $call = $this->history->call;
        $answered = $call && $call->status == Call::STATUS_ANSWERED;

        return $this->view->render('_item_common', [
            'user' => $this->history->user,
            'content' => $call->comment ?? '',
            'body' => $this->getBody(),
            'footerDatetime' => $this->history->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
        ]);
    }

    public function getBody(): string {
        $call = $this->history->call;
        if (!$call) {
            return '<i>Deleted</i> ';
        }

        $totalDisposition = $call->getTotalDisposition(false)
            ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>"
            : "";

        return $call->totalStatusText . $totalDisposition;
    }
}