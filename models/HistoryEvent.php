<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;


/**
 * @property integer $id
 * @property string $name
 */
class HistoryEvent extends ActiveRecord
{
    const EVENT_NAME_CREATED_TASK = 'created_task';
    const EVENT_NAME_UPDATED_TASK = 'updated_task';
    const EVENT_NAME_COMPLETED_TASK = 'completed_task';
    const EVENT_ID_CREATED_TASK = 1;
    const EVENT_ID_UPDATED_TASK = 2;
    const EVENT_ID_COMPLETED_TASK = 3;

    const EVENT_NAME_INCOMING_SMS = 'incoming_sms';
    const EVENT_NAME_OUTGOING_SMS = 'outgoing_sms';
    const EVENT_ID_INCOMING_SMS = 4;
    const EVENT_ID_OUTGOING_SMS = 5;

    const EVENT_NAME_INCOMING_CALL = 'incoming_call';
    const EVENT_NAME_OUTGOING_CALL = 'outgoing_call';
    const EVENT_ID_INCOMING_CALL = 6;
    const EVENT_ID_OUTGOING_CALL = 7;


    const EVENT_NAME_INCOMING_FAX = 'incoming_fax';
    const EVENT_NAME_OUTGOING_FAX = 'outgoing_fax';
    const EVENT_ID_INCOMING_FAX = 8;
    const EVENT_ID_OUTGOING_FAX = 9;


    const EVENT_NAME_CUSTOMER_CHANGE_TYPE = 'customer_change_type';
    const EVENT_NAME_CUSTOMER_CHANGE_QUALITY = 'customer_change_quality';
    const EVENT_ID_CUSTOMER_CHANGE_TYPE = 10;
    const EVENT_ID_CUSTOMER_CHANGE_QUALITY = 11;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%history_event}}';
    }

    /**
     * @return string[]
     */
    public static function getMapEventIdToEventName()
    {
        return [
            self::EVENT_ID_CREATED_TASK => self::EVENT_NAME_CREATED_TASK,
            self::EVENT_ID_UPDATED_TASK => self::EVENT_NAME_UPDATED_TASK,
            self::EVENT_ID_COMPLETED_TASK => self::EVENT_NAME_COMPLETED_TASK,
            self::EVENT_ID_INCOMING_SMS => self::EVENT_NAME_INCOMING_SMS,
            self::EVENT_ID_OUTGOING_SMS => self::EVENT_NAME_OUTGOING_SMS,
            self::EVENT_ID_INCOMING_CALL => self::EVENT_NAME_INCOMING_CALL,
            self::EVENT_ID_OUTGOING_CALL => self::EVENT_NAME_OUTGOING_CALL,
            self::EVENT_ID_INCOMING_FAX => self::EVENT_NAME_INCOMING_FAX,
            self::EVENT_ID_OUTGOING_FAX => self::EVENT_NAME_OUTGOING_FAX,
            self::EVENT_ID_CUSTOMER_CHANGE_TYPE => self::EVENT_NAME_CUSTOMER_CHANGE_TYPE,
            self::EVENT_ID_CUSTOMER_CHANGE_QUALITY => self::EVENT_NAME_CUSTOMER_CHANGE_QUALITY,
        ];
    }

    /**
     * @param int $eventId
     * @return string|null
     */
    public static function getEventTextByEventId(int $eventId)
    {
        return static::getEventTexts()[$eventId] ?? $eventId;
    }

    /**
     * @return array
     */
    public static function getEventTexts()
    {
        return [
            self::EVENT_ID_CREATED_TASK => Yii::t('app', 'Task created'),
            self::EVENT_ID_UPDATED_TASK => Yii::t('app', 'Task updated'),

            self::EVENT_ID_COMPLETED_TASK => Yii::t('app', 'Task completed'),

            self::EVENT_ID_INCOMING_SMS => Yii::t('app', 'Incoming message'),
            self::EVENT_ID_OUTGOING_SMS => Yii::t('app', 'Outgoing message'),

            self::EVENT_ID_CUSTOMER_CHANGE_TYPE => Yii::t('app', 'Type changed'),
            self::EVENT_ID_CUSTOMER_CHANGE_QUALITY => Yii::t('app', 'Property changed'),

            self::EVENT_ID_OUTGOING_CALL => Yii::t('app', 'Outgoing call'),
            self::EVENT_ID_INCOMING_CALL => Yii::t('app', 'Incoming call'),

            self::EVENT_ID_INCOMING_FAX => Yii::t('app', 'Incoming fax'),
            self::EVENT_ID_OUTGOING_FAX => Yii::t('app', 'Outgoing fax'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
        ];
    }
}