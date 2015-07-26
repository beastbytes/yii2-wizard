<?php
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'Survey Wizard';

//echo $event->sender->menu->run();

$form = ActiveForm::begin(['options' => ['id' => 'wizard-form']]);
echo $form->field($model, 'name');
echo $form->field($model, 'gender')->radiolist([
    'Female' => 'Female',
    'Male'   => 'Male'
]);
echo $form->field($model, 'age');
echo $form->field($model, 'colour');
echo $form->field($model, 'when')->widget(DatePicker::className(), [
    'clientOptions' => [
        'changeMonth' => true,
        'changeYear'  => true,
        'maxDate'     => 0,
        'showAnim'    => 'fade',
        'yearRange'   => 'c-10:+0'
    ]
]);

echo Html::beginTag('div', ['class' => 'form-group buttons']);
echo Html::submitButton('Save & Add Another Pet', ['class' => 'button', 'name' => 'add', 'value' => 'add']);
echo Html::submitButton('Save & End', ['class' => 'button']);
echo Html::endTag('div');
ActiveForm::end();

$this->registerCss('#wizard-form .form-group{float:none;margin:0 10%;width:50%}');
