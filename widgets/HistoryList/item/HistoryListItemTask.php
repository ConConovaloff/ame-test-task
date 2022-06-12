<?php

namespace app\widgets\HistoryList\item;

class HistoryListItemTask extends HistoryListItemAbstract {
    public function render(): string {
        $task = $this->history->task;
        return $this->view->render('_item_common', [
            'user' => $this->history->user,
            'body' => $this->getBody(),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $this->history->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
    }

    public function getBody(): string {
        return "{$this->history->eventText}: " . ($this->history->task->title ?? '');
    }
}