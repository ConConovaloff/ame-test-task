<?php

use app\models\History;
use app\models\HistoryEvent;
use yii\db\Migration;

/**
 * Class m220608_102719_finish_transfer_event_for_history
 */
class m220608_102719_finish_transfer_event_for_history extends Migration
{
    const INDEX_NAME = 'fk_history__event';

    public function safeUp() {
        // завершаем, указывая, что event_id не должен быть null
        $this->alterColumn(History::tableName(), 'event_id', $this->integer()->notNull());
        // и добавляю внешний ключ
        $this->addForeignKey(self::INDEX_NAME, History::tableName(), 'event_id', HistoryEvent::tableName(), 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("SET foreign_key_checks = 0;");
        $this->alterColumn(History::tableName(), 'event_id', $this->integer());
        $this->dropForeignKey(self::INDEX_NAME, History::tableName());
        $this->execute("SET foreign_key_checks = 1;");
    }
}
