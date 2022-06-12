<?php

use app\models\History;
use app\models\HistoryEvent;
use yii\db\Migration;

/**
 * Class m220608_102717_separate_and_transfer_events_from_history
 */
class m220608_102717_separate_and_transfer_events_from_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // создаем новую таблицу history_event
        $this->createTable(HistoryEvent::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);
        // добавляем колонку event_id для History
        $this->addColumn(History::tableName(), 'event_id', $this->integer()->after('event'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(History::tableName(), 'event_id');
        $this->dropTable(HistoryEvent::tableName());
    }
}
