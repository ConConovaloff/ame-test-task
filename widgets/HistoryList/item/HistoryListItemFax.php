<?php

namespace app\widgets\HistoryList\item;
use yii\helpers\Html;
use Yii;

class HistoryListItemFax extends HistoryListItemAbstract {
    public function render(): string {
        $fax = $this->history->fax;

        $footer = Yii::t('app', '{type} was sent to {group}', [
            'type' => $fax ? $fax->getTypeText() : 'Fax',
            'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
        ]);

        return $this->view->render('_item_common', [
            'user' => $this->history->user,
            'body' => $this->getBody(),
            'footer' => $footer,
            'footerDatetime' => $this->history->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ]);
    }

    public function getBody(): string {
        $body = $this->history->eventText . ' - ';

        if (!isset($fax->document)) {
            return $body;
        }

        return $body . Html::a(Yii::t('app', 'view document'), $fax->document->getViewUrl(), [
            'target' => '_blank',
            'data-pjax' => 0,
        ]);
    }
}