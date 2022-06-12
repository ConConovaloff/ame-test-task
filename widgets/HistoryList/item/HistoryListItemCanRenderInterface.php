<?php

namespace app\widgets\HistoryList\item;

use yii\base\View;

/**
 * Интерфейс HistoryListItem умеющий рендериться через переданный View
 */
interface HistoryListItemCanRenderInterface {
    public function setView(View $view);
    public function render(): string;
}
