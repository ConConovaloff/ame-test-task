<?php

use app\models\History;
use yii\db\Migration;

/**
 * Class m220608_102800_add_indexes_for_history
 */
class m220608_102800_add_indexes_for_history extends Migration
{
    const IDX_INS_TS = 'idx_ins_ts';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(self::IDX_INS_TS, History::tableName(), 'ins_ts');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("SET foreign_key_checks = 0;");
        $this->dropIndex(self::IDX_INS_TS, History::tableName());
        $this->execute("SET foreign_key_checks = 1;");
    }
}
