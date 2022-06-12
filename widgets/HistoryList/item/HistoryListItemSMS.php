<?php

namespace app\widgets\HistoryList\item;

use app\models\Sms;
use Yii;

class HistoryListItemSMS extends HistoryListItemAbstract {
    public function render(): string {
        $footer = $this->history->sms->direction == Sms::DIRECTION_INCOMING ?
            Yii::t('app', 'Incoming message from {number}', ['number' => $model->sms->phone_from ?? ''])
            : Yii::t('app', 'Sent message to {number}', ['number' => $model->sms->phone_to ?? '']);

        return $this->view->render('_item_common', [
            'user' => $this->history->user,
            'body' => self::getBody(),
            'footer' => $footer,
            'iconIncome' => $this->history->sms->direction == Sms::DIRECTION_INCOMING,
            'footerDatetime' => $this->history->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
    }

    public function getBody(): string {
        return $this->history->sms->message ?: '';
    }
}