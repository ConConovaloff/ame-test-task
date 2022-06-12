<?php

use app\models\History;
use app\models\HistoryEvent;
use yii\db\Migration;

/**
 * Class m220608_102718_transfer_event_data_for_history
 */
class m220608_102718_transfer_event_data_for_history extends Migration
{
    public function up() {
        // Перекладываем данные. из event в event_id
        // без транзакции, потому что данных может быть много + это безопасная операция
        foreach (HistoryEvent::getMapEventIdToEventName() as $event_id => $event_name) {
            $this->insert(HistoryEvent::tableName(), [
                'id' => $event_id,
                'name' => $event_name,
            ]);

            $this->getDb()
                ->createCommand("
                UPDATE history 
                SET event_id = :event_id WHERE event = :event
        ", [':event_id' => $event_id, ':event' => $event_name])
                ->execute();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $command = $this->getDb()->createCommand("UPDATE history SET event_id = null");
        $command->execute();

        $this->truncateTable(HistoryEvent::tableName());
    }
}
