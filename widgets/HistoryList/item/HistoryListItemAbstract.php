<?php

namespace app\widgets\HistoryList\item;

use app\models\History;
use yii\base\View;

abstract class HistoryListItemAbstract implements HistoryListItemCanRenderInterface, HistoryListItemHasBodyInterface {
    /** @var History */
    protected $history;

    /** @var View */
    protected $view;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function setView(View $view) {
        $this->view = $view;
    }

    public function render(): string {
        return $this->view->render('_item_common', [
            'user' => $this->history->user,
            'body' => $this->getBody(),
            'bodyDatetime' => $this->history->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ]);
    }

    public function getBody(): string {
        return $this->history->eventText;
    }
}
