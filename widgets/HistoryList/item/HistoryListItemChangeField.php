<?php

namespace app\widgets\HistoryList\item;
use app\models\Customer;
use app\models\History;
use yii\web\View;

class HistoryListItemChangeField extends HistoryListItemAbstract {
    /**
     * @var string
     */
    private $field;

    public function __construct(string $field, History $history) {
        $this->field = $field;
        parent::__construct($history);
    }

    public function render(): string {
        return $this->view->render('_item_statuses_change', [
            'model' => $this->history,
            'oldValue' => Customer::getTypeTextByType($this->history->getDetailOldValue($this->field)),
            'newValue' => Customer::getTypeTextByType($this->history->getDetailNewValue($this->field))
        ]);
    }

    public function getBody(): string {
        return $this->history->eventText . " " .
            (Customer::getTypeTextByType($this->history->getDetailOldValue($this->field)) ?? "not set") . ' to ' .
            (Customer::getTypeTextByType($this->history->getDetailNewValue($this->field)) ?? "not set");
    }
}