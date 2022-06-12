<?php

use app\models\HistoryEvent;
use app\models\search\HistorySearch;
use kartik\date\DatePicker;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/** @var $model HistorySearch */
?>

<div class="panel panel-default filter-form">
    <div class="panel-heading">
        <?= Yii::t('app', 'Filter:') ?>
    </div>
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
            'method' => 'get',
            'options' => [
                'legend' => 'filter:'
            ]
        ]);
        ?>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, 'user_id')->label(Yii::t('app', 'User ID')) ?>
            </div>
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, 'event_id')->widget(Select2::className(), [
                    'data' => HistoryEvent::getMapEventIdToEventName(),
                    'options' => [
                        'multiple' => true,
                    ],
                ])->label(Yii::t('app', 'Event')); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, 'ins_ts_from')->widget(DatePicker::className(), [
                    'name' => 'from_date',
                    'removeButton' => false,
                    'options' => [
                        'autocomplete' => 'off'
                    ],
                    'pluginOptions' => [
                        'autocomplete' => 'off',
                        'format' => 'yyyy-mm-dd', // todo: дописать плагин, чтобы формат отображения даты был локализирован для пользователю (для Америки mm/dd/yyyy ),
                                                  // а на сервер отправлялись данные в едином формате yyyy-mm-dd или timestamp. Разгадывать какой формат даты нам послали с фронта на бэке, не самая лучшая идея.
                        'autoclose' => true,
                    ],
                ])->label(Yii::t('app', 'From date')); ?>
            </div>
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, 'ins_ts_to')->widget(DatePicker::className(), [
                    'name' => 'to_date',
                    'removeButton' => false,
                    'options' => [
                        'autocomplete' => 'off'
                    ],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ],
                ])->label(Yii::t('app', 'Up to date')); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Apply'), ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
