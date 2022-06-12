<?php

use app\models\History;
use app\models\HistoryEvent;
use yii\db\Migration;

/**
 * Class m220608_102720_delete_old_event_data_for_history
 */
class m220608_102720_delete_old_event_data_for_history extends Migration
{
    public function up() {
        // удаляем более не нужную колонку event
        // WARNING: удаляеммые данные будет не восстановить
        $this->dropColumn(History::tableName(), 'event');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // тут уже не восстановить данные
        $this->addColumn(History::tableName(), 'event', $this->string());

        return true;
    }
}
